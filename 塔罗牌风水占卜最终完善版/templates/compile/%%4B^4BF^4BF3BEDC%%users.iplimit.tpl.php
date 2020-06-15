<?php /* Smarty version 2.6.25, created on 2019-02-12 16:44:25
         compiled from admin/users.iplimit.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form id="form1" action="?ct=users&ac=iplimit" method="POST" enctype="multipart/form-data">
<div id="contents">
    <table class="form" style="width:800px">
    <tr>
        <td style='background:#EEF8FF;padding-left:8px;font-weight:bold'>&raquo;登录IP限制管理(&lt;ip&gt;标记不要改动)：</td>
    </tr>
    <tr>
        <td>
            <textarea name="ips" class="text" style="width:800px;height:350px;"><?php echo $this->_tpl_vars['ips']; ?>
</textarea>
        </td>
    </tr>
    <tr>
        <td>
            <button type="submit">确定保存</button>
        </td>
    </tr>
</table>
</div>
</form>

</body>
</html>