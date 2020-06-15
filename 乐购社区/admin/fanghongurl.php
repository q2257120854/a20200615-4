<?
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
$nav = 'fanghong';
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>防红管理 - <?=$site_name?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<script type="text/javascript" language="javascript">
    function selectBox(selectType){
    var checkboxis = document.getElementsByName("id[]");
    if(selectType == "reverse"){
      for (var i=0; i<checkboxis.length; i++){
        //alert(checkboxis[i].checked);
        checkboxis[i].checked = !checkboxis[i].checked;
      }
    }
    else if(selectType == "all")
    {
      for (var i=0; i<checkboxis.length; i++){
        //alert(checkboxis[i].checked);
        checkboxis[i].checked = true;
      }
    }
   }
</script>	
     <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
.table-bordered th{font-size:13px;}
.table-bordered td{font-size:13px;}
		
		
    </style>
    
</head>

<div class="wrapper preload">
<?
 include('header.php');
?>
<div class="an-content-body" style="padding: 8px" id="pjax-container">
    <div id="vue">
        <div class="row">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading bg-gradient-vine">防红域名</div>
                    <div class="panel-body">
                        <form id="form-config" class="form-horizontal">
                            <input name="action" type="hidden" value="fanghong">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">域名</label>
                                <div class="col-lg-9">
                                    <input type="text" name="url" id="url" placeholder="请输入您的域名" value="http://<?=$_SERVER['HTTP_HOST']?>/" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">平台</label>
                                <div class="col-lg-9">
<select name="type" id="type" class="form-control" default="1">
			    <option value="2" selected="">防红方式 - 直连</option>
				<option value="1" selected="">防红方式 - 跳转</option>
</select>
                                </div>
                            </div>
                                <div class="form-group" id="xurlkg" style="display: none;">
                                    <label class="col-sm-3 control-label">地址</label>
                                    <div class="col-sm-9">
                                        <div class="an-input-group right">
                                            <input name="xurl" readonly="readonly" id="xurl" type="text" value="" class="an-form-control"> <span onclick="copyneirong('xurl','短网址')" class="an-input-group-addon bg-gradient-green" style="font-size: 12px; color: white;">复制</span>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <div class="panel-footer"><a class="btn btn-info pull-right" @click="save('config','fanghong')">
                            <i class="iconfont">&#xe688;</i> 生成
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
   
 <? include('footer.php');
?>
 <script>
    new Vue({
        el: '#vue',
        data: {},
        methods: {
            save: function(id, act) {
                var vm = this;
                this.$post("ajax.php?act=" + act + "", $("#form-" + id).serialize())
                    .then(function(data) {
                        if (data.status === 0) {
                            document.getElementById('xurlkg').style.display = 'block';
                            document.getElementById('xurl').value = data.message;
                            vm.$message('生成成功!', 'success');
                        } else {
                            vm.$message(data.message, 'error');
                        }
                    });
            }
        },
        mounted: function() {}
    });


    function copyneirong($id, $title) {
        const range = document.createRange();
        range.selectNode(document.getElementById($id));

        const selection = window.getSelection();
        if (selection.rangeCount > 0) selection.removeAllRanges();
        selection.addRange(range);
        document.execCommand('copy');
        alert($title + "复制成功！");
    }
</script>

 </body>
</html>
