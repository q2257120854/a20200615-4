<?php

namespace xh\library;

use xh\run\admin\controller\employee;
use xh\unity\encrypt;
use xh\unity\cog;

//系统函数支持库
class functions
{
    //json解析
    static public function json($Code, $Msg, $array = null)
    {
        header('Content-type: application/json;charset=utf-8');
        exit(json_encode(array("code" => $Code, "msg" => $Msg, "data" => $array), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    //pwd算法
    static public function pwd($pass, $token)
    {
        return substr(md5(md5($pass) . md5($token)), 0, 23);
    }

    // 生成分类树
    static public function category($data, $pId = 0, $pidName = 'pid')
    {
        $tree = array();

        foreach ($data as $k => $v) {
            if ($v[$pidName] == $pId) {
                $v['child'] = self::CATEGORY($data, $v['id']);
                $tree[] = $v;
            }
        }

        return $tree;
    }

    //检测是否手机号
    static public function isMobile($mobile)
    {
        if (preg_match("/^(13[0-9]|14[579]|15[0-3,5-9]|16[6]|17[0135678]|18[0-9]|19[89])\d{8}$/", $mobile)) {
            return true;
        }

        return false;
    }

    //检测是否为邮箱
    static public function isEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }

    //sign算法
    //$key_id 商户KEY
    //$array = array('amount'=>'1.00','out_trade_no'=>'2018123645787452');
    static public function sign($key_id, $array)
    {
        $data = md5(sprintf("%.2f", $array['amount']) . $array['out_trade_no']);
        $cipher = '';
        $key[] = "";
        $box[] = "";
        $pwd_length = strlen($key_id);
        $data_length = strlen($data);
        for ($i = 0; $i < 256; $i++) {
            $key[$i] = ord($key_id[$i % $pwd_length]);
            $box[$i] = $i;
        }
        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $key[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        for ($a = $j = $i = 0; $i < $data_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;

            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;

            $k = $box[(($box[$a] + $box[$j]) % 256)];
            $cipher .= chr(ord($data[$i]) ^ $k);
        }

        return md5($cipher);
    }

    //json-text
    static public function str_json($type, $Code, $Msg, $array = null)
    {
        if ($type == 'json') {
            header('Content-type: application/json;charset=utf-8');
            exit(json_encode(array("code" => $Code, "msg" => $Msg, "data" => $array), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        } else {
            exit($Msg);
        }
    }


    //json解析_加密
    static public function json_encode($Code, $Msg, $array = null, $type = true)
    {
        header('Content-type: application/json;charset=utf-8');
        exit((new encrypt())->Encode(json_encode(array("code" => $Code, "msg" => $Msg, "data" => $array)), cog::read("server")['key']));
    }

    //json解析_加密
    static public function json_encode_pc($Code, $Msg, $array = null, $type = true)
    {
        header('Content-type: application/json;charset=utf-8');
        exit((new encrypt())->Encode(json_encode(array("code" => $Code, "msg" => $Msg, "data" => $array)), PC_KEY));
    }

    static public function getPayUrl($natapp_url, $amount, $mark, $types = 1)
    {
        $type = [
            1 => 'wechat',
            2 => 'alipay'
        ];
        $url = $natapp_url . 'getpay?money=' . $amount . '&mark=' . $mark . '&type=' . $type[$types];

        return json_decode(functions::pay_curl($url));
    }


    //参数1：访问的URL，参数2：post数据(不填则为GET)，参数3：提交的$cookies,参数4：是否返回$cookies
    static public function curlPostRequest($url, $post_data = [])
    {
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        //设置post数据
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);

        //显示获得的数据
        return $data;
    }

    static function pay_curl($url, $data = '')
    {
        $ch = curl_init($url);
        $header[] = 'Mozilla/5.0 (Linux; U; Android 7.1.2; zh-cn; GiONEE F100 Build/N2G47E) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30';
        if (!empty($data)) {
            curl_setopt($ch, 47, 1);
            curl_setopt($ch, 10015, $data);
        }
        curl_setopt($ch, 10023, $header);
        curl_setopt($ch, 64, FALSE); // 对认证证书来源的检查
        curl_setopt($ch, 81, FALSE); // 从证书中检查SSL加密算法是否存在
        curl_setopt($ch, 19913, true);
        curl_setopt($ch, 19914, true);
        curl_setopt($ch, 52, 1);
        curl_setopt($ch, 13, 60);
        ob_start();
        @$data = curl_exec($ch);
        ob_end_clean();
        curl_close($ch);

        return $data;
    }

    static function getAndroidHeartbeatNowTime($time = 180)
    {
        return time() - $time;
    }

    static function getRedisConfig()
    {
        return [
            'port' => REDIS_PORT,
            'host' => REDIS_HOST,
            'auth' => REDIS_AUTH
        ];

    }

    //添加轮循
    static function addRobin($key, $val, $data, $seconds = 60)
    {
        if (!REDIS_ENABLE) return [];
        $redis = redis::getInstance(functions::getRedisConfig());
        if ($redis->ping() == false) return [];
        $score = $redis->zScore($key, $val);
        $range = $redis->zRange($key, 0, -1);

        if (intval($score) > 0) {
            if ($score > count($range)) {
                $redis->zAdd($key, $score + 1, $val);
            } else {
                $redis->zIncrBy($key, 1, $val);
            }
        } else {

            $score = $redis->zScore($key, $range[0]);
            $redis->zAdd($key, intval($score) + 1, $val);
        }

        //将通道信息存到key里面
        return $redis->set($val, json_encode($data), $seconds);
    }

    //从轮循中获取最少的一条
    static function getRobin($key, $seconds = 60)
    {
        if (!REDIS_ENABLE) return [];
        $redis = redis::getInstance(functions::getRedisConfig());
        if ($redis->ping() == false) return [];
        //1.先从集合里面取出一条支付通道
        $range = $redis->zRange($key, 0, -1);

        if (empty($range)) return [];
        $val = $range[0];

        //2.如果有通道，并且该通道值不为空，则将该通道数值+1排到最后
        $account = $redis->get($val);

        //如果为空的话将该通道从集合中删除
        if (empty($account)) {
            $redis->zRem($key, $val);

            return functions::getRobin($key, $val);
        }

        //3.使用该通道，并将该通道数值+1排到最后
        $score = $redis->zScore($key, $val);

        if (intval($score) > 0) {
            if ($score > count($range)) {
                $redis->zAdd($key, $score + 1, $val);
            } else {
                $redis->zIncrBy($key, 1, $val);
            }
        } else {
            $redis->zAdd($key, 1, $val);
        }

        //4.刷新帐号信息
        $redis->set($val, $account, $seconds);

        return json_decode($account, true);
    }


    //删除轮循通道
    static function delRobin($key, $val)
    {
        if (!REDIS_ENABLE) return [];

        $redis = redis::getInstance(functions::getRedisConfig());
        if ($redis->ping() == false) return [];
        $redis->zRem($key, $val);

        return $redis->del($val);
    }

    /**
     * 公共导出
     *
     * @param $name         文件名
     * @param $expCellName  表头名称
     * @param $expTableData 导出的数据
     */
    static function commonExport($name = '', $expCellName = array(), $expTableData = array())
    {
        $data = array();
        $header = $expCellName;
        array_unshift($data, $header);
        //$expTitle文件名
        //$expcellName文件列名
        //$expTableData文件数据
        $xlsTitle = iconv('utf-8', 'gb2312', $name);//文件名称 将字符串从utf-8编码转为gb2312编码
        $fileName = $name . date('YmdHis');//设置文件名称
        $cellNum = count($expCellName);//获取文件的列数
        $dataNum = count($expTableData);//获取数据的条数
//        vendor("PHPExcel.PHPExcel");//导入PHPExcal类库
        require_once(ROOT_PATH . '/extend/library/phpexcel/PHPExcel.php');
        //不加\会提示notfound 原因为引入命名空间
        $objPHPExcel = new \PHPExcel();//生成PHPExcel类实例
        //A-AZ列
        $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');
        // 设置excel文档的属性
        $objPHPExcel->getProperties()->setCreator("Morrowind")//设置文档属性作者
        ->setLastModifiedBy("Morrowind")//设置最后修改人
        ->setTitle("Microsoft Office Excel Document")//设置文档属性标题
        ->setSubject("excel")//设置文档属性文档主题
        ->setDescription("excel")//设置文档属性备注
        ->setKeywords("excel")//设置文档属性关键字
        ->setCategory("excel file");//设置文档属性类别
        /*
         * 合并单元格
         * getActiveSheet(0)设置当前sheet参数为表的索引
         * mergeCells()需要合并单元格的区间
         */
        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:' . $cellName[$cellNum - 1] . '1');
        /*
         * 分解单元格
         */
//        $objPHPExcel->getActiveSheet()->unmergeCells("A1:D1");
        //设置表的名称
        $objPHPExcel->getActiveSheet()->setTitle($name);
        // Set column widths
        //自适应表格宽度
        $objPHPExcel->getActiveSheet()->getColumnDimension("A")->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
        //设置表格宽度
        $objPHPExcel->getActiveSheet()->getColumnDimension("D")->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension("E")->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension("F")->setWidth(20);
        /*
         * 设置font
         */
        //设置字体大小
//        $objPHPExcel->getActiveSheet()->getStyle("B2")->getFont()->setSize(20);
        //字体加粗
//        $objPHPExcel->getActiveSheet()->getStyle("B2")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("B2")->getFont()->setUnderline(\PHPExcel_Style_Font::UNDERLINE_SINGLE);
        /*
         * 设置在第一列显示导出时间导出时间
         */
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $name . '  Export time:' . date('Y-m-d H:i:s'));
        for ($i = 0; $i < $cellNum; $i++) {
            //遍历设置单元格的值 设置列名
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i] . '2', $expCellName[$i][1]);
        }
        // Miscellaneous glyphs, UTF-8
        //让总循环次数小于数据条数
        for ($i = 0; $i < $dataNum; $i++) {
            //让每列的数据数小于列数
            for ($j = 0; $j < $cellNum; $j++) {
                //设置单元格的值
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j] . ($i + 3), $expTableData[$i][$expCellName[$j][0]]);
            }
        }
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="' . $xlsTitle . '.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }


    //设置二维码的值
    static function setOrderCode($key, $val, $time = 3600)
    {
        if (!REDIS_ENABLE) return [];

        $redis = redis::getInstance(self::getRedisConfig());
        if ($redis->ping() == false) return [];

        return $redis->set($key, $val, $time);

    }
    static function getRedis(){
        if (!REDIS_ENABLE) return [];

        return  redis::getInstance(self::getRedisConfig());
    }
    //获取二维码的值
    static function getOrderCode($key)
    {

        if (!REDIS_ENABLE) return [];

        $redis = redis::getInstance(self::getRedisConfig());
        if ($redis->ping() == false) return [];

        $qrcode = $redis->get($key);

        if (empty($qrcode)) {
            $remark = explode('_', $key);

            $mysql = new mysql();
            if ($remark[0] == 'alipay') {
                $order = $mysql->query("client_alipay_automatic_orders", "id={$remark[1]}", 'id,qrcode')[0]['qrcode'];

                if (!empty($order['qrcode'])) {
                    return $order['qrcode'];
                }

            }

            if ($remark[0] == 'wechat') {
                $order = $mysql->query("client_wechat_automatic_orders", "id={$remark[1]}", 'id,qrcode')[0];

                if (!empty($order['qrcode'])) {

                    return $order['qrcode'];
                }

            }

            if ($remark[0] == 'service') {
                $order = $mysql->query("service_order", "id={$remark[1]}", 'id,qrcode')[0];

                if (!empty($order['qrcode'])) {

                    return $order['qrcode'];
                }

            }

        }

        return $qrcode;

    }


    /**
     * 计算代理利益
     */
    static function agentBenefit($uid, $level_id, $type)
    {
        $mysql = new mysql();
        $where = "uid = {$uid} and parent_id = {$level_id}";
        $data = $mysql->query('agent_rate', $where);
        $data = json_decode($data[0]['authority'], true);
        $rate = 0;
        if (!empty($data)) {

            switch ($type) {
                case 1:
                    $rate = $data['wechat_auto'];
                    break;
                case 2:
                    $rate = $data['alipay_auto'];
                    break;
                case 3:
                    $rate = $data['service_auto'];
                    break;
                default:
                    $rate = 0;
            }
        }

        return $rate;
    }


    function getOrderUrl($memo, $user_id, $order_id, $amount)
    {

        $url = GET_ORDER_URL . "api/user/create?address={$_SERVER['HTTP_HOST']}&user_id={$user_id}&out_order_id={$order_id}&amount={$amount}&memo={$memo}&timeout=300";

        return json_decode(file_get_contents($url), true);
    }


    /**
     * 同步请求
     *
     * @param  string $image key
     * @param  int 超时时间
     *
     * @return array
     */
    public static function syncRequest($key, $timeout = 10000)
    {

        $count = ceil($timeout / 1000);
        for ($i = 0; $i < $count; $i++) {
            $qrcode = self::getOrderCode($key);
            // 完成
            if ($qrcode) break;
            sleep(1);
        }

        return $qrcode;
    }

    static function png($value, $name = '', $errorCorrectionLevel = "L", $matrixPointSize = 6)
    {
        require_once ROOT_PATH . "/extend/unity/phpqrcode/phpqrcode.php";

        $path = PATH_STATIC . "/qrcode/";
        $dir = File::create_dir($path);
        if ($dir) {
            if (empty($name)) $name = time() . md5(uniqid(rand())) . ".png";

            \QRcode::png($value, $path . $name, $errorCorrectionLevel, $matrixPointSize, 2);

            return URL_ROOT . "/static/qrcode/" . $name;
        }

        return '';

    }
}