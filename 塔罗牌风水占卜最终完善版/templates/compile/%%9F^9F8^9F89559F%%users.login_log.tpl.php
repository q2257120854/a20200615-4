<?php /* Smarty version 2.6.25, created on 2019-02-12 16:44:22
         compiled from admin/users.login_log.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'request_em', 'admin/users.login_log.tpl', 33, false),array('function', 'lurd', 'admin/users.login_log.tpl', 58, false),array('myblock', 'lurd_list', 'admin/users.login_log.tpl', 52, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script lang='javascript'>
function show_data(nid)
{
    tb_show('浏览/编辑记录', '?ct=users&ac=login_log&even=edit&tb=users_login_history&autoid='+ nid +'&TB_iframe=true&height=450&width=700', true);
}
function do_delete()
{
    document.form1.even.value = 'delete';
    var msg = "你确定要删除选中的记录？！";
    msg += "<br/><a href='javascript:tb_remove();'>&lt;&lt;点错了</a> &nbsp;|&nbsp; <a href='javascript:document.form1.submit();'>确定要删除&gt;&gt;</a>";
    tb_showmsg(msg);
}
function delete_old()
{
    document.form1.even.value = 'delete';
    var msg = "你确定要清空三个月前记录？<br /><font color='#666'>(系统会备份一份记录到文本)</font>";
    msg += "<br/><a href='javascript:tb_remove();'>&lt;&lt;点错了</a> &nbsp;|&nbsp; <a href='?ct=users&ac=del_old_login_log;'>确定操作&gt;&gt;</a>";
    tb_showmsg(msg);
}
</script>

<div id="contents">

<form name="formsearch" method="GET">
<input type='hidden' name='ct' value='users' />
<input type='hidden' name='ac' value='login_log' />
<input type='hidden' name='even' value='list' />
<input type='hidden' name='orderby' value='' />
<dl class="search-class">
    <dd>
    关键字：
    <input type='text' name='keyword' style='width:200px;' class='text' value="<?php echo smarty_function_request_em(array('key' => 'keyword'), $this);?>
" />
    <button type='submit'>搜索</button>
    </dd>
</dl>
</form>

<form name="form1" action="?ct=users&ac=login_log" method="POST">
<input type='hidden' name='tb' value='users_login_history' />
<input type="hidden" name="even" value="delete" />
<table class="table-sort table-operate">
  <tr>
    <th> <a href='javascript:select_all(null);'>选择</a> </th>
	<th> 用户id </th>
	<th> 用户名 </th>
	<th> 登录ip </th>
	<th> 登录时间 </th>
	<th> 应用池 </th>
	<th> 登录时状态 </th>
  </tr>
  <?php  $lurd_list = smarty_myblock_lurd_list(array('item' => 'v'), $this);
foreach( $lurd_list as $this->_tpl_vars['key']=>$this->_tpl_vars['v'] )
{
?>
  <tr>
   <td><a href="javascript:show_data('<?php echo $this->_tpl_vars['v']['autoid']; ?>
');"><img src='images/images/icons/ico-edit.png' alt='修改' title='修改' border='0' /></a><input type="checkbox" name="autoid[]" value="<?php echo $this->_tpl_vars['v']['autoid']; ?>
" /> <?php echo $this->_tpl_vars['v']['autoid']; ?>
 </td>
  <td> <?php echo $this->_tpl_vars['v']['uid']; ?>
 </td>
  <td> <?php echo $this->_tpl_vars['v']['accounts']; ?>
 </td>
  <td> <?php echo $this->_tpl_vars['v']['loginip']; ?>
 </td>
  <td> <?php echo smarty_function_lurd(array('do' => 'format_date','var' => $this->_tpl_vars['v']['logintime'],'format' => ""), $this);?>
 </td>
  <td> <?php echo $this->_tpl_vars['v']['pools']; ?>
 </td>
  <td> <?php if ($this->_tpl_vars['v']['loginsta'] == 1): ?>成功<?php else: ?><font color='red'>失败</font><?php endif; ?> </td>
  </tr>
  <?php  }  ?>
  <tr>
</table>
</form>
</div>

<div id="bottom">
    <div class="fl">
        <button type="button" onclick="delete_old()">清空三个月前记录</button>&nbsp;
        <button type="button" onclick="do_delete();">删除选中记录</button>
    </div>
    <div class="pages">
        <?php echo $this->_tpl_vars['lurd_pagination']; ?>

    </div>
</div>

</body>
</html>
 