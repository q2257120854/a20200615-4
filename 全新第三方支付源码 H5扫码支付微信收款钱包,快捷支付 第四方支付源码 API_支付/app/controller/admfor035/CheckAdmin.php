<?php
namespace WY\app\controller\admfor035;

use WY\app\libs\Controller;
use WY\app\Config;
if (!defined('WY_ROOT')) {
    exit;
}
class CheckAdmin extends Controller
{


	


    public $dir = '/admfor035/';
    public $action;
    function __construct()
    {

		$houtaipath		=	Config::db()['path'];

		$dir			=	$houtaipath;


		$this->dir		="/".$dir."/";

        parent::__construct();
        $this->tpl = 'view/admin/';
        if (!isset($this->action[1]) || isset($this->action[1]) && $this->action[1] != 'login' && $this->action[1] != 'sigin') {
            if (!$this->session->get('login_adminname')) {
                $this->res->redirect($this->dir . 'login');
            }
        }
        $this->setConfig = new Config();
        $this->nav = $this->model()->select()->from('navcog')->fetchRow();
        $this->nav = $this->nav ? json_decode($this->nav['content']) : array();
        if ($this->session->get('login_adminname')) {
            $limits = $this->model()->select('limits')->from('admin')->where(array('fields' => 'adminname=?', 'values' => array($this->session->get('login_adminname'))))->fetchRow();
            if (!$limits) {
                $this->res->redirect($this->dir . 'logout');
                exit;
            }
            $limits = json_decode($limits['limits'], true);
            $limits += array('login' => '安全退出');
            if (isset($this->action[1]) && !array_key_exists($this->action[1], $limits)) {
                $this->put('woodyapp.php', array('title' => '无权限操作', 'msg' => '当前您没有此权限'));
                exit;
            }
        }
    }
    public function menu()
    {
        return array('用户管理' => array('users' => '用户列表', 'usercfo' => '代收款登记', 'userlogs' => '登录日志', 'usership' => '用户结算', 'userpay' => '付款记录'), '订单管理' => array('orders' => '订单列表', 'ordersua' => '商户统计', 'ordersca' => '通道统计', 'ordersha' => '代理统计'), '代理管理' => array('agent' => '代理列表', 'agentlogs' => '登录日志', 'agentship' => '代理结算', 'agentpay' => '付款记录'), '通道管理' => array('acp' => '接入信息', 'acl' => '接入网关', 'acc' => '通道列表', 'acw' => '通用网关', 'acb' => '网银列表'), '文章管理' => array('arcate' => '文章分类', 'arlist' => '文章列表'), '系统管理' => array('admins' => '管理员列表', 'pwd' => '修改密码', 'logs' => '登录日志', 'set' => '系统设置', 'cog' => '导航设置', 'mailtpl' => '邮件模板', 'ordernotify' => '通知记录', 'bd' => '补发订单'));
    }
    public function getSubMenu($menu, $cur = '')
    {
        $list = '';
        if (array_key_exists($menu, $this->menu())) {
            foreach ($this->menu()[$menu] as $key => $val) {
                $current = isset($cur) && $cur == $key ? ' class="current"' : '';
                $list .= '<dd' . $current . '><a href="' . $this->dir . $key . '">' . $val . '</a></dd>';
            }
        }
        return $list;
    }
}
?>