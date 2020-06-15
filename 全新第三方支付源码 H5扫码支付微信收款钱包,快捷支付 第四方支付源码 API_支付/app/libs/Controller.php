<?php
namespace WY\app\libs;

use WY\app\woodyapp;
use WY\app\libs\Router;
use WY\app\libs\Req;
use WY\app\libs\Res;
use WY\app\libs\Page;
use WY\app\libs\Session;
use WY\app\controller\chkcode;
use WY\app\libs\Model;
use WY\app\Config;
use WY\app\model\Verifyuser;
if (!defined('WY_ROOT')) {
    exit;
}
class Controller
{
    public $data;
    public $tpl = 'view/default/';
    function __construct()
    {
        $this->router = new Router();
        $this->req = new Req();
        $this->res = new Res();
        $this->page = new Page();
        $this->session = new Session();
        $this->chkcode = new chkcode();
        $this->config = $this->model()->select()->from('config')->fetchRow();
        $this->action = $this->router->put();
        $this->setConfig = new Config();
        $this->verifyUser = new Verifyuser();
    }
    public function model()
    {
        return new Model();
    }
    public function put($file, $data = array())
    {
        if ($data) {
            extract($data);
        }
        if (!file_exists($this->tpl . $file)) {
            $file = 'woodyapp.php';
        }
        require_once $this->tpl . $file;
        $content = ob_get_contents();
        ob_get_clean();
        echo $content;
        if (ob_get_level()) {
            ob_end_flush();
        }
    }
}
?>