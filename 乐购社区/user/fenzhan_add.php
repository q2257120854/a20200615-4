<?php

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'fenzhan_add';
check_qx($site_qx,'分站管理');
    
if(isset($_POST['提交'])){
	 null_back($_POST['f_name'],'请输入分站名称');
	 null_back($_POST['f_url'],'请输入分站前缀');
	 null_back($_POST['f_url1'],'请输入选择分站尾缀');
	# //null_back($_POST['f_user'],'请输入登录账号');
	#// null_back($_POST['f_password'],'请输入登录密码');
	 null_back($_POST['f_qq'],'请输入站长QQ');
	 null_back($_POST['zuid'],'请输入用户ID');

$wzurl = $_POST['f_url'].".".$_POST['f_url1'];
 if ($_POST['f_id']=="1")
 {   $fen_edu = $site_fed1; }
 elseif ($_POST['f_id']=="2")
 {   $fen_edu = $site_fed2; } 
  elseif ($_POST['f_id']=="3")
 {   $fen_edu = $site_fed3; }
 
 
 if ($fen_edu <1)
 {		alert_back('创建失败:额度不足!'); }
 else {
	 

	 //检测主站域名
	 	$result = mysql_query('select * from '.flag.'zhuzhan_domain where name = "'.$wzurl.'"  ');
					if ($row = mysql_fetch_array($result)){
		alert_back('创建失败:'.$wzurl.' 已经被绑定过了!!');
					}

	 //检测分站域名
	 	$result = mysql_query('select * from '.flag.'fenzhan_domain where name = "'.$wzurl.'"  ');
					if ($row = mysql_fetch_array($result)){
		alert_back('创建失败:'.$wzurl.' 已经被绑定过了!!');
					}
 					
					
 
 
  $_data['zt'] = $_POST['zt']; 
  $_data['banben'] = $_POST['f_id']; 
  $_data['name'] = $_POST['f_name']; 
  $_data['point'] = 0; 
  $_data['url'] = $_POST['f_url']; 
  $_data['url1'] = $_POST['f_url1']; 
  /*  $_data['loginname'] = $_POST['f_user']; 
  $_data['loginpassword'] = $_POST['f_password']; 
 */ 
   $_data['uid'] = $_POST['zuid'];
  $_data['qq'] = $_POST['f_qq']; 
  $_data['date'] = $sj;
  $_data['desc'] = $_POST['desc']; 
  $_data['txsxf'] = $_POST['txsxf']; 
  $_data['moban'] = $fmorenmoban; 
  $_data['background'] =$fmorenpic; 
  $_data['mid'] = 1; 
  $_data['fed1'] = 0; 
  $_data['fed2'] = 0; 
  $_data['fed3'] = 0; 
 
  $_data['level1_name'] = $site_level1_name; 
  $_data['level2_name'] = $site_level2_name; 
  $_data['level3_name'] = $site_level3_name; 
  $_data['level4_name'] = $site_level4_name; 
  $_data['level5_name'] = $site_level5_name; 
  $_data['level1_price'] = $site_level1_price; 
  $_data['level2_price'] = $site_level2_price; 
  $_data['level3_price'] = $site_level3_price; 
  $_data['level4_price'] = $site_level4_price; 
  $_data['level5_price'] = $site_level5_price; 
  $_data['zid'] = $zhu_id; 
  $_data['upid'] = $up_id; 
 	$str = arrtoinsert($_data);
	$sql1 = 'insert into '.flag.'fenzhan ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql1)){
		
 		//额度记录
	$_data3['zid'] = $zhu_id;
 	$_data3['qsl'] = $fen_edu;	
	$_data3['sl'] = 1;
 	$_data3['hsl'] = $fen_edu-1;
 	$_data3['date'] = $sj;
 	$_data3['desc'] = '开通'.get_fenzhan_banben_name($_POST['f_id']).'分站1个';
 	$_data3['lx'] = 0; //1=增加 0=扣除
   	$str3 = arrtoinsert($_data3);
	$sql3 = 'insert into '.flag.'edu ('.$str3[0].') values ('.$str3[1].')';
    mysql_query($sql3);
	
	if ($_POST['f_id']==1)
   	{$_data4['fed1'] = $fen_edu-1;   }
	if ($_POST['f_id']==2)
   	{$_data4['fed2'] = $fen_edu-1;   }
	if ($_POST['f_id']==3)
   	{$_data4['fed3'] = $fen_edu-1;   }		
 	$str4 = arrtoinsert($_data4);
	$sql4 = 'update '.flag.'zhuzhan set '.arrtoupdate($_data4).' where id = '.$zhu_id.'';
	  mysql_query($sql4);

   
  
  	 //查询分站ID
	 	$result = mysql_query('select * from '.flag.'fenzhan where url = "'.$_POST['f_url'].'"  and url1 = "'.$_POST['f_url1'].'" ');
					if ($row = mysql_fetch_array($result)){
$fzid=$row['ID'];
					}

		//域名记录
	$_data5['zid'] = $zhu_id;
	$_data5['fid'] = $fzid;
	$_data5['name'] =$wzurl;
    	$str5 = arrtoinsert($_data5);
	$sql5 = 'insert into '.flag.'fenzhan_domain ('.$str5[0].') values ('.$str5[1].')';
    mysql_query($sql5);
 		alert_href('创建成功!','fenzhan.php');
	}else{
		alert_back('创建失败!');
	}}
}



 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>创建分站</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



 <script type="text/javascript">
KindEditor.ready(function(K) {
	K.create('#i_content');
	var editor = K.editor();
	K('#upload-image').click(function() {
		editor.loadPlugin('image', function() {
			editor.plugin.imageDialog({
			imageUrl : K('#s_pic').val(),
			clickFn : function(url, title, width, height, border, align) {
				K('#s_pic').val(url);
				editor.hideDialog();
				}
			});
		});
	});
	 
 
	
	 
	
	 
	
	 
	
});

 </script>	

    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
    
</head>

<body class="overflow-hidden" data-pjax>
<div class="wrapper preload">
 
<?
 include('header.php');
  include('left.php');
?>
  <div class="main-container">
        <div class="padding-md" id="pjax-container">
 
<div id="vue-page">
 
 					 
    <form class="form-horizontal" method="post" id="form-store">
 
         <div class="row">
            <div class="col-lg-6">
                <div class="smart-widget widget-blue">
                  <div class="panel-heading bg-gradient-vine">新增分站</div>
                    <div class="smart-widget-inner">
                        
                            
                        <div class="smart-widget-body">
                            <div class="form-horizontal">
                            
 
 

                            <div class="form-group">
                                      <label class="col-lg-3 control-label">分站状态</label>
                                        <div class="col-lg-8">
                                            <select  name="zt" class="form-control" id="lx">
                                                <option    value="1" >启用</option>
                                                <option    value="0" >停止</option>
                                              
                                            
                                             </select>
                              </div>
                              </div>
                              
                                                          <div class="form-group">
                                      <label class="col-lg-3 control-label">分站版本</label>
                                        <div class="col-lg-8">
                                            <select  name="f_id" class="form-control" id="lx">
                                                <option    value="1" ><?=get_fenzhan_banben_name(1)?> 剩余(<?=$site_fed1?>)个</option>
                                                <option    value="2" ><?=get_fenzhan_banben_name(2)?> 剩余(<?=$site_fed2?>)个</option>
                                                <option    value="3" ><?=get_fenzhan_banben_name(3)?> 剩余(<?=$site_fed3?>)个</option>
                                            
                                             </select>
                              </div>
                              </div>
             
               
                                 
                                               <div class="form-group">
                                  <label class="col-lg-3 control-label">分站名称</label>
                                    <div class="col-lg-8">
                             <input name="f_name" type="text" class="form-control"  placeholder="请输入分站名称"  value="">

                                  </div>
                                </div>
              
              
                                                           <div class="form-group">
                                  <label class="col-lg-3 control-label">分站域名</label>
                                   <div class="col-lg-8">
                                   
                                   <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><input name="f_url" type="text"    style="width:100px" class="form-control"  placeholder="请输入分站域名"  value=""> </td>
    <td>    <select   name='f_url1'  style="width:178px"    class="form-control" id="lx">
                                                	<?php
							
 					$result1 = mysql_query('select * from '.flag.'zhuzhan_domain  where zid='.$zhu_id.'   order by ID  asc');
					while ($row1 = mysql_fetch_array($result1)){
						echo '<option value="'.top_domain($row1['name']).'" >'.top_domain($row1['name']).'</option>';
					}
					?>
                                             </select> </td>
  </tr>
</table>

                              
                                

                                  </div>
                                </div>
                                 
                               
                          
                          
                                
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">提现手续费</label>
                                    <div class="col-lg-8">
                             <input name="txsxf" type="text" class="form-control"  placeholder="提现手续费"  value="0">

                                  </div>
                                </div>
                                
<div class="form-group">
                                <label class="col-sm-3 control-label">用户编号</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="zuid" placeholder="输入用户编号" value="<?=$row['uid']?>"  onchange="getid()">
                                    <input type="hidden" name="uid" :value="uInfo.uid">
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label">用户昵称</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id='uname' name='uname' :value="uInfo.username" disabled>
                                </div>
                            </div>

                          
                          
                                <!--<div class="form-group">
                                  <label class="col-lg-3 control-label">登录账号</label>
                                    <div class="col-lg-8">
                             <input name="f_user" type="text" class="form-control"  placeholder="请输入登录账号"  value="<?=$row['loginname']?>">

                                  </div>
                                </div>

                              
                                  
                                     <div class="form-group">
                                  <label class="col-lg-3 control-label">登录密码</label>
                                    <div class="col-lg-8">
                             <input name="f_password" type="text" class="form-control"  placeholder="请输入登录密码"  value="<?=$row['loginpassword']?>">

                                  </div>
                                </div>-->
              
                                     <div class="form-group">
                                  <label class="col-lg-3 control-label">站长QQ</label>
                                    <div class="col-lg-8">
                             <input name="f_qq" type="text" class="form-control"  placeholder="请输入站长QQ"  value="">

                                  </div>
                                </div>

                                     <div class="form-group">
                                  <label class="col-lg-3 control-label">备注</label>
                                    <div class="col-lg-8">
                                      <textarea name="desc" class="form-control" placeholder="备注"></textarea>

                                    </div>
                                </div>
              
                             
                             
                              
                        </div>    </div>    </div>   
               
                    <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                         <input name="按钮"  onclick="javascript:history.back(-1);"  type="button"  class="btn btn-" id="提交" value="返回">
                    
                                                         <input name="提交"  type="submit"  class="btn btn-primary" id="提交" value="创建">



</div>
                </div>
            </div>
        </div>
    </form>
 
 
</div>

        </div>
    </div><!-- /main-container -->

	<script type="text/javascript" src="http://assets.19sky.cn/assets/js/main.js"></script>
    <script src="http://assets.19sky.cn/assets/js/left1.js" type="text/javascript"></script>
    <script src="http://assets.19sky.cn/assets/js/left.js" type="text/javascript"></script>
    <script src="http://assets.19sky.cn/assets/js/layer.js" type="text/javascript"></script>
<script type="text/javascript">
    function getid()
    {
        var vm = new Vue();
        vm.$post("ajax.php?act=checku", $("#form-store").serialize()).then(function(data)
        {
            if (data.status === 0)
            {
                document.getElementById('uname').value = data.date.username;
                vm.$message('成功获取用户名字', 'success');
            }
            else
            {
                vm.$message(data.message, 'error');
            }
        });
    }
</script>
 <? include('footer.php');
?>
</div><!-- /wrapper -->

<?  include('password.php');?>
<?
function regular_domain($domain)
{
  if (substr ( $domain, 0, 7 ) == 'http://') {
    $domain = substr ( $domain, 7 );
  }
  if (strpos ( $domain, '/' ) !== false) {
    $domain = substr ( $domain, 0, strpos ( $domain, '/' ) );
  }
  return strtolower ( $domain );
}
function top_domain($domain) {
  $domain = regular_domain ( $domain );
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
      'top',
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
  $top_domain = '';
  $top_domain_count = 0;
  for($i = count ( $sub_domain ) - 1; $i >= 0; $i --) {
    if ($i == 0) {
      // just in case of something like NAME.COM
      break;
    }
    if (in_array ( $sub_domain [$i], $iana_root )) {
      $top_domain_count ++;
      $top_domain = '.' . $sub_domain [$i] . $top_domain;
      if ($top_domain_count >= 2) {
        break;
      }
    }
  }
  $top_domain = $sub_domain [count ( $sub_domain ) - $top_domain_count - 1] . $top_domain;
  return $top_domain;
}
 
?> 
  </body>
</html>
