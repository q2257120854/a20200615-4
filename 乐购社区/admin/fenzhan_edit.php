<?php 

include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'fenzhan';
check_qx($site_qx,'分站管理');
if(isset($_POST['提交'])){
	 null_back($_POST['f_name'],'请输入分站名称');
	// null_back($_POST['f_user'],'请输入登录账号');
	// null_back($_POST['f_password'],'请输入登录密码');
	 null_back($_POST['f_qq'],'请输入站长QQ');

  
 
  $_data['name'] = $_POST['f_name']; 
 // $_data['loginname'] = $_POST['f_user']; 
  //$_data['loginpassword'] = $_POST['f_password']; 
  $_data['qq'] = $_POST['f_qq']; 
  $_data['point'] =$_POST['f_point']; 
  $_data['zt'] =$_POST['zt']; 
  $_data['txsxf'] = $_POST['txsxf']; 
  $_data['uid'] = $_POST['uid'];
  $str = arrtoinsert($_data);
  $sql = 'update '.flag.'fenzhan set '.arrtoupdate($_data).' where id = '.$_GET['id'].' and zid = '.$zhu_id.'';
  if(mysql_query($sql)){
  	 

 		alert_href('修改成功!','fenzhan.php');
	}else{
		alert_back('修改失败!');
	}
}



 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
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
    



<?
 include('header.php');
?><div class="an-content-body" style="padding: 8px" id="pjax-container">
                <div id="vue">
<div class="wrapper preload">
 
<div class="an-content-body" style="padding: 8px" id="pjax-container">
 
<div id="vue-page">
 
 					 	<?php
					$result1 = mysql_query('select * from '.flag.'fenzhan where id = '.$_GET['id'].' and zid = '.$zhu_id.' ');
					if ($row = mysql_fetch_array($result1)){
					?>
    <form  class="form-horizontal" method="post" id="form">
 <input name="f_id" type="hidden" value="<?=$row['banben']?>">
         <div class="row">
            <div class="col-lg-6">
                             <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        修改分站
                    </div>
                     <div class="panel-body">
                            <div class="form-horizontal">
                            
                             <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">分站状态</label>
                                        <div class="col-lg-8">
                                            <select  name="zt" class="form-control" id="lx" v-model="apiType">
                                                <option   <? if ($row['zt']==1){echo 'selected';}?>   value="1" >启用</option>
                                                <option     <? if ($row['zt']==0){echo 'selected';}?>   value="0" >停止</option>
                                              
                                            
                                             </select>
                              </div>
                              </div>

 
                            <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">分站版本</label>
                                        <div class="col-lg-8">
                                                <input name="" type="text" class="form-control"  placeholder=""  value="  <?=get_fenzhan_banben_name($row['banben'])?>" readonly>
   
                              </div>
                              </div>
             
               
                                 
                                               <div class="form-group">
                                  <label class="col-lg-3 control-label">分站名称</label>
                                    <div class="col-lg-8">
                             <input name="f_name" type="text" class="form-control"  placeholder="请输入分站名称"  value="<?=$row['name']?>">

                                  </div>
                                </div>
              
              
                                                           <div class="form-group">
                                  <label class="col-lg-3 control-label">分站域名</label>
                                   <div class="col-lg-8">
                                   
                    <input name="f_url" type="text"    readonly   class="form-control"  placeholder="请输入分站域名"  value="<?=$row['url']?>.<?=$row['url1']?>"> 
                              
                                

                                  </div>
                                </div>
                                 
                               
                               
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">提现手续费</label>
                                    <div class="col-lg-8">
                             <input name="txsxf" type="text" class="form-control"  placeholder="提现手续费"  value="<?=$row['txsxf']?>">

                                  </div>
                                </div>
								<div class="form-group">
                                <label class="col-sm-3 control-label">用户编号</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="zuid" placeholder="输入用户编号" value="<?=$row['uid']?>"
                                           @change="getUid">
                                    <input type="hidden" name="uid" :value="uInfo.uid">
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
                                  <label class="col-lg-3 control-label">分站余额</label>
                                    <div class="col-lg-8">
                             <input name="f_point" type="text" class="form-control"  placeholder=""  value="<?=$row['point']?>">

                                  </div>
                                </div>
              
                                     <div class="form-group">
                                  <label class="col-lg-3 control-label">QQ</label>
                                    <div class="col-lg-8">
                             <input name="f_qq" type="text" class="form-control"  placeholder="请输入站长QQ"  value="<?=$row['qq']?>">

                                  </div>
                                </div>
              
              
                                                 <div class="form-group">
                                  <label class="col-lg-3 control-label">备注</label>
                                    <div class="col-lg-8">
                                      <textarea name="desc" class="form-control" placeholder="备注"><?=$row['desc']?></textarea>

                                    </div>
                                </div>                <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                         <input name="按钮"  onclick="javascript:history.back(-1);"  type="button"  class="an-btn an-btn-danger" id="提交" value="返回分站">
                    
                                                         <input name="提交"  type="submit"  class="an-btn an-btn-success" id="提交" value="保存信息">



</div>
                </div>
            </div>
        </div>
    </form>
 
 <? }?>
</div>

        </div>
    </div><!-- /main-container -->



</div><!-- /wrapper -->


 
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
 
?>   <? include_once('footer.php');
?></body>
</html>
