<?php
namespace WY\app\controller\agent;

use WY\app\libs\Controller;
if (!defined('WY_ROOT')) {
    exit;
}
class news extends CheckUser
{
    public function view()
    {
        $id = isset($this->action[3]) ? intval($this->action[3]) : 0;
        $data = $this->model()->select()->from('arlist')->where(array('fields' => 'id=? and is_state=?', 'values' => array($id, '1')))->fetchRow();
        $this->put('viewArticle.php', $data);
    }
}