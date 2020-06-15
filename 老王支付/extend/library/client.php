<?php

namespace xh\library;


use xh\library\Gateway;

/**
 * 客户端请求二维码
 * 说明，任何为false的串，存在redis中都是空串。
 * 只有在key不存在时，才会返回false。
 * 这点可用于防止缓存穿透
 *
 */
class client
{

    static function getQrCode($client_id_uid, $mark, $money, $paytype = 'alipay')
    {
        $jsonData = json_encode([
            'type'    => 'paytype',
            'mark'    => $mark,
            'money'   => $money,
            'paytype' => $paytype
        ]);

        Gateway::$registerAddress = '127.0.0.1:1236';

        // 向任意uid的网站页面发送数据
        Gateway::sendToUid($client_id_uid, $jsonData);
    }

    static function bindUid($client_id, $uid)
    {

        Gateway::$registerAddress = '127.0.0.1:1236';

        //client_id与uid绑定
        Gateway::bindUid($client_id, $uid);
    }
}