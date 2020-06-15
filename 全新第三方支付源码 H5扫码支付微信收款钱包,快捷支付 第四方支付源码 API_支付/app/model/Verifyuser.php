<?php
namespace WY\app\model;

use WY\app\libs\Model;
use WY\app\libs\Session;
use WY\app\libs\Req;
use WY\app\libs\Res;
if (!defined('WY_ROOT')) {
    exit;
}
class Verifyuser
{
    function __construct()
    {
        $this->model = new Model();
        $this->session = new Session();
        $this->req = new Req();
        $this->res = new Res();
    }
    public function verify()
    {
        if ($this->session->get('login_userid')) {
            return '/member';
        }
        if ($this->session->get('login_agentid')) {
            return '/agent';
        }
        if (isset($_COOKIE['uuid']) && isset($_COOKIE['usta'])) {
            $uuid = $_COOKIE['uuid'];
            $usta = $_COOKIE['usta'];
            if ($uuid == '' || $usta == '' || !preg_match('/[a-z0-9]{20}/', $uuid)) {
                return false;
            }
            $user = $this->model->select()->from('users')->where(array('fields' => 'left(salt,20)=?', 'values' => array($uuid)))->fetchRow();
            if ($user) {
                $hash = sha1($user['username'] . $user['userpass'] . $user['salt']);
                if ($hash == $usta) {
                    if ($user['is_agent']) {
                        $this->session->set('login_agentid', $user['id']);
                        $this->session->set('login_agentname', $user['username']);
                        $url = '/agent';
                    } else {
                        $this->session->set('login_userid', $user['id']);
                        $this->session->set('login_username', $user['username']);
                        $url = '/member';
                    }
							$ip = $this->req->server('REMOTE_ADDR');
              		
					$logData = array('userid' => $user['id'], 'addtime' => time(), 'ip' => $ip ,'address' => $this->res->getIPLoc($ip));
                    $this->model->from('userlogs')->insertData($logData)->insert();
                    return $url;
                }
            }
        }
        return false;
    }
    public function setck($userid, $username, $userpass)
    {
        $salt = sha1($this->res->getRandomString(32));
        if ($this->model->from('users')->updateSet(array('salt' => $salt))->where(array('fields' => 'id=?', 'values' => array($userid)))->update()) {
            $expire = time() + 60 * 60 * 24 * 7;
            setcookie('uuid', $this->res->substring($salt, 0, 20), $expire, '/', '');
            setcookie('usta', sha1($username . $userpass . $salt), $expire, '/', '');
        }
    }
    public function unsetck()
    {
        setcookie('uuid', '', time() - 60 * 60, '/', '');
        setcookie('usta', '', time() - 60 * 60, '/', '');
    }
}