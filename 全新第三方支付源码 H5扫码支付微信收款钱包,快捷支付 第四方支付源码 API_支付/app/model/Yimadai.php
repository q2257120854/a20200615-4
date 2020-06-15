<?php
namespace WY\app\model;

use WY\app\libs\Http;
use WY\app\libs\Xml;
if (!defined('WY_ROOT')) {
    exit;
}
class Yimadai
{
    function __construct()
    {
        $this->gateUrl = 'https://gwapi.yemadai.com/transfer/transferapi';
        $this->notifyurl = 'http://' . $_SERVER['HTTP_HOST'] . '/yimadai';
        $this->accountNumber = '22820';
        $this->key = 'OGdkk9F9adfl72kDk3';
    }
    public function put($data)
    {
        extract($data);
        $sign = strtoupper(md5('transId=' . $sn . '&accountNumber=' . $this->accountNumber . '&cardNo=' . $cardno . '&amount=' . $money . '&' . $this->key));
        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
        $xml .= '<yemadai>';
        $xml .= ' <accountNumber>' . $this->accountNumber . '</accountNumber>';
        $xml .= ' <notifyURL>' . $this->notifyurl . '</notifyURL>';
        $xml .= ' <tt>0</tt>';
        $xml .= ' <transferList>';
        $xml .= '  <transId>' . $sn . '</transId>';
        $xml .= '  <bankCode>' . $bankname . '</bankCode>';
        $xml .= '  <provice>' . $provice . '</provice>';
        $xml .= '  <city>' . $city . '</city>';
        $xml .= '  <branchName>' . $branchname . '</branchName>';
        $xml .= '  <accountName>' . $accountname . '</accountName>';
        $xml .= '  <cardNo>' . $cardno . '</cardNo>';
        $xml .= '  <amount>' . $money . '</amount>';
        $xml .= '  <remark>test</remark>';
        $xml .= '  <secureCode>' . $sign . '</secureCode>';
        $xml .= ' </transferList>';
        $xml .= '</yemadai>';
        $data = array('transData' => base64_encode($xml));
        $http = new Http($this->gateUrl, $data, 1);
        $http->toUrl();
        $ret = base64_decode($http->getResContent());
        $ret = str_replace('<transferList>', '', $ret);
        $ret = str_replace('</transferList>', '', $ret);
        $result = Xml::parseXml($ret);
        $resCode = $result['errCode'] == '0000' ? $result['resCode'] : $result['errCode'];
        if ($http->getResCode() == '200') {
            $ret = array('resCode' => $resCode, 'resContent' => $this->getRet($resCode));
        } else {
            $ret = array('resCode' => $http->getResCode(), 'resContent' => $this->res->subString($http->getErrInfo(), 0, 20));
        }
        return $ret;
    }
    public function getRet($code)
    {
        $codeList = array('0000' => '请求成功', 'ERR1001' => 'IP白名单未绑定', 'ERR1002' => 'xml格式错误', 'ERR1003' => 'secureCode验证错误', 'ERR1004' => '最大转账笔数超过50笔或者小于1笔', 'ERR1005' => '含有必要参数为空', 'ERR1006' => 'Base64解析错误', 'ERR1007' => '账户错误或者不存在此账户', 'ERR1008' => '金额小于0', 'ERR1009' => '金额错误', 'ERR1010' => '余额不足', 'ERR1011' => '系统异常', 'ERR1012' => '订单号重复', 'ERR2001' => '开户名与卡号不匹配', 'ERR2002' => '开户行与卡号不匹配', 'ERR2003' => '省、市信息不匹配', 'ERR5002' => '商户未开通下发权限', 'ERR5003' => '下发超过单笔限额设置', 'ERR5005' => '商户下发超过单日限额');
        return array_key_exists($code, $codeList) ? $codeList[$code] : '未知错误';
    }
}