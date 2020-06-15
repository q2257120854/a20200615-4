<{include file="admin/header.tpl"}>
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
			<{lurd_list item='v'}>
			<tr>
				<td> 
				    <a href="javascript:show_data('<{$v.uid}>');"><img src='images/images/icons/ico-edit.png' alt='查看/修改' title='查看/修改' border='0' /></a><input type="checkbox" class="checkbox" name="uid[]" value="<{$v.uid}>" rel="child" />
				</td>
				<td> <{$v.uid}> </td>
				<td> 
				    <a href="javascript:show_data('<{$v.uid}>');">
				        <img src='images/images/icons/auditing.gif' alt='查看/修改' title='查看/修改' border='0' /> <{$v.user_name}>
				    </a>
			    </td>
				<td> <{frame_union do='pools' var=$v.pools}> </td>
				<td> <{frame_union do='groups' var=$v.groups}> </td>
				<td> <{lurd do="format_date" var=$v.logintime format="" }> </td>
				<td> <{$v.loginip}>&nbsp; </td>
				<td><a href="javascript:show_data('<{$v.uid}>');">修改</a>&nbsp;|&nbsp;<a href="javascript:do_delete_one('<{$v.uid}>');">删除</a></td>
			</tr>
			<{/lurd_list}>
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
			<{$lurd_pagination}>
		</div>
	</div>
</div>

</body>
</html>
