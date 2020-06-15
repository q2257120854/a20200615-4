<?php
/* PHP CURL HTTPS POST */
function yilepost($url, $data)
{
    // 模拟提交数据函数
    $curl = curl_init();
    // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url);
    // 要访问的地址
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    // 对认证证书来源的检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);
    // 从证书中检查SSL加密算法是否存在
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    // 模拟用户使用的浏览器
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    // 使用自动跳转
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
    // 自动设置Referer
    curl_setopt($curl, CURLOPT_POST, 1);
    // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    // Post提交的数据包
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    // 设置超时限制防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0);
    // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // 获取的信息以文件流的形式返回
    $tmpInfo = curl_exec($curl);
    // 执行操作
    if (curl_errno($curl)) {
        echo 'Errno' . curl_error($curl);
        //捕抓异常
    }
    curl_close($curl);
    // 关闭CURL会话
    return $tmpInfo;
    // 返回数据，json格式
}
function getCurl($url, $post = 0, $referer = 0, $cookie = 0, $header = 0, $ua = 0, $nobaody = 0)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $http[] = "Accept:*";
    $http[] = "Accept-Encoding:gzip,deflate,sdch";
    $http[] = "Accept-Language:zh-CN,zh;q=0.8";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $http);
    if ($post) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    if ($header) {
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
    }
    if ($cookie) {
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    }
    if ($referer) {
        curl_setopt($ch, CURLOPT_REFERER, $referer);
    }
    if ($ua) {
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    } else {
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36');
    }
    if ($nobaody) {
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        //主要头部
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);//跟随重定向
    }
    curl_setopt($ch, CURLOPT_ENCODING, "gzip");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $ret = curl_exec($ch);
    curl_close($ch);
    return $ret;
}
function login95($domain, $user, $pass)
{
    $get = getCurl("http://{$domain}/index.php?m=Home&c=User&a=login", "username={$user}&username_password={$pass}", 0, 0, 1);
    if (strpos($get, "登录成功")) {
        if (preg_match_all('/Set-Cookie:\\s?([A-Za-z0-9\\_=\\|]+);/is', $get, $arr2)) {
            $cookie = null;
            foreach ($arr2['1'] as $item) {
                $cookie .= $item . ';';
            }
            return $cookie;
        }
    }
    return false;
}
function get95Post($goods, $domain, $user = null, $pass = null)
{
    $result['code'] = -1;
	if (!($cookie = login95($domain, $user, $pass))) {
            return '账号或者密码错误';
        } else {
            $cookie = base64_encode($cookie);
            setcookie('jiuwuurl', $domain, time() + 3600 * 24, '/');
            setcookie('api_cookie', $cookie, time() + 3600 * 24, '/');
    $cookie = isset($_COOKIE['api_cookie']) ? base64_decode($_COOKIE['api_cookie']) : null;
		}
    $get = getCurl("http://{$domain}/index.php?m=Home&c=Goods&a=detail&id={$goods}", 0, 0, $cookie);
    $start = strpos($get, 'action="/index.php?m=home&c=order');
    $end = strpos($get, 'name="pay_type');
    if ($start > 1 && $end > 1) {
        $get = substr($get, $start, $end - $start);
        if (preg_match_all('/name="([a-z0-9A-Z\\_\\-]+)"/is', $get, $arr)) {
            $post = "";
            foreach ($arr[1] as $k => $item) {
                if ($item == 'need_num_0') {
                    //$post .= "{$item}=[num]&";
                    continue;
                } elseif ($item == 'goods_id') {
                    //$post .= "{$item}={$goods['id']}&";
                    continue;
                } elseif ($item == 'goods_type') {
                    //$post .= "{$item}={$goods['type']}&";
                    continue;
                } else {
                    $i = $k + 1;
                    $post .= "{$item}|";
                }
            }
            $post = trim($post, '|');
            $result = ['code' => 0, 'message' => '获取POST数据成功', 'param' => $post];
        } else {
            $result['message'] = '匹配商品POST数据失败';
        }
    } else {
        $result['message'] = '获取商品POST数据失败';
    }
    return $result;
}
function get95Goods($domain, $user, $pass)
{
    $get = getCurl("http://" . $domain . "/index.php");
    if (strlen($get) < 1024) {
        return '打开对接网站失败';
    } elseif (preg_match_all('/href="\\/index\\.php\\?m=home&c=goods&a=detail&id=(\\d+)&goods\\_type=(\\d+)"\\>(.*?)alt="(.*?)"/is', $get, $arr) || preg_match_all('/href="\\/index\\.php\\?m=home&c=goods&a=detail&id=(\\d+)&goods\\_type=(\\d+)"\\>(.*?)>([^>]*?)<\\/h4>/is', $get, $arr)) {
        if (!($cookie = login95($domain, $user, $pass))) {
            return '账号或者密码错误';
        } else {
            $cookie = base64_encode($cookie);
            setcookie('jiuwuurl', $domain, time() + 3600 * 24, '/');
            setcookie('api_cookie', $cookie, time() + 3600 * 24, '/');
            $list = array();
            foreach ($arr[1] as $k => $v) {
                $list[] = array('id' => $v, 'type' => $arr[2][$k], 'name' => $arr[4][$k]);
            }
            return $list;
        }
    } else {
        return '获取商品列表失败';
    }
}
function getyileGoods($domain, $user, $pass)
{
    $url = "http://" . $domain . "/api/web/getGoodsList.html";
    $ret = getCurl($url);
    if (!($ret = json_decode($ret, true))) {
        return '打开对接网站失败';
    } elseif ($ret['code'] !== 0) {
        return $ret['message'];
    } else {
        $list = [];
        foreach ($ret['list'] as $v) {
            $post = '';
            foreach ($v['post'] as $k => $p) {
                if (!in_array($p['param'], ['number', 'goodsid'])) {
                    $post .= "{$p['param']}|";
                }
            }
            $post = trim($post, '|');
            $list[] = array('id' => $v['goodsid'], 'type' => $v['modelid'], 'name' => $v['name'], 'param' => $post);
        }
        return $list;
    }
}
//亿乐3.0
function getyileshop($domain)
{
    $ret = $domain;
    if (!($ret = json_decode($ret, true))) {
        return '打开对接网站失败';
    } elseif ($ret['status'] !== 0) {
        return $ret['message'];
    } else {
        $list = [];
        foreach ($ret['data'] as $v) {
            $post = '';
            foreach ($v['post'] as $k => $p) {
                if (!in_array($p['param'], ['number', 'goodsid'])) {
                    $post .= "{$p['param']}|";
                }
            }
            $post = trim($post, '|');
            $list[] = array('id' => $v['gid'], 'type' => $v['cid'], 'name' => $v['name'], 'param' => $post);
        }
        return $list;
    }
}
//聚梦
function getjmshop($domain)
{
    $ret = $domain;
    if (!($ret = json_decode($ret, true))) {
        return '打开对接网站失败';
    } elseif ($ret['status'] !== 1) {
        return $ret['content'];
    } else {
        $list = [];
        foreach ($ret['GoodsLit'] as $v) {
            $post = '';
            foreach ($v['post'] as $k => $p) {
                if (!in_array($p['param'], ['number', 'Id'])) {
                    $post .= "{$p['param']}|";
                }
            }
            $post = trim($post, '|');
            $list[] = array('id' => $v['Id'], 'type' => $v['Class'], 'name' => $v['Name'], 'param' => $post);
        }
        return $list;
    }
}
function jumeng_goodslist($url, $user, $pwd)
{
	$_var_3 = "http://" . $url . ".api.jumsq.com/Api/UserApi/GoodsList.html";
	$_var_4 = array("username" => $user, "time" => time());
	$_var_5 = getSign($_var_4, $pwd);
	$_var_4["sign"] = $_var_5;
	$_var_6 = http_build_query($_var_4);
	$_var_7 = yilepost($_var_3, $_var_6);
	if (!($_var_7 = json_decode($_var_7, true))) {
		return "打开对接网站失败";
	}
	if ($_var_7["status"] != 1) {
		return $_var_7["content"];
	}
	$_var_8 = array();
	foreach ($_var_7["GoodsLit"] as $_var_9) {
			if(strpos($_var_9["Img_Url"],'http')==false){
			if(substr($_var_9["Img_Url"], 0, 1)!='/'){$_var_9["Img_Url"]="http://img.cdn.liurh.cn/".$_var_9["Img_Url"];}
			else
			{$_var_9["Img_Url"]="http://img.cdn.liurh.cn".$_var_9["Img_Url"];}
			}
		$_var_8[] = array("id" => $_var_9["Id"], "gid" => $_var_9["Id"], "name" => $_var_9["Name"], "shopimg" => $_var_9["Img_Url"], "close" => $_var_9["AddStatus"], "minnum" => $_var_9["OrderMin"], "maxnum" => $_var_9["OrderMax"],  "price" => $_var_9["Money"]);
	}
	return $_var_8;
}
function yile_goodslist($url, $user, $pwd)
{
	$_var_3 = "http://" . $url . ".api.94sq.cn/api/goods/list";
	$_var_4 = array("api_token" => $user, "timestamp" => time());
	$_var_5 = getSign($_var_4, $pwd);
	$_var_4["sign"] = $_var_5;
	$_var_6 = http_build_query($_var_4);
	$_var_7 = yilepost($_var_3, $_var_6);
	if (!($_var_7 = json_decode($_var_7, true))) {
		return "打开对接网站失败";
	}
	if ($_var_7["status"] !== 0) {
		return $_var_7["message"];
	}
	$_var_8 = array();
	foreach ($_var_7["data"] as $_var_9) {
		$_var_8[] = array("id" => $_var_9["gid"], "gid" => $_var_9["gid"], "name" => $_var_9["name"], "shopimg" => $_var_7["image"], "close" => $_var_7["close"],  "price" => $_var_9["price"]);
	}
	return $_var_8;
}
function getSign($param, $key)
{
    $signPars = "";
    ksort($param);
    foreach ($param as $k => $v) {
        if ("sign" != $k && "" != $v) {
            $signPars .= $k . "=" . $v . "&";
        }
    }
    $signPars = trim($signPars, '&');
    $signPars .= $key;
    $sign = md5($signPars);
    return $sign;
}
function get95sj($domain, $user = null, $pass = null)
{
    $get = getCurl("http://api.skywl.cc/api.php?url={$domain}&user={$user}&pwd={$pass}&type=jiuwu");
    return $get;
}
function jiuwu_login($_arg_0, $_arg_1, $_arg_2)
{
	$_var_3 = getCurl("http://" . $_arg_0 . "/index.php?m=Home&c=User&a=login", "username=" . urlencode($_arg_1) . "&username_password=" . urlencode($_arg_2), 0, 0, 1);
	if (strpos($_var_3, "登录成功")) {
		if (preg_match_all("/Set-Cookie:\\s?([A-Za-z0-9\\_=\\|]+);/is", $_var_3, $_var_4)) {
			$_var_5 = NULL;
			foreach ($_var_4["1"] as $_var_6) {
				$_var_5 = $_var_5 . ($_var_6 . ";");
			}
			$_var_7 = base64_encode($_var_5);
			$_SESSION["api_cookie"] = $_var_7;
			return $_var_5;
		}
	}
	return false;
}

function jiuwu_goodsparam($_arg_0, $_arg_1, $_arg_2, $_arg_3)
{
	$_var_4["code"] = -1;
	$_var_5 = isset($_SESSION["api_cookie"]) ? base64_decode($_SESSION["api_cookie"]) : NULL;
	if (!$_var_5) {
		if (!($_var_5 = jiuwu_login($_arg_0, $_arg_2, $_arg_3))) {
			return "账号或者密码错误";
		}
	}
	$_var_6 = getCurl("http://" . $_arg_0 . "/index.php?m=Home&c=Goods&a=detail&id=" . $_arg_1, 0, 0, $_var_5);
	if (strpos($_var_6, "帐号登录")) {
		if ($_var_5 = jiuwu_login($_arg_0, $_arg_2, $_arg_3)) {
			$_var_6 = getCurl("http://" . $_arg_0 . "/index.php?m=Home&c=Goods&a=detail&id=" . $_arg_1, 0, 0, $_var_5);
		} else {
			return "账号或者密码错误";
		}
	}
	$_var_7 = strpos($_var_6, "action=\"/index.php?m=home&c=order");
	$_var_8 = strpos($_var_6, "name=\"pay_type");
	if ($_var_7 > 1 && $_var_8 > 1) {
		$_var_9 = substr($_var_6, $_var_7, $_var_8 - $_var_7);
		if (preg_match_all("/name=\"([a-z0-9A-Z\\_\\-]+)\"/is", $_var_9, $_var_10)) {
			$_var_11 = '';
			foreach ($_var_10[1] as $_var_12 => $_var_13) {
				if ($_var_13 != "need_num_0" && $_var_13 != "goods_id" && $_var_13 != "goods_type" && $_var_13 != "ssnr" && $_var_13 != "qmkg_url" && $_var_13 != "kszp_url" && $_var_13 != "kszy_url" && $_var_13 != "kszp_dwz") {
					$_var_11 = $_var_11 . ($_var_13 . "|");
				}
			}
			$_var_11 = trim($_var_11, "|");
			preg_match("/现金单价：<\\/span><span  title=\".*?\">(.*?)<\\/span>/", $_var_6, $_var_14);
			$_var_4 = array("code" => 0, "message" => "succ", "price" => $_var_14[1], "param" => $_var_11);
		} else {
			$_var_4["code"] = -1;
			$_var_4["msg"] = "匹配商品POST数据失败";
		}
	} else {
		$_var_4["code"] = -1;
		$_var_4["msg"] = "获取商品POST数据失败";
	}
	return $_var_4;
}
function jiuwu_goodslist_details($url, $user, $pwd) {
    $_var_3 = "http://" . $url . "/index.php?m=home&c=api&a=user_get_goods_lists_details&Api_UserName=" . urlencode($user) . "&Api_UserMd5Pass=" . md5($pwd);
    $_var_4 = getCurl($_var_3);
    if (!($_var_4 = json_decode($_var_4, true))) {
        return "打开对接网站失败";
    }
    if ($_var_4["status"] !== true) {
        return $_var_4["msg"];
    }
    $_var_5 = array();
    foreach ($_var_4["user_goods_lists_details"] as $_var_6) {
        $_var_5[] = array("id" => $_var_6["id"], "type" => $_var_6["goods_type"], "name" => $_var_6["title"], "shopimg" => "https://all-pt-upyun-cdn.95at.cn" . $_var_6["thumb"], "minnum" => $_var_6["minbuynum_0"], "maxnum" => $_var_6["maxbuynum_0"], "price" => $_var_6["user_unitprice"], "close" => $_var_6["goods_status"]);
    }
    return $_var_5;
}