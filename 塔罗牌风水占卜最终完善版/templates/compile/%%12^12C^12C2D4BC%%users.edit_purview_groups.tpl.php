<?php /* Smarty version 2.6.25, created on 2019-02-12 16:44:27
         compiled from admin/users.edit_purview_groups.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
   li { line-height:28px; border-bottom:1px dashed #ccc; }
</style>
<script language='javascript'>
function group_add()
{
    var msg = "<form style='margin-top:10px;'>组中文名称：<input type='text' class='text' name='groupname_cn' /><br />";
    msg += "组英文标识：<input type='text' class='text' name='groupname' /><br />";
    msg += "<input type='hidden' name='ct' value='users' />\n<input type='hidden' name='ac' value='addgroups' />\n";
    msg += "<button type='submit' style='margin-top:10px;'>确定增加</button></form>";
    tb_showmsg(msg);
}
</script>

<form name="form1" action="?ct=users&ac=edit_purview_groups&even=saveedit" method="POST" enctype="multipart/form-data">
<div id="contents">
<dl class="search-class" style="border-bottom:1px solid #eee">
    <h3 style="line-height:24px;"> &nbsp;组权限管理 -- <?php echo $this->_tpl_vars['group_name']; ?>
</h3>
</dl>

<div style="padding:15px;">
<?php if (request ( 'even' ) == ''): ?>
<ul>
	<li>
	    <span class="label">管理员组：</span>
	    <span style='color:#666'>
	        <a href='?ct=users&ac=index&gp=admin_admin'>成员列表</a> &nbsp; | &nbsp; 
	        开放所有权限
	    </span>
	</li>
	<?php $_from = $this->_tpl_vars['access_groups']['pools']['admin']['private']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
	<?php if ($this->_tpl_vars['k'] != 'admin'): ?>
	<li>
	    <span class="label"><?php echo $this->_tpl_vars['v']['name']; ?>
：</span>
	    <span>
	        <a href='?ct=users&ac=index&gp=<?php echo $this->_tpl_vars['k']; ?>
'>成员列表</a> &nbsp; | &nbsp; 
	        <a href='?ct=users&ac=edit_purview_groups&even=edit&group=admin_<?php echo $this->_tpl_vars['k']; ?>
&pools=admin'>修改组权限</a>
	    </span>
	</li>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
</ul>
<?php else: ?>
<?php $_from = $this->_tpl_vars['config_apps']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
<div style='padding-left:10px;'>
    <div class='title' style='line-height:28px;border-bottom:1px dashed #ccc;font-weight:bold;'>
        <input type='checkbox' name='groups[]' value='<?php echo $this->_tpl_vars['k']; ?>
-*'<?php if ($this->_tpl_vars['groups']['allow'] == '*' || in_array ( '*' , $this->_tpl_vars['groups']['allow'][$this->_tpl_vars['k']] )): ?> checked='checked'<?php endif; ?>/>
        <?php echo $this->_tpl_vars['v']['app_name']; ?>

    </div>
    <div style='line-height:28px;width:90%;padding-top:10px;'>
       <?php $_from = $this->_tpl_vars['v']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['kk'] => $this->_tpl_vars['vv']):
        $this->_foreach['foo']['iteration']++;
?>
       <?php if ($this->_tpl_vars['kk'] != 'app_name'): ?>
       <?php if (($this->_foreach['foo']['iteration']-1) > 1 && ($this->_foreach['foo']['iteration']-1)-1 % 4 == 0): ?><br /><?php endif; ?>
       <span style="display:-moz-inline-box; display:inline-block; width:200px;"><input type='checkbox' name='groups[]' value='<?php echo $this->_tpl_vars['k']; ?>
-<?php echo $this->_tpl_vars['kk']; ?>
'<?php if (in_array ( $this->_tpl_vars['kk'] , $this->_tpl_vars['groups']['allow'][$this->_tpl_vars['k']] )): ?> checked='checked'<?php endif; ?><?php if (in_array ( '*' , $this->_tpl_vars['groups']['allow'][$this->_tpl_vars['k']] )): ?>disabled="disabled"<?php endif; ?>/> <?php echo $this->_tpl_vars['vv']; ?>

       </span>
       <?php endif; ?>
       <?php endforeach; endif; unset($_from); ?>
    </div>
</div>
<br />
<?php endforeach; endif; unset($_from); ?>
<div class="submit">
    <input type='hidden' name='group' value='<?php echo $this->_tpl_vars['request']['group']; ?>
' />
</div>
<?php endif; ?>
</div>
</div>

<div id="bottom">
    <div class="fl">
        <?php if (request ( 'even' ) == 'edit'): ?><button  type="submit">确定保存</button>&nbsp;<?php endif; ?>
        <button type="button" onclick="group_add();">增加用户组</button>
    </div>
</div>
</form>

</body>
</html>