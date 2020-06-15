 <?
if(isset($_POST['act'])){
if ($_POST['pwd']=='')
{ $password=$member_password ;}
else

{ $password=md5($_POST['pwd']) ;}
	
	$_data['qq'] = $_POST['qq'];
	$_data['password'] = $password;
  
	
  	$sql = 'update '.flag.'user set '.arrtoupdate($_data).' where ID = '.$member_id.'';
	if(mysql_query($sql)){
		alert_href('修改成功!','');
	}else{
		alert_back('修改失败!');
	}
}

?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>修改密码-<?=$site_name?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?=$site_ico?>"/>
         <link href="http://assets.yilep.com/ylsq/assets/admin/css/animate.min.css" rel="stylesheet">    <link href="http://assets.yilep.com/ylsq/assets/admin/css/vendor-styles.css" rel="stylesheet"> <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/layui/css/layui.mobile.css"> <link rel="stylesheet" href="http://assets.yilep.com/ylsq/assets/admin/css/styles.css"> <link href="http://assets.yilep.com/ylsq/css/admin/main.css?v=3.0.9" rel="stylesheet">
       <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
	
	.table-bordered th{font-size:13px;}
.table-bordered td{font-size:13px;}
	
    </style>
    <script>
function sum() {
	var n1 = document.getElementById("czje").value;
	var n2 = document.getElementById("sxf").value;
 
	document.getElementById("payInput").value = parseInt(n1)+parseInt(n1)*(parseInt(n2)/100);
}
</script>
</head>

<body class="overflow"  >
<div class="wrapper ">
    <? require_once('m_head.php');?>

   <div class="an-content-body" style="padding: 8px" id="pjax-container">
                    <div id="vue">
        <div class="row">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">
                        个人资料
                    </div>
                    <div class="smart-widget-body">
                      <br /> 
                        <form class="form-horizontal" id="form1" name="form1" method="post">
                        <input name="act" type="hidden" value="edit">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">用户名</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" value="<?=$member_name?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">编号</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" value="<?=$member_id?>" disabled>
                                </div>
                            </div>
                            
                              <div class="form-group">
                                <label class="col-lg-3 control-label">QQ登录绑定</label>
                                <div class="col-lg-8">
                                    <div class="input-group">
                                                                                <input type="text" class="form-control" value="未绑定" disabled>
                                                                                <a href="/" ></a>  <span class="input-group-text">绑定</span>

                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">QQ</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="qq" value="<?=$member_qq?>"
                                           onkeyup="value=value.replace(/[^\d\/]/ig,'')" placeholder="输入QQ号">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">修改密码</label>
                                <div class="col-lg-8">
                                    <input type="password" class="form-control" name="pwd" placeholder="不修改则留空">
                                </div>
                            </div>

                        
                    </div>
                    <div class="smart-widget-footer text-right">
                        <div class="btn-group">
						<input name="提交"  type="submit"  class="btn btn-purple" id="提交" value="保存修改">
            
                           <!-- <button type="button" onclick="subForm()"  class="btn btn-purple" >保存修改-->
                            
                             <i  class="fa fa-angle-right"></i></button>
                        </div>
                    </div></form>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
    </div><!-- /main-container -->

 <? require_once('m_footer.php');?>

 

  </body>
</html>
