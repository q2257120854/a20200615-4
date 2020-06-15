<?php

namespace xh\run\index\controller;

use xh\library\functions;
use xh\library\mysql;

class notice
{

    public function __construct()
    {
        $this->mysql = new mysql();
    }

    public function polling()
    {
        $mysql = new mysql();
        $where = 'is_notice = 0';
        $list = $mysql->query('client_withdraw', $where);
//        foreach ($list as $key => $value) {
//            $where = 'id = '.$value['id'];
//            $data['is_notice'] = 1;
//            //$mysql->update('client_withdraw', $data,$where);
//            functions::json(200,'ok');
//        }
        if (!empty($list)) {
            functions::json(200, 'ok');
        }
        functions::json(-1, '无需要的通知');
    }
}
