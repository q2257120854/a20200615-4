<?php /* Smarty version 2.6.25, created on 2019-02-12 16:44:26
         compiled from admin/users.edit_purview_xml.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form id="form1" action="?ct=users&ac=edit_purview_xml" method="POST" enctype="multipart/form-data">
<div id="contents">
    <table class="form" style="width:800px">
    <tr>
        <td style='background:#EEF8FF;padding-left:8px;font-weight:bold'>&raquo;全局权限XML手动配置(组权限的XML配置文件，如果不理解请不要修改)：</td>
    </tr>
    <tr>
        <td>
            <textarea name="purview_xml" class="text" style="width:800px;height:450px;"><?php echo $this->_tpl_vars['purview_xml']; ?>
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