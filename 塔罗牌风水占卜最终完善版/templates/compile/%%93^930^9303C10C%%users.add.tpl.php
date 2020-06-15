<?php /* Smarty version 2.6.25, created on 2019-02-14 13:20:07
         compiled from admin/users.add.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin/header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script language='javascript'>
    function checkpass()
    {
        if( document.form1.userpwd.value.length < 6 )
        {
            document.getElementById('pwdtest').innerHTML = "<font color='red'>[密码必须大于6位！]</font>";
            return false;
        }
        else
        {
            document.getElementById('pwdtest').innerHTML = "";
            return true;
        }
    }
</script>
<div style="width:450px;margin:auto;padding:auto">
<form name="form1" jstype="vali" action="?ct=users&ac=index&even=saveadd&tb=users" method="POST" onsubmit="return checkpass()" enctype="multipart/form-data">
<table class="form">
<tr>
  <th>用户名：</th>
  <td><input type='input' name='user_name' class="text" value='' /></td>
</tr>
<tr>
  <th>分成比例：</th>
  <td>
  <input type='input' name='fencheng' id='userpwd' class="text" value='' />
    
  </td>
</tr>
<tr>
  <th>用户密码：</th>
  <td>
    <input type='input' name='userpwd' id='userpwd' class="text" value='' />
    <span id='pwdtest'>(必须大于6位)</span>
  </td>
</tr>
<tr>
  <th>用户email：</th>
  <td>
    <input type='input' name='email' class="text" value='' />
   </td>
</tr>
<tr>
  <th>用户组：</th>
  <td>
    <?php $_from = $this->_tpl_vars['cfg_groups']['pools']['admin']['private']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
        <input type='checkbox' name='groups[]' value='admin_<?php echo $this->_tpl_vars['k']; ?>
' /> <?php echo $this->_tpl_vars['v']['name']; ?>

    <?php endforeach; endif; unset($_from); ?>
  </td>
</tr>
<tr>
  <td colspan='2' align='center' height='60'>
      <button type="submit">保存</button> &nbsp;&nbsp;&nbsp;
      <button type="reset">重设</button>
  </td>
</tr>
</table>
</form>
</div>

</body>
</html>