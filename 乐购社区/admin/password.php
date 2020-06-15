<!--密码修改-->
<div class="modal" id="modal-profile">
    <div class="modal-dialog">
        <div class="modal-content animated flipInX">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <div class="modal-title"><h4>个人资料</h4></div>
            </div>
            <div class="modal-body">
                 <form class="form-horizontal"  method="post"   >
                    <div class="form-group">
                        <label class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?=$a_name?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">编号</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?=$zhu_id?>"
                            disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">QQ</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="qq" value="<?=$a_qq?>"
                                   onkeyup="value=value.replace(/[^\d\/]/ig,'')" placeholder="输入QQ号">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">原密码</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="oldpwd" placeholder="必填，防止盗号">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">修改密码</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="pwd" placeholder="不修改则留空">
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <input name="修改信息" class="btn btn-primary" type="submit" value="保存">
             </div>
              </form>
        </div>
    </div>
</div>
 

  

<?
if ($_POST['修改信息'] =='保存')
{
if($zhu_id=='11'){
alert_back('修改失败!测试站改你麻痹密码');
die;
}
if($_POST['oldpwd']!=$a_password)alert_href('原密码输入错误','');
if($_SESSION['gly'])alert_href('你无权限修改','');
 	$_data['qq'] = $_POST['qq'];
	if ($_POST['pwd']!= '')
	{$_data['loginpassword'] = $_POST['pwd'];}
//$_data['c_date'] = $sj;
 	$str = arrtoinsert($_data);
	$sql = 'update '.flag.'zhuzhan set '.arrtoupdate($_data).' where id = '.$zhu_id.'';
	if(mysql_query($sql)){
		alert_href('修改成功!','');
	}else{
		alert_back('修改失败!');
	}
	
}

?>