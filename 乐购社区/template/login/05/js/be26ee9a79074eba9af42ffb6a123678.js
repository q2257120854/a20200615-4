 <!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>演示站 - 尘埃云社区‖亿乐社区‖玖伍社区|尘埃云演示站</title>
    <meta name="keywords" content="尘埃云卡密社区搭建平台(yunyeka.cn)"/>
    <meta name="description" content="尘埃云社区,小夜网,小夜社区"/>
    <link href="/yunyeka/css/admin/main.css" rel="stylesheet">
    <link href="/yunyeka/assets/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/yunyeka/assets/index/default/main.css">
        <link href="/yunyeka/css/index/icon.css?v=3.0.9" rel="stylesheet">

    <link rel="shortcut icon" href=""/>
    <style>
        .container-fluid {
            min-height: calc(100vh - 4rem);
                   background: ;
				
        }
				   
    </style>
    <style></style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>

<header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar">
    <div>
        <img src="http://xiaoyewl.oss-cn-beijing.aliyuncs.com/images/1000/image/20190121/20190121112635_41805.png" height="28" style="max-width: 240px">
        <button class="btn btn-link bd-search-docs-toggle d-md-none p-0 ml-3" type="button"
                data-toggle="collapse" data-target="#bd-sidebar">
            <i class="iconfont" style="color: white;font-size: 25px">&#xe60b;</i>
        </button>
    </div>
            <div class="ml-md-auto">
            <a href="/" style="color: white"><i class="iconfont">&#xe637;</i> 演示站</a>
        </div>
        <ul class="navbar-nav flex-row ml-md-auto d-none d-flex">
            
				 
      <li class="nav-item">
                    <a class="nav-link " href="/chadan" target="_blank"><i
                                class="iconfont">&#xe658;</i> 在线查单</a>
                </li>
   
  <li class="nav-item">
                    <a class="nav-link " href="/xinyong" target="_blank"><i
                                class="iconfont">&#xe658;</i> 信用查询</a>
                </li>            <li class="nav-item">
                            <a class="nav-link" href="/login/"><i class="iconfont">&#xe66d;</i> 登录/注册</a>
                    </li>
                    

    </ul>
</header>
<div class="container-fluid" id="vue">
    <div class="row flex-xl-nowrap">
        <div class="col-12 col-md-3 col-xl-2 bd-sidebar">
            <nav class="bd-links collapse" id="bd-sidebar">
                <div class="bd-toc-item">
                    <a class="bd-toc-link active" id="class-0" @click="selectClass(0)">所有分类</a>
                </div>
                <div class="bd-toc-item" v-for="(row,i) in classList" :key="i">
                    <a class="bd-toc-link" :id="'class-'+row.cid" @click="selectClass(row.cid)">{{ row.name }}</a>
                </div>
            </nav>
        </div>
        
   
                    
        <main class="col-12 col-md-9 col-xl-9 py-md-8 pl-md-8 bd-content" role="main">
        
         
                    
            <div class="row">
           
                  	   
         <div class="col-12 p-1">
                        <div class="alert alert-success">
                 尘埃云(yunyeka.cn)                        
	 
                        </div>
                    </div>                            
                                 	 




                                <div class="col-xl-2 col-md-3 col-6 text-center p-1" v-for="(row,i) in data" :key="i">
                    <div class="thumbnail">
                        <a @click="go(row.gid)">
                            <img :src="row.image" :alt="row.name" :title="row.name"
                                 onerror="this.src='http://demo.611sq.cn/yunyeka/images/noimg.jpg';">
                              <div style="width: calc(100% - 30px);display:block;overflow: hidden;text-overflow:ellipsis;white-space: nowrap;text-align: left">
                                {{row.name }}
                            </div>
                        </a>
                   
                        
                                        <div class="iconfont" style="display:block;float: right;font-size: 16px;padding-top: 4px;margin-top: -24px;width: 40px;text-align: right"
                             :class="{'icon-red':collectList.indexOf(row.gid+'')>-1}"
                             :title="collectList.indexOf(row.gid+'')>-1?'取消收藏':'收藏'"
                             @click="collect(row.gid,collectList.indexOf(row.gid+'')>-1?0:1)"
                             v-html="collectList.indexOf(row.gid+'')>-1?'&#xe60a;':'&#xe63b;'">&#xe63b;</div>
                             
                             
                    
                        
                    </div>
                </div>
            </div>
            
            <footer>
                尘埃云(yunyeka.cn)				                            </footer>
        </main>
    </div>
</div>
<script src="/yunyeka/assets/jquery.min.js"></script>
<script src="/yunyeka/assets/bootstrap/popper.min.js"></script>
<script src="/yunyeka/assets/bootstrap/bootstrap.min.js"></script>
 
<script src="/yunyeka/assets/layer/layer.js"></script>
<script src="/yunyeka/js/index/main.js?v=3.0.9"></script>
<script>
  var vueData = {
        el: '#vue',
        data: {
            goodsList: [],
            classList: [],
            collectList: [],
            data: []
        },
        methods: {
            collect: function (gid, act) {
                if (this.collectList.indexOf(gid + '') === -1) {
                    if (act) {
                        //收藏
						layer.alert('请先登录!');
                    }
                } else if (!act) {
                    //取消收藏
                this.$post('/ajax/collect.php', {action: 'delcollect', gid: this.collectList.splice(this.collectList.indexOf(gid + ''), 1)});
                    this.collectList.splice(this.collectList.indexOf(gid + ''), 1);
                }
             },
      getGoodsAndClass: function () {
        var vm = this;
        this.$post('/ajax/goodslist.php', {action: 'getGoodsAndClass'})
          .then(function (data) {
            if (data.status === 0) {
              vm.goodsList = data.data.goods;
              vm.classList = data.data.class;
              vm.collectList = data.data.collect;
              vm.data = data.data.goods;

              vm.$nextTick(function () {
                vm.indexNextTick();
              });
            } else {
              layer.alert(data.message);
            }
          });
      },
      open: function (url, target) {
        var a = document.createElement('a');
        a.setAttribute('href', url);
        if (target) {
          a.setAttribute('target', '_blank');
        }
        a.setAttribute('id', 'goUrl');
        // 防止反复添加
        if (document.getElementById('goUrl')) {
          document.body.removeChild(document.getElementById('goUrl'));
        } else {
          document.body.appendChild(a);
        }
        a.click();
      },
      go: function (gid) {
		                                    this.open("/login/" + gid+".html", true);
					                  },
      selectClass: function (cid) {
        cid = parseInt(cid);
        var vm = this;
        if (cid === 0) {
          vm.data = vm.goodsList;
        } else {
          var _data = [];
          vm.goodsList.forEach(function (goods) {
            if (goods.cid === cid) {
              _data.push(goods);
            }
          });
          vm.data = _data;
        }
      },
      indexNextTick: function () {

      }
    },
    mounted: function () {
      this.getGoodsAndClass();
    }
  };
</script>

    <div style="display: none" id="html-dialog">
       尘埃云    </div>
    <script>
      layer.alert($("#html-dialog").html());
    </script>
	<script>!window.jQuery && document.write("<script src=\"/yunyeka/assets/jquery.min.js\">" + "</scr" + "ipt>");</script>
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
        background-image: url(/yunyeka/images/chat.png);
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
        <div style="text-align: center;margin-top: 50px;">
          <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1275814471'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s23.cnzz.com/stat.php%3Fid%3D1275814471%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>        </div>
    </div>
    <div id="divFloatToolsView" class="floatR" style="display: none;height:237px;width: 140px;">
        <div class="cn" style="height: 210px;">
            <h3 class="titZx">演示站</h3>
            <ul id="kfqq_list"></ul>
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
    $("#kfqq_list").html(loadKfqq('少杰客服|2386150577'));
  });

  function loadKfqq (str) {
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
</script><script>
  vueData.methods.selectClass = function (cid) {
    cid = parseInt(cid);
    var vm = this;
    if (cid === 0) {
      vm.data = vm.goodsList;
    } else {
      var _data = [];
      vm.goodsList.forEach(function (goods) {
        if (goods.cid === cid) {
          _data.push(goods);
        }
      });
      vm.data = _data;
    }
    $(".bd-toc-item .active").removeClass('active');
    $("#class-" + cid).addClass('active');
    if (window.screen.width <= 768) {
      $("#bd-sidebar").collapse('hide');
    }
  };
  new Vue(vueData);
</script></body>
</html>