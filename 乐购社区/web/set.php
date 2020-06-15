<?
require_once('../system/inc.php');
require_once('../system/safe.php');
require_once('admin_config.php');
$result1 = mysql_query('select * from '.flag.'admin where a_name = "'.$_SESSION['admin_check2'].'"');
 if  ($row1 = mysql_fetch_array($result1)){
	 $notice=$row1['notice'];
	 $sqname=$row1['sqname'];
	 }else{die($result1);}
 if(isset($_POST['提交'])){
$_data['notice'] = $_POST['notice'];
$_data['sqname'] = $_POST['sqname'];
     	$sql = 'update '.flag.'admin set '.arrtoupdate($_data).' where a_name = "'.$_SESSION['admin_check2'].'"';
	if(mysql_query($sql)){
alert_href('修改成功!','');
	}else{
		alert_back('修改失败!');
	}
 }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link type="text/css" rel="stylesheet" href="file/main/2017/css/style.css" />
<body>
  <div id="body">
        <div class="member-right-con">
		<div id="box">
          <title>网站基本信息</title>
          <form action="" method="post">
            <div class="zl-tab-bd">
              <div class="zl-dd">
                
                
                  <dl>
                  <dt>公告内容：(不写默认总控的公告)</dt>
                  <dd>
                    <textarea name="notice"  style="width:270PX" id=""><?=$notice?></textarea>
                  </dd>
                </dl>
				<?php if($qx>0){
					?>
				<dl>
                  <dt>社区名字：(不写默认社区名字)</dt>
                  <dd>
                    <textarea name="sqname"  style="width:270PX" id=""><?=$sqname?></textarea>
                  </dd>
                </dl><? } ?>

            <dl>
               
			
                <dl>
                  <dt></dt>
                  <dd class="baocun">
                    <input name="提交" type="submit" id="" value="确认保存" />
                  </dd>
                </dl>
              </div>
            </div>
          </form>
		 
        </div>
	</div>

            <div class="row">

                <div class="xinxi" style="height:224px; ">
                    <h3 class="col-title">
                       主站增值服务额度
                    </h3>
                    <div class="xx-con">
					    <em>我的主站额度：</em>
                        <i><?php echo $admin_num;?></i><br />
						
						<em>自助续费权限：</em>
                        <i>已开通</i><br />

                        <em>购买额度权限：</em>
                        <i>已开通</i><br />

                      <em>下级管理员权限：</em>
                        <i>已开通</i><br />


                        <em>跨社区对接权限：</em>
                        <i>已开通</i><br />
                    </div></div></div></div></div></body>
			   