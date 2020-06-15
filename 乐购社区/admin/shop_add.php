<?php $title='商品添加' ; include '../system/inc.php'; include './admin_config.php'; include './check.php'; $nav='shopadd' ; check_qx($site_qx, '商品管理'); //同系统查询主站ID ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../editor/themes/default/default.css" />

    <style>
        th {
    text-align: center;
}

td {
    text-align: center;
}
    </style>


<div class="wrapper preload">
    <?php include( 'header.php'); ?>
    <div class="an-content-body" style="padding: 8px" id="pjax-container">
            <div id="vue-page">
                <form class="form-horizontal" id="form-zfconfig">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel">
                                <div class="panel-heading bg-gradient-vine">增加商品</div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">加价模板</label>
                                        <div class="col-lg-8">
                                            <select class="form-control"name="s_pid">
                                                <option value="">请选择加价模板</option>
                                                <?php $result=mysql_query( 'select * from '.flag. 'price where zid = '.$zhu_id. '  and fid = 0 order by ID desc ,ID desc'); while($row=mysql_fetch_array($result)){ ?>
                                                <option value="<?=$row['ID']?>">
                                                    <?=$row[ 'p_name']?>
                                                </option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">分站加价方式</label>
                                        <div class="col-lg-8">
                                            <select class="form-control"name="jj">
                                                <option value="">请选择分站加价方式</option>
                                                <option value="0">固定金额（写什么分站成本是什么）</option>
                                                <option value="1">倍数（主站成本*倍数）</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">下单模板</label>
                                        <div class="col-lg-8">
                                            <select class="form-control"name="s_xid">
                                                <option value="">请选择下单模板</option>
                                                <option <?php if ($_GET[ 'xid']=="0" ) {echo "selected";}?> value="0">自动发货(卡密)</option>
                                                <?php $result=mysql_query( 'select * from '.flag. 'moban  order by ID asc ,ID desc'); while($row=mysql_fetch_array($result)){ ?>
                                                <option value="<?=$row['ID']?>">
                                                    <?=$row[ 'name']?>
                                                </option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">商品分类</label>
                                        <div class="col-lg-8">
                                            <select class="form-control"name="s_cid">
                                                <?php $result=mysql_query( 'select * from  '.flag. 'shop_channel where zt = 1  and zid = '.$zhu_id. ' order by corder desc ,ID desc'); while($row=mysql_fetch_array($result)){ ?>
                                                <option value="<?=$row['ID']?>">
                                                    <?=$row[ 'name']?>
                                                </option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">重复下单</label>
                                        <div class="col-lg-8">
                                            <select name="iscfxd" class="form-control" id="iscfxd" v-model="apiType">
                                                <option value="1">允许</option>
                                                <option value="0">禁止</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">允许补单</label>
                                        <div class="col-lg-8">
                                            <select name="s_bd" class="form-control" id="s_zt" v-model="apiType">
                                                <option value="1">启用</option>
                                                <option value="0">禁用</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">允许退款</label>
                                        <div class="col-lg-8">
                                            <select name="s_tk" class="form-control" id="s_zt" v-model="apiType">
                                                <option value="1">启用</option>
                                                <option value="0">禁用</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">最低购买</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="s_dnum" id="s_dnum" placeholder="请输入最低购买数量" value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">最高购买</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="s_gnum" id="s_gnum" placeholder="请输入最高购买数量" value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">商品状态</label>
                                        <div class="col-lg-8">
                                            <select name="s_zt" class="form-control" id="s_zt" v-model="apiType">
                                                <option value="1">启用</option>
                                                <option value="0">禁用</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
                            <div class="col-md-6">
                                <div class="panel">
                                    <div class="panel-heading bg-gradient-vine">商品信息</div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">图片地址</label>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <input name="s_pic" id="s_pic" type="text" class="form-control" placeholder="输入图片地址">
                                                    <div class="input-group-btn">
                                                        <button type="button" id="upload-image" class="btn btn-success no-shadow upload_btn">上传</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">商品名称</label>
                                            <div class="col-lg-8">
                                                <input name="s_name" type="text" class="form-control" id="s_name" placeholder="请输入商品名称" value="">
                                            </div>
                                        </div>
                                        <div class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">商品单位</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="s_unit" placeholder="请输入商品单位" value="个" class="form-control"><pre>举例：名片赞单位就是 赞。粉丝类单位就是 个（基本语文常识）</pre>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">商品价格</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="s_price" id="s_price" placeholder="请输入商品价格" value="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">
                                                    <?=get_fenzhan_banben_name(1)?>价格</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="s_fprice1" placeholder="请输入<?=get_fenzhan_banben_name(1)?>的拿货价格" value="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">
                                                    <?=get_fenzhan_banben_name(2)?>价格</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="s_fprice2" placeholder="请输入<?=get_fenzhan_banben_name(2)?>的拿货价格" value="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">
                                                    <?=get_fenzhan_banben_name(3)?>价格</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="s_fprice3" placeholder="请输入<?=get_fenzhan_banben_name(3)?>的拿货价格" value="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">商品排序</label>
                                                    <div class="col-lg-8">
                                                        <input name="s_order" type="text" class="form-control" id="s_order" placeholder="请输入分类排序" value="0"><pre>数字越小越靠前</pre>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">商品描述</label>
                                                    <div class="col-lg-8">
                                                        <textarea name="s_content" id="s_content" class="form-control" rows="3" placeholder="输入商品描述"></textarea>
                                                        <div class="list-group-item list-group-item-info"><a class="btn-xs btn-warning" onclick="$('#form textarea[name=\'s_content\']').val($('#form textarea[name=\'s_content\']').val()+'<a href=\'链接网址\' target=\'_blank\'>链接名称</a>');">添加链接</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel">
                                    <div class="panel-heading bg-gradient-vine">商品对接</div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">对接账户</label>
                                            <div class="col-lg-8">
                                                <select name="duijie" id="duijie" class="form-control" onClick="duijie_post(this)">
                                                    <option value="">请选择对接账户</option>
                                                    <option value="自营">自营</option>
                                                    <?php $result1=mysql_query( 'select * from '.flag. 'duijie where zid = '.$zhu_id. '    order by ID asc '); while($row1=mysql_fetch_array($result1)){ ?>
                                                    <option pingtaiurl="<?=$row1['url']?>" loginpassword="<?=$row1['loginpassword']?>" loginname="<?=$row1['loginname']?>" value="<?=$row1['ID']?>">
                                                        <?=$row1[ 'name']?>
                                                    </option>
                                                    <?php }?>
                                                </select>
                                            </div></div>	<font id="duijie_info">
                                 </font>
                                        </div>
                                        <div class="smart-widget-footer text-right" v-if="apiKind==='this'">
                                            <a class="btn btn-info pull-right" id="save_btn"> <i class="iconfont"></i>添加商品</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
			<?php include_once( 'footer.php'); ?>
   <!-- /wrapper -->
<script type="text/javascript">
    KindEditor.ready(function(K)
    {
        K.create('#i_content');
        var editor = K.editor();
        K('#upload-image').click(function()
        {
            editor.loadPlugin('image', function()
            {
                editor.plugin.imageDialog(
                {
                    imageUrl: K('#s_pic').val(),
                    clickFn: function(url, title, width, height, border, align)
                    {
                        K('#s_pic').val(url);
                        editor.hideDialog();
                    }
                });
            });
        });
    });
</script>
<script type="text/javascript">
    function MM_jumpMenu(targ, selObj, restore)
    { //v3.0
        eval(targ + ".location='" + selObj.options[selObj.selectedIndex].value + "'");
        if (restore) selObj.selectedIndex = 0;
    }

    function MM_goToURL()
    { //v3.0
        var i, args = MM_goToURL.arguments;
        document.MM_returnValue = false;
        for (i = 0; i < (args.length - 1); i += 2) eval(args[i] + ".location='" + args[i + 1] + "'");
    }
</script>
<script type="text/javascript">
    function getdomain()
    {
        var url = $("#zhuzhan").find("option:selected").attr("data-url");
        document.getElementById('zhuurl').value = url;
    }
</script>
<!-- 玖伍-->
<script type="text/javascript">
    function jiuwu()
    {
        var vm = new Vue();
        var sqlx = $("#duijiesid").find("option:selected").attr("data-id");
        document.getElementById('sqlx').value = sqlx;
        var sid = $("#duijiesid").find("option:selected").attr("value");
        var duijie = document.getElementById('duijie').value;
        var pingtaiurl = $("#duijie").find("option:selected").attr("pingtaiurl");
        var loginname = $("#duijie").find("option:selected").attr("loginname");
        var loginpassword = $("#duijie").find("option:selected").attr("loginpassword");
        vm.$post("ajax.php?act=getjiuwuGoodsParam&id=" + sid + "&url=" + pingtaiurl + "&loginname=" + loginname + "&loginpassword=" + loginpassword + "", $("#form-zfconfig").serialize()).then(function(data)
        {
            if (data.code === 0)
            {
                document.getElementById('s_pic').value = data.image;
                document.getElementById('s_dnum').value = data.min;
                document.getElementById('s_gnum').value = data.max;
                document.getElementById('s_name').value = data.name;
                document.getElementById('s_price').value = data.price;
                document.getElementById('canshu').value = data.post;
                vm.$message('成功获取参数', 'success');
            }
            else
            {
                vm.$message(data.message, 'error');
            }
        });
    }
</script>
<script language="JavaScript" type="text/javascript" src="/admin/js/jo.ajax.js"></script>
<script language="javascript" type="text/javascript">
    function testPost_fy()
    {
        var input = document.getElementById("zhuurl"); //通过id获取文本框对象
        //  alert (input.value);
        Ajax.post("zhushopp.php?act=add&url=" + input.value, "xiaoyewl=true" + input.value, function(msg, obj, setting)
        {
            document.getElementById("ajaxResult_fy").innerHTML = msg;
        });
    }

    function isEmpty()
    {
        //form1是form中的name属性   
        var _form = document.form1;
        if (trim(_form.sid.value) == "")
        {
            alert("商品不能为空!");
            return false;
        }
        if (trim(_form.pwd.value) == "")
        {
            alert("密码不能为空!");
            return false;
        }
        return true;
    }
</script>
<script language="javascript" type="text/javascript">
    function duijie_post(value)
    {
        var selectedOption = value.options[value.selectedIndex];
        //alert(selectedOption.value);   
        Ajax.post("copyduijiec.php?id=" + selectedOption.value, "id1=" + selectedOption.value, function(msg1, obj1, setting1)
        {
            document.getElementById("duijie_info").innerHTML = msg1;
        });
    }
</script>
<script type="text/javascript">
    function jmshopcanshu()
    {
		        var vm = new Vue();
        var sid = $("#duijiesid").find("option:selected").attr("value");
        var duijie = document.getElementById('duijie').value;
        var pingtaiurl = $("#duijie").find("option:selected").attr("pingtaiurl");
        var loginname = $("#duijie").find("option:selected").attr("loginname");
        var loginpassword = $("#duijie").find("option:selected").attr("loginpassword");
        vm.$post("ajax.php?act=getjmGoodsParam&id=" + sid + "&url=" + pingtaiurl + "&loginname=" + loginname + "&loginpassword=" + loginpassword + "", $("#form-zfconfig").serialize()).then(function(data)
        {
            if (data.code === 0)
            {
                document.getElementById('s_pic').value = data.image;
                document.getElementById('s_dnum').value = data.min;
                document.getElementById('s_gnum').value = data.max;
                document.getElementById('s_content').value = data.desc;
                document.getElementById('s_name').value = data.name;
                document.getElementById('s_price').value = data.price;
				document.getElementById('canshu').value = data.canshu;
                vm.$message('成功获取参数', 'success');
            }
            else
            {
                vm.$message(data.message, 'error');
            }
        });
    }
</script>
<script type="text/javascript">
    function ylshopcanshu()
    {
        var vm = new Vue();
        var sid = $("#duijiesid").find("option:selected").attr("value");
        var duijie = document.getElementById('duijie').value;
        var pingtaiurl = $("#duijie").find("option:selected").attr("pingtaiurl");
        var loginname = $("#duijie").find("option:selected").attr("loginname");
        var loginpassword = $("#duijie").find("option:selected").attr("loginpassword");
        vm.$post("ajax.php?act=getyileGoodsParam&id=" + sid + "&url=" + pingtaiurl + "&loginname=" + loginname + "&loginpassword=" + loginpassword + "", $("#form-zfconfig").serialize()).then(function(data)
        {
            if (data.code === 0)
            {
                document.getElementById('s_pic').value = data.image;
                document.getElementById('s_dnum').value = data.min;
                document.getElementById('s_gnum').value = data.max;
                document.getElementById('s_content').value = data.desc;
                document.getElementById('s_name').value = data.name;
                document.getElementById('s_price').value = data.price;
				document.getElementById('canshu').value = data.canshu;
                vm.$message('成功获取参数', 'success');
            }
            else
            {
                vm.$message(data.message, 'error');
            }
        });
    }
</script>
<script>
    $(document).ready(function()
    {
        $("#save_btn").click(function()
        {
            var vm = new Vue();
            vm.$post("ajax.php?act=addshop", $("#form-zfconfig").serialize()).then(function(data)
            {
                if (data.code === 0)
                {
                    // document.getElementById("modal-update").style.display = "none";				
                    vm.$message(data.message, 'success');
                    //      $.pjax.reload('#pjax-container');
                }
                else
                {
                    vm.$message(data.message, 'error');
                }
            });
        });
    });
</script>

<?php include( 'password.php'); ?>
</body>

</html>