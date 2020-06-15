<?php
namespace xh\unity;
use xh\private_\signaturehelper;
//短信验证码接口
//采用的阿里云短信平台
class sms{
    
    function __construct(){
        //载入阿里云官方的sdk
        require (PATH_PRIVATE .  'signaturehelper.php');
    }
    
    //发送验证码
    function send($phone,$code){
        $params = array ();
        // *** 需用户填写部分 ***
        // fixme 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
        $accessKeyId = cog::read('smsCog')['accessKeyId'];
        $accessKeySecret = cog::read('smsCog')['accessKeySecret'];
        // fixme 必填: 短信接收号码
        $params["PhoneNumbers"] = $phone;
        // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] = cog::read('smsCog')['SignName'];
        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = cog::read('smsCog')['TemplateCode'];
        // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
        $params['TemplateParam'] = Array ("code" => $code);
        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"]);
        }
        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new signaturehelper();
        // 此处可能会抛出异常，注意catch
        $content = $helper->request(
            $accessKeyId,
            $accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            ))
            );
        return $content;
    }
    
    //发送异常通知
    function sendError($phone,$name){
        $params = array ();
        // *** 需用户填写部分 ***
        // fixme 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
        $accessKeyId = cog::read('smsCog')['accessKeyId'];
        $accessKeySecret = cog::read('smsCog')['accessKeySecret'];
        // fixme 必填: 短信接收号码
        $params["PhoneNumbers"] = $phone;
        // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] = cog::read('smsCog')['SignName'];
        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = cog::read('smsCog')['TemplateErrorCode'];
        // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
        $params['TemplateParam'] = Array ("name" => $name,"time"=>date("Y/m/d H:i:s",time()));
        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"]);
        }
        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new signaturehelper();
        // 此处可能会抛出异常，注意catch
        $content = $helper->request(
            $accessKeyId,
            $accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            ))
            );
        return $content;
    }
    
    
    //发送平台更新维护通知
    function sendDefend($phone,$time,$name,$restore_time,$content){
        $params = array ();
        // *** 需用户填写部分 ***
        // fixme 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
        $accessKeyId = cog::read('smsCog')['accessKeyId'];
        $accessKeySecret = cog::read('smsCog')['accessKeySecret'];
        // fixme 必填: 短信接收号码
        $params["PhoneNumbers"] = $phone;
        // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] = cog::read('smsCog')['SignName'];
        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = cog::read('smsCog')['TemplateDefend'];
        // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
        $params['TemplateParam'] = Array (
            "time" => $time,
            "name" => $name,
            "restore" => $restore_time,
            "content" => $content
            );
        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"]);
        }
        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new signaturehelper();
        // 此处可能会抛出异常，注意catch
        $content = $helper->request(
            $accessKeyId,
            $accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            ))
            );
        return $content;
    }
    
}