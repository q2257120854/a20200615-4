<?php
require 'inc.php';
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2017040706583140",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEowIBAAKCAQEA0d9AKsM7D4UJTMnsIXU0Xtz3l3DM8GDa2zM+zYt2rHHmQXkYFIgzqJUi5i97RNn+E0i8oYtrTEXpr7eUpsBvpRsQvh22H/aIhY96LZCGVQAFxdRov/6EG52pkHMin1CXeKPVoxqqsTYH5lmy0p6HqhrXZAdzVSPuqCvNX5+eWl/zHW0NdTqdl9ZsgFVnxsY+f6fc1vvpJSrjFs1q5LmgeJBJj+hfc1Bv6r/O7KlMhODTiDGO/z89fABFrntywIrq7Lq0h/2t85e3RdzF6I8yy4mLXdkC55B9we164kjIfCjye3Ir/fptZaak1dGUPmM8tWPQJMAOLo05pKvpPUpYIwIDAQABAoIBAGGasU3x8/K4zWVv9yhsSMnhfChrJnSYptAQ2iFfvfZfFlXWynMqENRTX6Kr7GlN9JLlXgzHOUSEszSsbS7MCmA/4R551OyyjDWJT6oHL+IyG30w1vKLnMb3IRfz4+Mx6PALSd0MFtxJo4zmpHq9jZx31TpJGMM87c46aM4S/uNKKeiCA8zQW8DXLxtGU6B9/cRBEAyvVI+yOdsE2QLY/rf0D+aaZE2vWcfsMjA6svHpI9zFHc+snDEDJw53D4urQUBzKZSAe5jercM1luJx1VhNkk8yUYEBIYSfNs2D7wgx74yvmuHq2SirSvo2wZtMINW/U+KEEM/1+tlNUOjZSWkCgYEA/RuSxr2AEFKE0DuMtQI9lRrlxwOnSCbfSBO7c3srZeWFCmokiJhZKGQreQR69YiZ1FTUn79ywcHfyg8so4rzZHFdN9W4Bmj5Ypdar2lo5ENPjFXXgMzfy5GlWiCLRjR9BUKN/mmWMwRuwxHd4OCs/2FvFrVNkrZaBVNVARMu+AcCgYEA1EUywm5rP/8I21WprCJDlZPniOwWm1/A2qR44cUkBA4x+gqf6H45frb3so4kazjz3yQ8d3g4ogOO9RQMNjyMUkh++XyKra/O1Ly5n23Q5ZUpfJFrnBje4yzKOFGjVRMCOxg5tgMlXhsQbOCng0WKh2Sz4ISsJgyXRBSpfqTEgAUCgYBwbqcskVEp7v4AYfOHFI+2hFQ9q2nLqzjUE6/ZBIWqpeILVksUQliYkKafA1Z7a0qp/2TT8X9Qgoaeg08Y9shXfeQiwVUVw9vD5+fos7Jcc2oKtLceB+QB0ZjaCErVzMscYwwgT1bhIr7w+CbPlf5DE0z9kVv8J/SlGPdRmuvqUQKBgAHMMDjbTIc3NrD80boGdEIRBZXwQeTA89YmLGvlCoAKSrwOWPpUD1KWZBScBYzu54nNOcHdP8WHeC91IwFWk+2idYjRWC9OXNcKXhwOhwVatQY8CQhCYajU2UWO025GAe/ULbDv5+IbIpF5eZGwBhNNdASDux17X9CQyDqtVIitAoGBAPQKS35rsmA8so194cCbzXUxGcK3en1e5/e+HS2dBHODYtSIrGtq43LPRzOxYbEGAz16V4sWU76UKe/Jv8cZvA4uvDp85ex2OJLAn+kldsiixX/7I5vBqLXjNxS9mkxqwU1/UabVWwVry3TkNQD/G5U49D9TSCu/bM/3zLhLnTxH",
		
		//异步通知地址
		'notify_url' => "http://b.olzc.net/pay/aliwap_alipaywap/notify_url.php",
		
		//同步跳转
		'return_url' => "http://b.olzc.net/pay/aliwap_alipaywap/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA1bBDAlMLUpAAQFIbheGZtVrIt3KHK9ehw1F8xXBMZP8+pPbr0T1yCuaABH8puSvP1BLBjD9yK96Vgn77V0fVL7OH6PRHvkDK6f4q0sJOOBFKVhez7EHBlCnB2KOEcyKZBA50sdCeNlDZ7PJacRAOEb+v9W5OlmyuefIvhdJCvPicazmoqZiPIDYJrJX8OcPy+zv/8QBcBwZWYHKxwycqYcrdnm8HwaGc/2EFSy3VaoI5slvzsLRiaoJpMFLsF/6gQjwTSXAQQ8drVTLD7NDserMqxAhiQcvlyXa22ox4S5Rv4D73VXWwkoWoyypHuw+6Da/aEWrvESOSXcSHc74I3QIDAQAB",
		
	
);