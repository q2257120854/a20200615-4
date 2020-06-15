<?php /* Smarty version 2.6.25, created on 2019-02-14 13:18:53
         compiled from admin/users.edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('myblock', 'lurd_list', 'admin/users.edit.tpl', 26, false),array('function', 'lurd', 'admin/users.edit.tpl', 76, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script language='javascript'>
    function checkpass()
    {
        if( document.form1.userpwd.value == document.form1.userpwdok.value)
        {
            document.getElementById('pwdtest').innerHTML = "";
            return true;
        }
        else
        {
            document.getElementById('pwdtest').innerHTML = "[两次输入密码效验不正确！]";
            return false;
        }
    }
    function done_purview( gurl )
    {
        parent.location.href = gurl;
        parent.ref_parent = false;
        parent.tb_remove();
    }
</script>

<div style="width:450px;margin:auto;padding:auto">
<form name="form1" action="?ct=users&ac=index&even=saveedit&tb=users" method="POST" onsubmit="return checkpass()" enctype="multipart/form-data">
<?php  $lurd_list = smarty_myblock_lurd_list(array('item' => 'v'), $this);
foreach( $lurd_list as $this->_tpl_vars['key']=>$this->_tpl_vars['v'] )
{
?>
<input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['v']['uid']; ?>
" />
<table class="form">
<tr>
  <th>用户名：</th>
  <td>
    <?php echo $this->_tpl_vars['v']['user_name']; ?>

  </td>
</tr>

<tr>
  <th>分成比例：</th>
  <td>
  <input type='input' name='fencheng' id='userpwd' class="text" value='<?php echo $this->_tpl_vars['v']['fencheng']; ?>
' />
    
  </td>
</tr>
<tr>
  <th>用户密码：</th>
  <td>
    <input type='input' name='userpwd' id='userpwd' class="text" value='' onchange='checkpass()' />
    <span>(必须大于6位)</span>
  </td>
</tr>
<tr>
  <th>确认密码：</th>
  <td>
    <input type='input' name='userpwdok' id='userpwdok' class="text" value='' onchange='checkpass()' />
    <span id='pwdtest' style='color:red'></span>
  </td>
</tr>
<tr>
  <th>用户email：</th>
  <td>
    <?php echo $this->_tpl_vars['v']['email']; ?>

   </td>
</tr>
<tr>
  <th>用户组：</th>
  <td>
    <?php $_from = $this->_tpl_vars['cfg_groups']['pools']['admin']['private']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['kk'] => $this->_tpl_vars['vv']):
?>
             <input type='checkbox' name='groups[]' value='admin_<?php echo $this->_tpl_vars['kk']; ?>
' <?php if (preg_match ( "/admin_" . $this->_tpl_vars['kk'] ."/", $this->_tpl_vars['v']['groups'] )): ?> checked='checked'<?php endif; ?> /> <?php echo $this->_tpl_vars['vv']['name']; ?>

    <?php endforeach; endif; unset($_from); ?>
    <hr size='1' />
    <a href='javascript:done_purview("?ct=users&ac=user_purview&uid=<?php echo $this->_tpl_vars['v']['uid']; ?>
");'>[为此用户设置独立权限]</a>
  </td>
</tr>
<tr>
  <th>上次登录时间：</th>
  <td>
    <?php echo smarty_function_lurd(array('var' => $this->_tpl_vars['last_login']['logintime'],'do' => 'format_date','format' => "Y-m-d H:i:s"), $this);?>

   </td>
</tr>
<tr>
  <th>上次登录IP：</th>
  <td>
    <?php echo $this->_tpl_vars['last_login']['loginip']; ?>

   </td>
</tr>
<tr>
  <td colspan='2' align='center' height='60'>
      <button type="submit">保存</button> &nbsp;&nbsp;&nbsp;
      <button type="reset">重设</button>
  </td>
</tr>
</table>
<?php  }  ?>
</form>
</div>

</body>
</html>