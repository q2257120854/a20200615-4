   <footer class="footer">
				<span class="footer-brand hidden-xs" style="float: right">
					<strong class="text-danger"><?=$site_name?>-<?=$site_sname?></strong>
				</span>
        <p class="no-margin">
            &copy; <?=date('Y')?> <strong style="color: red"><?=$site_name?>-<?=$site_sname?></strong>. ALL Rights Reserved.
        </p>
    </footer>
</div><!-- /wrapper -->

<a href="#" class="scroll-to-top hidden-print"><i class="fa fa-chevron-up fa-lg"></i></a>

 <!--
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1263103214'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1263103214%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>-->
<script>!window.jQuery && document.write("<script src=\"http://assets.19sky.cn/assets/js/jquery-1.11.1.min.js\">" + "</scr" + "ipt>");</script>
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
        background-image: url(http://demo.lanrenzhijia.com/2014/service1031/images/lanrenzhijia.png);
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
            <h3 class="titZx"><?=$site_naem?></h3>
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
		<? }?>    });

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
 
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- Bootstrap -->
<script src="/assets/style/bootstrap/js/bootstrap.min.js"></script>

<!-- Slimscroll -->
<script src='/assets/style/js/jquery.slimscroll.min.js'></script>

<!-- Datepicker -->
<script src='/assets/style/js/uncompressed/datepicker.js'></script>

<!-- Sparkline -->
<script src='/assets/style/js/sparkline.min.js'></script>

<!-- Skycons -->
<script src='/assets/style/js/uncompressed/skycons.js'></script>

<!-- Popup Overlay -->
<script src='/assets/style/js/jquery.popupoverlay.min.js'></script>

<!-- Easy Pie Chart -->
<script src='/assets/style/js/jquery.easypiechart.min.js'></script>

<!-- Sortable -->
<script src='/assets/style/js/uncompressed/jquery.sortable.js'></script>

<!-- Owl Carousel -->
<script src='/assets/style/js/owl.carousel.min.js'></script>

<!-- Modernizr -->
<script src='/assets/style/js/modernizr.min.js'></script>

<!-- Simplify -->
<script src="/assets/style/js/simplify/simplify.js"></script>
<script src="/assets/common/jquery-pjax-2.0.1/jquery.pjax.min.js"></script>
<script src="/assets/common/jquery.tmpl.min.js"></script>
<script src="/assets/common/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="/assets/common/turnplate/js/jQueryRotate.js"></script>
<script src="/assets/common/turnplate/js/turnplate.js"></script>
<script src="/assets/common/toastr/toastr.min.js"></script>
<script src="/assets/common/layer_mobile/layer.js"></script>
<script src="/assets/common/laydate/laydate.js"></script>
<script src="/assets/common/vue.min.js"></script>
<script src="/assets/common/klsf.js?v=1.3"></script>
 <link href="/assets/common/lucky-money/main.css?1521950131" rel="stylesheet">

 