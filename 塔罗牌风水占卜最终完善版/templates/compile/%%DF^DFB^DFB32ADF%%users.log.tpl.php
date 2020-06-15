<?php /* Smarty version 2.6.25, created on 2019-02-12 16:44:23
         compiled from admin/users.log.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'request_em', 'admin/users.log.tpl', 18, false),array('function', 'lurd', 'admin/users.log.tpl', 46, false),array('myblock', 'lurd_list', 'admin/users.log.tpl', 39, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin/header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type='text/javascript'>
function do_delete()
{
    document.form1.even.value = 'delete';
    var msg = "你确定要删除选中的记录？！";
    msg += "<br/><a href='javascript:tb_remove();'>&lt;&lt;点错了</a> &nbsp;|&nbsp; <a href='javascript:document.form1.submit();'>确定要删除&gt;&gt;</a>";
    tb_showmsg(msg);
}
</script>
<div id="contents">
<form name="formsearch" action="?ct=<?php echo $this->_tpl_vars['request']['ct']; ?>
&ac=<?php echo $this->_tpl_vars['request']['ac']; ?>
&even=list" method="POST">
<input type='hidden' name='tb' value='admin_log' />
<input type='hidden' name='orderby' value='' />
<dl class="search-class">
  <dd>
    <span>关键字：</span>
    <input type='text' name='keyword' value="<?php echo smarty_function_request_em(array('key' => 'keyword'), $this);?>
" class="text" />
    <button type='submit'>搜索</button>
  </dd>
</dl>
</form><!-- //search -->

<form  name="form1" action="?ct=<?php echo $this->_tpl_vars['request']['ct']; ?>
&ac=<?php echo $this->_tpl_vars['request']['ac']; ?>
" method="POST">
<input type='hidden' name='tb' value='admin_log' />
<input type="hidden" name="even" value="delete" />
<table class="table-sort table-operate">
        <tr>
            <th> <a href="javascript:select_all(null);"><u>选择</u></a> </th>
            <th> 用户名 </th>
            <th> 日志内容 </th>
            <th> 操作时间 </th>
            <th> 系统警告 </th>
            <th> 状态 </th>
        </tr>
	</thead>

	<tbody>
    <?php  $lurd_list = smarty_myblock_lurd_list(array('item' => 'v'), $this);
foreach( $lurd_list as $this->_tpl_vars['key']=>$this->_tpl_vars['v'] )
{
?>
    <tr onMouseMove="javascript:this.bgColor='#FCFDEE';" onMouseOut="javascript:this.bgColor='#FFFFFF';">
        <td>
            &nbsp;<input type="checkbox" name="id[]" value="<?php echo $this->_tpl_vars['v']['id']; ?>
" chk="yes" /> <?php echo $this->_tpl_vars['v']['id']; ?>

        </td>
        <td> <?php echo $this->_tpl_vars['v']['user_name']; ?>
 </td>
        <td> <span style="<?php if ($this->_tpl_vars['v']['isalert'] == 1 && $this->_tpl_vars['v']['isread'] == 0): ?>color:red<?php endif; ?>"><?php echo $this->_tpl_vars['v']['operate_msg']; ?>
</span> </td>
        <td> <?php echo smarty_function_lurd(array('do' => 'format_date','var' => $this->_tpl_vars['v']['operate_time']), $this);?>
 </td>
        <td> <?php if ($this->_tpl_vars['v']['isalert'] == 1): ?><font color='red'>警告</font><?php else: ?>普通<?php endif; ?> </td>
        <td> <?php if ($this->_tpl_vars['v']['isalert'] == 1 && $this->_tpl_vars['v']['isread'] == 0): ?><font color='red'>未处理</font><?php else: ?>已处理<?php endif; ?> </td>
    </tr>
    <?php  }  ?>

	</tbody>
</table>
</form>
</div>

<div id="bottom">
    <div class="fl">
        <button type="button" onclick="do_delete();">删除选中记录</button>
    </div>
    <div class="pages">
        <?php echo $this->_tpl_vars['lurd_pagination']; ?>

    </div>
</div>
</script>
</body>
</html>