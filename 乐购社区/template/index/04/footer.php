<!--底部-->
<footer class="navbar-fixed-bottom hidden-xs hidden-sm" style="background-color:<?=$site_endcolor?>">
    <div class="container web_foot">
        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-6"><?=$site_content?>
            </div>
                        <div class="col-md-4 col-sm-6 col-xs-6 text-right"><?=$site_content1?></div>
                    </div>
    </div>
</footer>

 
<script>!window.jQuery && document.write("<script src=\"/<?=$site_skin?>assets/style/js/jquery-1.11.1.min.js\">" + "</scr" + "ipt>");</script>
<style>
    .rides-cs {
        font-size: 12px;
        background: #29a7e2;
        position: fixed;
        top: 250px;
        right: 0px;
        _position: absolute;
        z-index: 1500;
        border-radius: 6px 0px 0 6px;
    }

    .rides-cs a {
        color: #00A0E9;
    }

    .rides-cs a:hover {
        color: #ff8100;
        text-decoration: none;
    }

    .rides-cs .floatL {
        width: 36px;
        float: left;
        position: relative;
        z-index: 1;
        margin-top: 21px;
        height: 181px;
    }

    .rides-cs .floatL a {
        font-size: 0;
        text-indent: -999em;
        display: block;
    }

    .rides-cs .floatR {
        width: 130px;
        float: left;
        padding: 5px;
        overflow: hidden;
    }

    .rides-cs .floatR .cn {
        background: #F7F7F7;
        border-radius: 6px;
        margin-top: 4px;
    }

    .rides-cs .cn .titZx {
        font-size: 14px;
        color: #333;
        font-weight: 600;
        line-height: 24px;
        padding: 5px;
        text-align: center;
    }

    .rides-cs .cn ul {
        padding: 0px;
    }

    .rides-cs .cn ul li {
        line-height: 38px;
        height: 38px;
        border-bottom: solid 1px #E6E4E4;
        overflow: hidden;
        text-align: center;
    }

    .rides-cs .cn ul li span {
        color: #777;
    }

    .rides-cs .cn ul li a {
        color: #777;
    }

    .rides-cs .cn ul li img {
        vertical-align: middle;
    }

    .rides-cs .btnOpen, .rides-cs .btnCtn {
        position: relative;
        z-index: 9;
        top: 25px;
        left: 0;
        background-image: url(/api/doc/file/img/lanrenzhijia.png);
        background-repeat: no-repeat;
        display: block;
        height: 146px;
        padding: 8px;
    }

    .rides-cs .btnOpen {
        background-position: 0 0;
    }

    .rides-cs .btnCtn {
        background-position: -37px 0;
    }

    .rides-cs ul li.top {
        border-bottom: solid #ACE5F9 1px;
    }

    .rides-cs ul li.bot {
        border-bottom: none;
    }
</style>
<div id="floatTools" class="rides-cs" style="height:246px;">
    <div class="floatL">
        <a id="aFloatTools_Show" class="btnOpen" title="查看在线客服" style="top:20px;display:block"
           href="javascript:void(0);">展开</a>
        <a id="aFloatTools_Hide" class="btnCtn" title="关闭在线客服" style="top:20px;display:none" href="javascript:void(0);">收缩</a>
    </div>
    <div id="divFloatToolsView" class="floatR" style="display: none;height:237px;width: 140px;">
        <div class="cn" style="height: 210px;">
            <h3 class="titZx">在线客服</h3>
              <?php
					 
					 if ($zhu=='true')
		{$result = mysql_query('select * from '.flag.'kefu  where zid= '.$zhu_id.'  and fid = 0 order by k_order desc ,ID desc');}
else
		{$result = mysql_query('select * from '.flag.'kefu  where zid= '.$zhu_id.'  and fid = '.$fen_id.' order by k_order desc ,ID desc');}
					
						while($row = mysql_fetch_array($result)){
						 
						 
						?>
                                    <ul id="kfqq_list_<?=$row['ID']?>"></ul>

 		<? }?>
 
  

        </div>
    </div>
</div>
<script>
    $(function () {
        $("#aFloatTools_Show").click(function () {
            $('#divFloatToolsView').animate({width: 'show', opacity: 'show'}, 100, function () {
                $('#divFloatToolsView').show();
            });
            $('#aFloatTools_Show').hide();
            $('#aFloatTools_Hide').show();
        });
        $("#aFloatTools_Hide").click(function () {
            $('#divFloatToolsView').animate({width: 'hide', opacity: 'hide'}, 100, function () {
                $('#divFloatToolsView').hide();
            });
            $('#aFloatTools_Show').show();
            $('#aFloatTools_Hide').hide();
        });
		   <?php
					 
					 if ($zhu=='true')
		{$result = mysql_query('select * from '.flag.'kefu  where zid= '.$zhu_id.'  and fid = 0 order by k_order desc ,ID desc');}
else
		{$result = mysql_query('select * from '.flag.'kefu  where zid= '.$zhu_id.'  and fid = '.$fen_id.' order by k_order desc ,ID desc');}

						while($row = mysql_fetch_array($result)){
						 
						 
						?>
        $("#kfqq_list_<?=$row['ID']?>").html(loadKfqq('<?=$row['name']?>|<?=$row['qq']?>'));
		<? }?>
 
    });

    function loadKfqq(str) {
        var html = "";
        var qqs = str.split(',');
        for (var i = 0; i < qqs.length; i++) {
            if (qqs[i] != "") {
                info = qqs[i].split('|');
                html += '<li><span>' + info[0] + '</span> <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=' + info[1] + '&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:' + info[1] + ':7" alt="点这里给我发消息"/></a></li>';
            }
        }
        return html;
    }
</script>
 
 


<script src="/assets/common/jquery/1.12.0/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/common/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/common/toastr/toastr.min.js"></script>
<script src="/assets/common/md5.min.js"></script>
<script src="/assets/common/layer_mobile/layer.js"></script>
<script src="/assets/common/klsf.js"></script>



<? if ($site_gg!='' and $ll==''){?>
<div id="modal-dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title showTitle text-center"><?=$site_name?>-<?=$site_sname?></h4>
            </div>
            <div class="modal-body bg-warning">
                <?=$site_gg?>            </div>
            <div class="modal-footer" style="text-align: center">
                <button type="button" class="btn btn-info" data-dismiss="modal">知道了</button>
            </div>
        </div>
    </div>
</div>
<? }?>
<script>
    $("#modal-dialog").modal("show");
</script>