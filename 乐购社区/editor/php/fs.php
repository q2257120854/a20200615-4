<?php
 require_once '../../back233/autoload.php';
	   use OSS\OssClient;
use OSS\Core\OssException;
// 阿里云主账号AccessKey拥有所有API的访问权限，风险很高。强烈建议您创建并使用RAM账号进行API访问或日常运维，请登录 https://ram.console.aliyun.com 创建RAM账号。
$accessKeyId = "LTAIXNNctihhR9qB";
$accessKeySecret = "J6EgSin3XIvhG5XSURUEyYJqzmb2I0";
// Endpoint以杭州为例，其它Region请按实际情况填写。
$endpoint = "http://oss-cn-shanghai.aliyuncs.com";
// 存储空间名称
$bucket= "cmsq233";
// 文件名称
try{
    $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);

    $ossClient->uploadFile($bucket, $object, $filePath);
} catch(OssException $e) {
    #printf(__FUNCTION__ . ": FAILED\n");
    #printf($e->getMessage() . "\n");
    return;
}
#print(__FUNCTION__ . ": OK" . "\n");