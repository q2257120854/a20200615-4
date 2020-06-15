<?php /* Smarty version 2.6.25, created on 2019-02-12 16:45:21
         compiled from admin/users.index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('myblock', 'lurd_list', 'admin/users.index.tpl', 34, false),array('function', 'frame_union', 'admin/users.index.tpl', 45, false),array('function', 'lurd', 'admin/users.index.tpl', 47, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script lang='javascript'>
function show_data(nid)
{
	tb_show('浏览/编辑用户', '?ct=users&ac=index&even=edit&tb=users&uid='+ nid +'&TB_iframe=true&height=350&width=500', true);
}
function do_delete()
{
	document.form1.even.value = 'delete';
	var msg = "你确定要删除选中的用户？！";
	msg += "<br/><a href='javascript:tb_remove();'>&lt;&lt;点错了</a> &nbsp;|&nbsp; <a href='javascript:document.form1.submit();'>确定要删除&gt;&gt;</a>";
	tb_showmsg(msg);
}
function do_delete_one(uid)
{
	var msg = "你确定要删除选中的用户？！";
	msg += "<br/><a href='javascript:tb_remove();'>&lt;&lt;点错了</a> &nbsp;|&nbsp; <a href='?ct=users&ac=index&even=delete&tb=users&uid[]="+ uid +"&TB_iframe=true&height=400&width=500'>确定要删除&gt;&gt;</a>";
	tb_showmsg(msg);
}
</script>

<div id="contents">
		<table class="table-sort table-operate">
			<tr>
				<th> <input name="checkbox" type="checkbox" value="" rel="parent" /> </th>
				<th> 用户ID </th>
				<th> 用户名 </th>
				<th> 类型 </th>
				<th> 权限组 </th>
				<th> 登录时间 </th>
				<th> 登录IP </th>
				<th> 操作 </th>
			</tr>
			<?php  $lurd_list = smarty_myblock_lurd_list(array('item' => 'v'), $this);
foreach( $lurd_list as $this->_tpl_vars['key']=>$this->_tpl_vars['v'] )
{
?>
			<tr>
				<td> 
				    <a href="javascript:show_data('<?php echo $this->_tpl_vars['v']['uid']; ?>
');"><img src='images/images/icons/ico-edit.png' alt='查看/修改' title='查看/修改' border='0' /></a><input type="checkbox" class="checkbox" name="uid[]" value="<?php echo $this->_tpl_vars['v']['uid']; ?>
" rel="child" />
				</td>
				<td> <?php echo $this->_tpl_vars['v']['uid']; ?>
 </td>
				<td> 
				    <a href="javascript:show_data('<?php echo $this->_tpl_vars['v']['uid']; ?>
');">
				        <img src='images/images/icons/auditing.gif' alt='查看/修改' title='查看/修改' border='0' /> <?php echo $this->_tpl_vars['v']['user_name']; ?>

				    </a>
			    </td>
				<td> <?php echo smarty_function_frame_union(array('do' => 'pools','var' => $this->_tpl_vars['v']['pools']), $this);?>
 </td>
				<td> <?php echo smarty_function_frame_union(array('do' => 'groups','var' => $this->_tpl_vars['v']['groups']), $this);?>
 </td>
				<td> <?php echo smarty_function_lurd(array('do' => 'format_date','var' => $this->_tpl_vars['v']['logintime'],'format' => ""), $this);?>
 </td>
				<td> <?php echo $this->_tpl_vars['v']['loginip']; ?>
&nbsp; </td>
				<td><a href="javascript:show_data('<?php echo $this->_tpl_vars['v']['uid']; ?>
');">修改</a>&nbsp;|&nbsp;<a href="javascript:do_delete_one('<?php echo $this->_tpl_vars['v']['uid']; ?>
');">删除</a></td>
			</tr>
			<?php  }  ?>
		</table>
</div>

<div id="bottom">
	<form name="form1" action="?ct=users" method="POST">
	<div class="fl">
	<button type="button" onclick="tb_show('增加管理员', '?ct=users&ac=index&even=add&tb=users&TB_iframe=true&height=300&width=500', true);">增加管理员</button>
	</div>
	</form>
	<div class="pages">
		<div class="ylmf-page">
			<?php echo $this->_tpl_vars['lurd_pagination']; ?>

		</div>
	</div>
</div>

</body>
</html>