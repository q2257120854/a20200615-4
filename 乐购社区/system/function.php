<?php
function daddslashes($string, $force = 0, $strip = FALSE) {
	!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	if(!MAGIC_QUOTES_GPC || $force) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = daddslashes($val, $force, $strip);
			}
		} else {
			$string = addslashes($strip ? stripslashes($string) : $string);
		}
	}
	return $string;
}
//卡密商品库存
function get_kmshop($t0, $t1)
{
    $result = mysql_query('select count(*)  as kucun  from  ' . flag . 'shopkm where sid =' . $t0 . '   and zt = 0  and zid = ' . $t1 . ' ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row['kucun'];
    } else {
        return '0';
    }
}
function get_curl($url, $post = 0, $referer = 0, $cookie = 0, $header = 0, $ua = 0, $nobaody = 0)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $klsf[] = "Accept:*";
    $klsf[] = "Accept-Encoding:gzip,deflate,sdch";
    $klsf[] = "Accept-Language:zh-CN,zh;q=0.8";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $klsf);
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
//获取对接平台信息
function get_duijie($t0, $t1)
{
    $result = mysql_query('select *   from  ' . flag . 'duijie where ID =' . $t1 . '   ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row[$t0];
    } else {
        return '不存在';
    }
}
function json($code, $message = '', $data = array())
{
    if (!is_numeric($code)) {
        return '';
    }
    $result = array('code' => $code, 'message' => $message, 'data' => $data);
    echo json_encode($result);
    exit;
}
function kelongapi($url, $key)
{
    $sql = 'SELECT * FROM `' . flag . 'zhuzhan_domain` WHERE `name` LIKE ';
    $wzsql = $sql . " " . "'{$url}'";
    $result1 = mysql_query($wzsql);
    $row1s = mysql_fetch_array($result1);
    $result = mysql_query('select * from ' . flag . 'zhuzhan where ID like ' . $row1s['zid'] . ' ');
    $rows = mysql_fetch_array($result);
	$get = getCurl("http://" . $url . "/api/kelongapi.php?copy_key={$key}&act=copys");
    if ($rows['kelongkey'] != $key and $get=='') {
        json(1, '克隆密匙不匹配', 1);
    }
}
//获取主站版本相关信息
function get_zhuzhan_banben($t0, $t1)
{
    $result = mysql_query('select *   from  ' . flag . 'zhuzhan_banben where ID =' . $t1 . '   ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row[$t0];
    } else {
        return '不存在';
    }
}
//获取主站信息
function get_zhuzhan($t0, $t1)
{
    $result = mysql_query('select *   from  ' . flag . 'zhuzhan where ID =' . $t1 . '   ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row[$t0];
    } else {
        return '不存在';
    }
}
//获取主站名称
function get_zhuzhanname($t0)
{
    $result = mysql_query('select *   from  ' . flag . 'zhuzhan where ID =' . $t0 . '   ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row['name'];
    } else {
        return '不存在';
    }
}
//获取主站版本名称
function get_zhuzhan_banben_name($t0)
{
    $result = mysql_query('select *   from  ' . flag . 'zhuzhan_banben where ID =' . $t0 . '   ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row['name'];
    } else {
        return '不存在';
    }
}
//获取主站版本权限
function get_zhuzhan_banben_qx($t0)
{
    $result = mysql_query('select *   from  ' . flag . 'zhuzhan_banben where ID =' . $t0 . '   ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row['qx'];
    } else {
        return '不存在';
    }
}
//获取分站版本权限
function get_fenzhan_banben_qx($t0)
{
    $result = mysql_query('select *   from  ' . flag . 'fenzhan_banben where ID =' . $t0 . '   ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row['qx'];
    } else {
        return '不存在';
    }
}
//获取主站续费价格
function get_zhuzhan_banben_price($t0)
{
    $result = mysql_query('select *   from  ' . flag . 'zhuzhan_banben where ID =' . $t0 . '   ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row['price'];
    } else {
        return '0';
    }
}
//获取主站版本相关信息
function get_zhuzhan_banben_info($t0, $t1)
{
    $result = mysql_query('select *   from  ' . flag . 'zhuzhan_banben where ID =' . $t1 . '   ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row[$t0];
    } else {
        return '0';
    }
}
//获取用户相关信息
function get_user_info($t0, $t1)
{
    $result = mysql_query('select *   from  ' . flag . 'user where ID =' . $t1 . '   ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row[$t0];
    } else {
        return '0';
    }
}
//获取分站版本名称
function get_fenzhan_banben_name($t0)
{
    $result = mysql_query('select *   from  ' . flag . 'fenzhan_banben where ID =' . $t0 . '   ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row['name'];
    } else {
        return '不存在';
    }
}
//获取分站价格
function get_fenzhan_price($t0, $t1)
{
    $result = mysql_query('select *   from  ' . flag . 'zhuzhan where ID =' . $t0 . '   ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row[$t1];
    } else {
        return '不存在';
    }
}
//获取分站信息
function get_fenzhan($t0, $t1)
{
    $result = mysql_query('select *   from  ' . flag . 'fenzhan where ID =' . $t1 . '   ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row[$t0];
    } else {
        return '不存在';
    }
}
//获取下单模板
function get_moban($t0)
{
    $result = mysql_query('select *   from  ' . flag . 'moban where ID =' . $t0 . '   ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row['name'];
    } else {
        return '不存在';
    }
}
//商品信息
function get_shop($t0, $t1)
{
    $result = mysql_query('select *   from  ' . flag . 'shop where ID =' . $t0 . '   ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row[$t1];
    } else {
        return '不存在';
    }
}
//分站商品
function get_fshop($t0, $t1, $t2)
{
    $result = mysql_query('select *   from  ' . flag . 'fshop where sid =' . $t0 . '  and fid = ' . $t2 . '  ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row[$t1];
    } else {
        return '不存在';
    }
}
//获取价格模板
function get_price($t0, $t1)
{
    $result = mysql_query('select *   from  ' . flag . 'price where ID =' . $t0 . '   and  fid = ' . $t1 . ' ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row['p_name'];
    } else {
        return '<font color="red">未定价</font>';
    }
}
//获取商品分类
function get_shop_channel($t0)
{
    $result = mysql_query('select *   from  ' . flag . 'shop_channel where ID =' . $t0 . '   ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row['name'];
    } else {
        return '不存在';
    }
}
function xiaoyewl_url()
{
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}
function copy_dir($src, $dst)
{
    $dir = opendir($src);
    @mkdir($dst);
    while (false !== ($file = readdir($dir))) {
        if ($file != '.' && $file != '..') {
            if (is_dir($src . '/' . $file)) {
                copy_dir($src . '/' . $file, $dst . '/' . $file);
                continue;
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}
function del_DirAndFile($dirName)
{
    if (is_dir($dirName)) {
        echo "<br /> ";
        if ($handle = opendir("{$dirName}")) {
            while (false !== ($item = readdir($handle))) {
                if ($item != "." && $item != "..") {
                    if (is_dir("{$dirName}/{$item}")) {
                        del_DirAndFile("{$dirName}/{$item}");
                    } else {
                        if (unlink("{$dirName}/{$item}")) {
                        }
                        //echo "已删除文件: $dirName/$item<br /> ";
                    }
                }
            }
            closedir($handle);
            if (rmdir($dirName)) {
            }
            //echo "已删除目录: $dirName<br /> ";
        }
    }
}
//获取用户当前余额
function get_member_point($t0)
{
    $result = mysql_query('select   *  from ' . flag . 'user where ID = ' . $t0 . '  order by  ID DESC ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row['point'];
    } else {
        return '0';
    }
}
//订单统计
function get_order1($t0, $t1)
{
    $result = mysql_query('select    count(*) as sl  from ' . flag . 'order where sid = ' . $t0 . '  and zid = ' . $t1 . '  order by  ID DESC ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row['sl'];
    } else {
        return '0';
    }
}
//订单统计按状态
function get_order11($t0, $t1, $t2)
{
    $result = mysql_query('select    count(*) as sl  from ' . flag . 'order where sid = ' . $t0 . ' and zt =' . $t1 . '  and zid =' . $t2 . '  order by  ID DESC ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row['sl'];
    } else {
        return '0';
    }
}
//销售统计
function get_order2($t0, $t1)
{
    $result = mysql_query('select    sum(price) as sl  from ' . flag . 'order where sid = ' . $t0 . '  and zid = ' . $t1 . '  order by  ID DESC ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row['sl'];
    } else {
        return '0';
    }
}
//销售统计
function get_order22($t0, $t1)
{
    $result = mysql_query('select    sum(price) as sl  from ' . flag . 'order where sid = ' . $t0 . ' and day(date)= ' . date('d') . '  and zid = ' . $t1 . '  order by  ID DESC ');
    if (!!($row = mysql_fetch_array($result))) {
        return $row['sl'];
    } else {
        return 0;
    }
}
//保留小数
function get_xiaoshu($t0, $t1)
{
    return number_format($t0, $t1);
}
//权限检测
function check_qx($t0, $t1)
{
    if (strpos($t0, $t1) !== false) {
    } else {
        die('权限不足');
    }
}
function regular_domain1($domain)
{
  if (substr ( $domain, 0, 7 ) == 'http://') {
    $domain = substr ( $domain, 7 );
  }
  if (strpos ( $domain, '/' ) !== false) {
    $domain = substr ( $domain, 0, strpos ( $domain, '/' ) );
  }
  return strtolower ( $domain );
}
function top_url($domain) {
  $domain = regular_domain1 ( $domain );
  $iana_root = array (
      'ac',
      'ad',
      'ae',
      'aero',
      'af',
      'ag',
      'ai',
      'al',
      'am',
      'an',
      'ao',
      'aq',
      'ar',
      'arpa',
      'as',
      'asia',
      'at',
      'au',
      'aw',
      'ax',
      'az',
      'ba',
      'bb',
      'bd',
      'be',
      'bf',
      'bg',
      'bh',
      'bi',
      'biz',
      'bj',
      'bl',
      'bm',
      'bn',
      'bo',
      'bq',
      'br',
      'bs',
      'bt',
      'bv',
      'bw',
      'by',
      'bz',
      'ca',
      'cat',
      'cc',
      'cd',
      'cf',
      'cg',
      'ch',
      'ci',
      'ck',
      'cl',
      'cm',
      'cn',
      'co',
      'com',
      'coop',
      'cr',
      'cu',
      'cv',
      'cw',
      'cx',
      'cy',
      'cz',
      'de',
      'dj',
      'dk',
      'dm',
      'do',
      'dz',
      'ec',
      'edu',
      'ee',
      'eg',
      'eh',
      'er',
      'es',
      'et',
      'eu',
      'fi',
      'fj',
      'fk',
      'fm',
      'fo',
      'fr',
      'ga',
      'gb',
      'gd',
      'ge',
      'gf',
      'gg',
      'gh',
      'gi',
      'gl',
      'gm',
      'gn',
      'gov',
      'gp',
      'gq',
      'gr',
      'gs',
      'gt',
      'gu',
      'gw',
      'gy',
      'hk',
      'hm',
      'hn',
      'hr',
      'ht',
      'hu',
      'id',
      'ie',
      'il',
      'im',
      'in',
      'info',
      'int',
      'io',
      'iq',
      'ir',
      'is',
      'it',
      'je',
      'jm',
      'jo',
      'jobs',
      'jp',
      'ke',
      'kg',
      'kh',
      'ki',
      'km',
      'kn',
      'kp',
      'kr',
      'kw',
      'ky',
      'kz',
      'la',
      'lb',
      'lc',
      'li',
      'lk',
      'lr',
      'ls',
      'lt',
      'lu',
      'lv',
      'ly',
      'ma',
      'mc',
      'md',
      'me',
      'mf',
      'mg',
      'mh',
      'mil',
      'mk',
      'ml',
      'mm',
      'mn',
      'mo',
      'mobi',
      'mp',
      'mq',
      'mr',
      'ms',
      'mt',
      'mu',
      'museum',
      'mv',
      'mw',
      'mx',
      'my',
      'mz',
      'na',
      'name',
      'nc',
      'ne',
      'net',
      'nf',
      'ng',
      'ni',
      'nl',
      'no',
      'np',
      'nr',
      'nu',
      'nz',
      'om',
      'org',
      'pa',
      'pe',
      'pf',
      'pg',
      'ph',
      'pk',
      'pl',
      'pm',
      'pn',
      'pr',
      'pro',
      'ps',
      'pt',
      'pw',
      'py',
      'qa',
      're',
      'ro',
      'rs',
      'ru',
      'rw',
      'sa',
      'sb',
      'sc',
      'sd',
      'se',
      'sg',
      'sh',
      'si',
      'sj',
      'sk',
      'sl',
      'sm',
      'sn',
      'so',
      'sr',
      'ss',
      'st',
      'su',
      'sv',
      'sx',
      'sy',
      'sz',
      'tc',
      'td',
      'tel',
      'tf',
      'tg',
      'th',
      'tj',
      'tk',
      'tl',
      'tm',
      'tn',
      'to',
      'tp',
      'tr',
      'travel',
      'tt',
      'tv',
      'tw',
      'tz',
      'ua',
      'ug',
      'uk',
      'um',
      'us',
      'uy',
      'uz',
      'va',
      'vc',
      've',
      'vg',
      'vi',
      'vn',
      'vu',
      'wf',
      'ws',
      'xxx',
      'ye',
      'yt',
      'za',
      'zm',
      'zw'
  );
  $sub_domain = explode ( '.', $domain );
  $top_url = '';
  $top_url_count = 0;
  for($i = count ( $sub_domain ) - 1; $i >= 0; $i --) {
    if ($i == 0) {
      // just in case of something like NAME.COM
      break;
    }
    if (in_array ( $sub_domain [$i], $iana_root )) {
      $top_url_count ++;
      $top_url = '.' . $sub_domain [$i] . $top_url;
      if ($top_url_count >= 2) {
        break;
      }
    }
  }
  $top_url = $sub_domain [count ( $sub_domain ) - $top_url_count - 1] . $top_url;
  return $top_url;
}
 
function pr($a){
	print_r($a);
	exit;
}
?>