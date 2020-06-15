<?php /* Smarty version 2.6.25, created on 2019-02-12 16:44:24
         compiled from admin/users.edit.me.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('myblock', 'lurd_list', 'admin/users.edit.me.tpl', 19, false),array('modifier', 'groupname', 'admin/users.edit.me.tpl', 50, false),array('function', 'lurd', 'admin/users.edit.me.tpl', 56, false),)), $this); ?>
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
</script>

<form name="form1" action="?ct=users&ac=editpwd&even=saveedit" method="POST" onsubmit="return checkpass()" enctype="multipart/form-data">
<?php  $lurd_list = smarty_myblock_lurd_list(array('item' => 'v'), $this);
foreach( $lurd_list as $this->_tpl_vars['key']=>$this->_tpl_vars['v'] )
{
?>
<table class="form">
<tr>
  <th>用户名：</th>
  <td>
    <?php echo $this->_tpl_vars['v']['user_name']; ?>

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
    <?php echo ((is_array($_tmp=$this->_tpl_vars['v']['groups'])) ? $this->_run_mod_handler('groupname', true, $_tmp) : smarty_modifier_groupname($_tmp)); ?>

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
      &nbsp;&nbsp;&nbsp;<button type="submit">保存</button> 
  </td>
</tr>
</table>
<?php  }  ?>
</form>

</body>
</html>