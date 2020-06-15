window.zwDivine = {
    uvUrl: "https://divine.h55u.com/divine.php/Platform/Index/recordUv",
    userInfoUrl: "https://divine.h55u.com/divine.php/Platform/Index/recordUserInfoApi",
    payUrl: "http://divine.h55u.com/divine.php/Platform/Pay/index",
    srcUrl : "http://divine.h55u.com/divine.php/Platform/Pay/srcRecord",
    qrcodeUrl : "https://divine.h55u.com/divine.php/Platform/Index/qrcodeApi",
    orderUrl : "https://divine.h55u.com/divine.php/Platform/Index/orderCheck",
    complaintUrl : "http://divine.h55u.com/divine.php/Platform/Index/complaint",
    playAgainUrl : "http://j.5flyyou.com/divine.php/Url/Platform/divine",
    resultUvUrl : "https://divine.h55u.com/divine.php/Platform/Index/recordResultUv",
    resultCommentUrl : "https://divine.h55u.com/divine.php/Platform/Index/commentApi",
    payChannel : 1,
    payRemain : 1200,
    zwUid: "",
    zwGameId: 0,
    zwSource: 0,
    payType : 1,
    zwOrderId : "",
    init: function () {
        this.zwUid = this._getRequest("zwUid");
        this.zwGameId = this._getRequest("zwGameId");
        this.zwSource = this._getRequest("zwSource");
        this.payType = this._getRequest("pay_type");
        if(this.zwGameId && this.zwSource){
            var incimage = new Image();
            incimage.src = this.srcUrl + "?src=" + this.zwSource;
            localStorage.setItem("zwSource", this.zwSource);
            localStorage.setItem("zwGameId", this.zwGameId);
            setTimeout(function(){zwDivine.indexComplaint()}, 2000);
            this.recordUv();
        }
        if(this.zwGameId && this.payType){
            localStorage.setItem("payType" + this.zwGameId, this.payType);
        }
        var zwOrderId = this._getRequest("zwOrderId");
        if(zwOrderId){
            this._ajaxPost(this.orderUrl, {order_id: zwOrderId}, function(re){
                var reObj = JSON.parse(re);
                if((typeof reObj.code != "undefined") && reObj.code == 1){
                    zwDivine.zwOrderId = zwOrderId;
                    zwDivine.zwGameId = reObj.data.gid;
                    zwDivine.zwSource = reObj.data.src;
                    zwDivine.result();
                    var incimage = new Image();
                    incimage.src = zwDivine.resultUvUrl + "?orderId=" + zwOrderId;
                    if(reObj.data.result_comment_type == 1){
                        zwDivine.resultCommentInit();
                    }
                }
            });
        }
    },
    resultCommentInit: function(){
        var commentHtml = '<style>.zhiwu-flex-center{display:flex;justify-content:center;align-items:center}.zhiwu-flex-row{display:flex;flex-direction:row;align-items:center;justify-content:space-between}.zhiwu-flex-column{display:flex;flex-direction:column;align-items:center;justify-content:flex-start}section.zhiwu-page{width:100%;max-width:640px;margin:0 auto;position:relative;padding-bottom:100px;background-color:#FAF9F4;color:#000000;z-index:1}div.zhiwu-content-box{width:100%;border-top:5px solid#dddddd}div.zhiwu-content-box div.zhiwu-content{width:100%;position:relative;box-sizing:border-box;padding:0 20px}img.zhiwu-comment-title{display:block;width:140px;height:auto;margin-top:20px;margin-bottom:10px}div.zhiwu-nickname-wrap{width:100%;justify-content:flex-start;font-size:16px;margin-top:10px}div.zhiwu-input-group{margin-right:40px;justify-content:flex-start}div.zhiwu-input-group input.zhiwu-nickname{height:26px;width:100px;border:1px solid#F0F0F0;font-size:16px;border-radius:5px;color:#a3a3a3;text-indent:3px;margin-left:4px;outline:0;-webkit-appearance:none;-webkit-tap-highlight-color:rgba(0,0,0,0)}span.zhiwu-un-name-wrap{justify-content:flex-start}span.zhiwu-un-name-wrap input.zhiwu-un-name{margin-right:2px;-webkit-appearance:checkbox!important;-moz-appearance:checkbox!important}div.zhiwu-expres-wrap{width:100%;margin-top:10px;justify-content:flex-start;font-size:16px}div.zhiwu-expres-wrap div.zhiwu-stars{justify-content:flex-start;margin-right:30px;width:120px!important;-webkit-tap-highlight-color:rgba(0,0,0,0);-webkit-tap-highlight-color:transparent}div.zhiwu-expres-wrap div.zhiwu-stars img{display:block;width:20px;height:auto;margin-right:4px}div.zhiwu-expres-wrap span.zhiwu-pinfen{margin-right:4px}div.zhiwu-expres-wrap span.zhiwu-emoji-wrap{padding:2px 4px;background:#ff9900;color:#FFFFFF;font-size:15px;border-radius:4px}div.zhiwu-expres-wrap img.zhiwu-emoji{display:block;width:18px;height:18px;margin-right:4px}div.zhiwu-edit-wrap{width:100%;margin-top:10px}div.zhiwu-edit-wrap textarea.zhiwu-comment-text{width:100%;background:#fbf7eb;border:solid 1px#d9d9d9;border-radius:5px;padding:2px;line-height:1.5;font-size:16px;color:#a3a3a3;outline:0;-webkit-appearance:none;-webkit-tap-highlight-color:rgba(0,0,0,0)}div.zhiwu-edit-wrap textarea.zhiwu-comment-text:focus{outline:none}img.zhiwu-submit{display:block;width:84%;height:auto;margin-top:20px}div.zhiwu-toast-wrap{position:fixed;z-index:9999;width:100%;left:0;top:35%}div.zhiwu-toast-wrap div.zhiwu-toast-box{width:100%;max-width:640px}.zhiwu-toast{white-space:nowrap;font-size:18px;color:#FFFFFF;padding:6px 10px;border-radius:6px;background-color:rgba(0,0,0,0.8)}</style><section class="zhiwu-page zhiwu-flex-column"id="zhiwu_page"><div class="zhiwu-content-box zhiwu-flex-column"><div class="zhiwu-content zhiwu-flex-column"><img class="zhiwu-comment-title"src="http://divine.cdn.h55u.com/platform/image/comment_title.png"><div class="zhiwu-nickname-wrap zhiwu-flex-row"><div class="zhiwu-input-group zhiwu-flex-row"><label for="zhiwu_nickname">昵称:</label><input class="zhiwu-nickname"id="zhiwu_nickname"type="text"value=""maxlength="6"></div><span class="zhiwu-un-name-wrap zhiwu-flex-row"><input type="checkbox"id="zhiwu_un_name"class="zhiwu-un-name"><span>匿名评价</span></span></div><div class="zhiwu-expres-wrap zhiwu-flex-row"><span class="zhiwu-pinfen">评分:</span><div id="zhiwu_star"class="zhiwu-stars zhiwu-flex-row"><img data-score="1"class="star"src="http://divine.cdn.h55u.com/platform/image/star-on.png"><img data-score="2"class="star"src="http://divine.cdn.h55u.com/platform/image/star-on.png"><img data-score="3"class="star"src="http://divine.cdn.h55u.com/platform/image/star-on.png"><img data-score="4"class="star"src="http://divine.cdn.h55u.com/platform/image/star-on.png"><img data-score="5"class="star"src="http://divine.cdn.h55u.com/platform/image/star-on.png"></div><span class="zhiwu-emoji-wrap zhiwu-flex-center"><img class="zhiwu-emoji"id="zhiwu_emoji"src="http://divine.cdn.h55u.com/platform/image/expres_05.png"><span class="zhiwu-emoji-desc"id="zhiwu_emoji_desc">非常满意</span></span></div><div class="zhiwu-edit-wrap zhiwu-flex-center"><textarea class="zhiwu-comment-text"id="zhiwu_comment_content"placeholder="请在下方留下您真实的评价和建议，我们将在您的督促下不断提升服务品质。"maxlength="50"rows="5"></textarea></div><img class="zhiwu-submit"id="zhiwu_submit"src="http://divine.cdn.h55u.com/platform/image/submit_btn.png"alt="提交"></div></div><div id="zhiwu_toast_wrap"class="zhiwu-toast-wrap zhiwu-flex-center"><div class="zhiwu_toast_box zhiwu-flex-center"><span id="toast"></span></div></div></section>';
        if(!document.getElementById('zhiwu-content-wrap')){
            document.getElementsByTagName('body')[0].insertAdjacentHTML("beforeEnd", commentHtml);
            var scores = 5;
            var zhiwu_star = zhiwu("zhiwu_star");
            var emoji = zhiwu("zhiwu_emoji");
            var emoji_desc = zhiwu("zhiwu_emoji_desc");
            var zhiwu_un_name = zhiwu("zhiwu_un_name");
            var zhiwu_nickname = zhiwu("zhiwu_nickname");
            var zhiwu_comment_content = zhiwu("zhiwu_comment_content");
            var zhiwu_submit = zhiwu('zhiwu_submit');
            var temp_name = "";
            zhiwu_un_name.addEventListener("click", function(){
                var comment_nickname = "";
                var cn_name = zhiwu_un_name.checked;
                if (cn_name) {
                    temp_name = zhiwu_nickname.value;
                    zhiwu_nickname.value="匿名";
                    zhiwu_nickname.setAttribute("readonly", "readonly");
                } else {
                    zhiwu_nickname.value=temp_name;
                    zhiwu_nickname.removeAttribute("readonly");
                }
            });
            zhiwu_nickname.addEventListener("blur", function () {
                setTimeout(function () {
                    window.scrollTo(0, document.body.scrollHeight);
                }, 500);
            });
            zhiwu_star.addEventListener("click", function(e){
                var ev = ev || window.event;
                var target = ev.target || ev.srcElement;
                if (target.nodeName.toLowerCase() == 'img') {
                    var stars = document.getElementsByClassName("star");
                    var score = parseInt(target.dataset.score);
                    for (var i = 0; i < stars.length; i++) {
                        if(i>(score - 1)){
                            stars[i].src = "http://divine.cdn.h55u.com/platform/image/star-off.png";
                        }else{
                            stars[i].src = "http://divine.cdn.h55u.com/platform/image/star-on.png";
                        }
                    }
                    expres(score)
                }
            })
            zhiwu_comment_content.addEventListener("blur", function () {
                setTimeout(function () {
                    window.scrollTo(0, document.body.scrollHeight);
                }, 500);
            });
            zhiwu_comment_content.addEventListener("keyup", function () {
                var maxLength = 50;
                var len = zhiwu_comment_content.value.length;
                if (len > maxLength - 1) {
                    var res = zhiwu_comment_content.value.substring(0, 50);
                    zhiwu_comment_content.value=res;
                    showToast("评论字数不超过50字");
                }
            });
            zhiwu_submit.addEventListener("click", function () {
                var un_name = zhiwu_un_name.checked;
                var is_nickname = zhiwu_un_name.checked ? true : checkNameData();
                var is_comment_content = checkCommentData();
                var nicknames = un_name ? '匿名' : zhiwu_nickname.value;
                if (is_nickname && is_comment_content) {
                    zwDivine._ajaxPost(zwDivine.resultCommentUrl, {
                        order_id: zwDivine.zwOrderId,
                        nickname: nicknames,
                        score: scores,
                        comment: zhiwu_comment_content.value
                    }, function(res){
                        res = JSON.parse(res);
                        if(res.code){
                            showToast("感谢您的评价！");
                            zhiwu_un_name.checked = false;
                            zhiwu_nickname.value = "";
                            zhiwu_comment_content.value = "";
                        }else{
                            showToast("请稍后再试！")
                        }
                    });
                }
            });
            function checkCommentData() {
                var n = zhiwu_comment_content.value;
                if (!n) {
                    showToast("您还没有填写评论！");
                    return false;
                }
                if (forbidWord(n)) {
                    showToast("您填写的评论含有敏感词汇");
                    return false;
                }
                return true;
            }
            function checkNameData() {
                var n = zhiwu_nickname.value;
                if (forbidWord(n)) {
                    showToast("您填写的昵称属于敏感词汇");
                    return false;
                }
                if (n.length > 7) {
                    showToast("您的昵称超出字数限制");
                    return false;
                }
                return true;
            }
            function forbidWord(e) {
                var t = ["QQ", "腾迅", "号码", "system", "admin", "淫賤", "去死", "吃屎", "妈的", "娘的", "日你", "尻", "操你", "干死你", "王八", "傻逼", "傻B", "贱人", "狗娘", "婊子", "表子", "靠你", "叉你", "叉死", "插你", "插死", "干你", "干死", "日死", "鸡巴", "睾丸", "包皮", "龟头", "屄", "赑", "妣", "肏", "奶子", "屌", "成人文学", "成人图片", "成人电影", "性爱电影", "情色电影", "学生妹", "情色图片", "情色贴图", "无码电影", "特肖", "禁肖", "杀尾公式", "杀肖公式", "曾道人", "特码生肖", "法轮大法", "修炼之歌", "弘法会", "大法弘传", "法轮功", "大法之声", "灵修团体", "宇宙最高法理", "真善忍大法", "正法洪流", "五套功法", "师傅法身", "师父法身", "李洪志", "大法弟子", "真修弟子", "弟子正法", "天安门受难", "六四惨案", "六四真相", "八九民运", "民运人士", "红色恐怖", "民主运动", "邓二世", "天安门血", "自由网", "明慧网", "正见网", "圆明网", "打印机版", "fawanghuihui", "minghui", "freenet-china", "yuanmingeurope", "secretchina", "江政府", "江泽民当局", "江核心", "江路线", "江泽民政权", "江贼", "江贼民", "江昏君", "江二世", "中共当局", "大陆当局", "大陆官员", "中共媒体", "共匪", "共产专制", "古拉格", "当权者", "恶警", "宗教迫害", "大法第子", "天安门受难人", "开悟弟子正法", "媽的", "幹死你", "賤人", "幹你", "幹死", "雞巴", "龜頭", "贔", "成人文學", "成人圖片", "成人電影", "性愛電影", "情色電影", "學生妹", "情色圖片", "情色貼圖", "無碼電影", "殺尾公式", "殺肖公式", "特碼生肖", "法輪大法", "修煉之歌", "弘法會", "大法弘傳", "法輪功", "大法之聲", "靈修團體", "師傅法身", "師父法身", "天安門受難", "六四慘案", "天安門受難人", "開悟弟子正法", "惡警", "當權者", "古拉格", "共産專制", "中共媒體", "大陸官員", "大陸當局", "中共當局", "江澤民政權", "江路線", "江澤民當局", "印表機版", "圓明網", "正見網", "明慧網", "自由網", "天安門血", "鄧二世", "紅色恐怖", "毛泽东", "江泽民", "胡錦濤", "溫家寶", "賤B", "毛澤東", "周恩來", "共產黨", "操你媽", "鄧小平", "前列腺", "裸照", "AV女優", "強姦", "胡政府", "胡錦濤當局", "胡核心", "胡路線", "胡錦濤政權", "胡昏君", "中國", "中華人民共和國", "主席", "總統", "省長", "吳邦國", "賈慶林", "李長春", "習近平", "李克強", "賀國強", "周永康", "胡锦涛", "温家宝", "贱B", "毛泽东", "周恩来", "共产党", "操你妈", "邓小平", "前列腺", "裸照", "AV女优", "强奸", "胡政府", "胡锦涛当局", "胡核心", "胡路线", "胡锦涛政权", "胡昏君", "中国", "中华人民共和国", "总统", "省长", "吴邦国", "贾庆林", "李长春", "习近平", "李克强", "贺国强", "周永康", "混蛋", "無恥", "下流", "fuck", "mmd", "卑鄙", "流氓", "淫賤", "淫賤", "sb", "SB", "去死", "吃屎", "媽的", "娘的", "日你", "尻", "操你", "干死你", "王八", "傻逼", "傻B", "賤人", "我靠", "狗娘", "婊子", "表子", "靠你", "叉你", "叉死", "插你", "插死", "干你", "干死", "日死", "雞巴", "痞子", "睪丸", "包皮", "龜頭", "屄", "贔", "妣", "肏", "奶子", "尻", "屌", "成人文學", "成人圖片", "成人電影", "性愛電影", "落霞缀", "死一边去", "盖塔奥", "母猪", "强淫", "挨了一炮", "麻古", "滚蛋", "黑喂狗", "猪公", "中共主席", "搅基", "卖淫", "麻果配", "骚人", "闹太套", "大脑短路", "藏独", "黄段子", "藏独", "麻果丸", "骚", "本宫", "烂泥", "疆独", "笨拉灯", "操了嫂", "麻将透", "新建户", "攻受", "废渣", "马英九", "战五渣", "操嫂子", "麻醉狗", "新疆叛", "小妾", "作呕", "水扁", "矮仔", "插屁屁", "麻醉枪", "新疆限", "可攻可受", "进天堂", "衰人", "傻仔", "察象蚂", "麻醉枪", "新金瓶", "不是人", "裹胸", "处男", "奸夫", "成人电", "麻醉药", "新唐人", "何弃疗", "裹脚布", "马克思", "黑鬼", "成人卡通", "毛一鲜", "姓忽悠", "土憋", "耗子", "列宁", "洗了滚", "成人聊", "美艳少妇", "性爱日", "绿茶婊", "你吖", "中华人民", "娼妓", "成人片", "妹按摩", "性福情", "婊", "绑大款", "共和国", "猪仔", "成人视", "妹上门", "性感少", "婊了", "养小蜜", "社会", "啥表", "成人图", "蒙汗药", "性推广歌", "吊炸天", "吃里扒外", "民主党", "锉毙", "成人文", "迷幻型", "胸主席", "菊花", "溅B", "64", "粪便", "成人小", "迷幻药", "徐玉元", "爆菊", "跑堂狗", "民主", "膣屄", "充气娃", "迷幻药", "爆菊花", "特妈", "破鞋", "尿泡", "催眠水", "迷昏口", "丫的", "无节操", "嬷痹", "扯巴子", "吹箫", "催情粉", "迷昏药", "性器", "菜鸟", "娘个B德", "溜洽子", "干你娘", "催情药", "迷昏药", "烟感器", "波霸", "B叫", "瓜哇子", "屌你老母", "催情药", "迷魂香", "严晓玲", "泡M", "滚", "龟儿子", "肏你妈", "挫仑", "迷魂药", "颜射", "泡妞", "滚回去", "臭婊子", "打飞机", "鸡巴", "迷魂药", "劳教", "毛片", "滚床单", "二流子", "泥马", "鸡巴", "迷奸药", "劳改犯", "好个毛", "滚床单", "鸡鸡", "骚货", "奶子", "迷情水", "颜射", "你妹", "犊子", "粪胀", "雏妓", "肉棒", "迷情药", "姚明进去", "毛线", "滚犊子", "杂种", "狗噏", "代孕", "迷药", "要射精了", "傻帽", "草死你妈", "十三点", "烂臭鞋", "法车仑", "谜奸药", "要射了", "傻X", "废了你", "该猪吃", "恶狗", "法正干", "蜜穴", "要泄了", "熊样", "残废", "狗造化", "恶棍", "法轮", "内射", "夜激情", "唾弃", "大比岔", "你算老几", "无赖", "法轮佛", "嫩穴", "液体炸", "腐植质", "卖骚", "秀逗", "蠢人", "法维权", "嫩阴", "一小撮别", "装B", "卖弄", "没脑子", "贱货", "法一轮", "操你妈", "遗情书", "装b", "扮纯", "脑子进水", "没屁眼", "法院给废", "拟涛哥", "蚁力神", "呆逼", "装纯", "骚包", "狗娘养的", "仿真枪", "娘两腿之间", "阴间来电", "傻逼", "败类", "贱皮子", "贱猪", "夫妻交换", "妞上门", "阴唇", "二逼", "fuck", "解放军", "蠢猪", "感扑克", "浓精", "阴道", "死逼", "damn", "妓女", "婊子养的", "冈本真", "女被人家搞", "阴户", "笨蛋", "丑角", "政府", "疯狗", "肛交", "女激情", "淫魔舞", "白痴", "ET", "缩头乌龟", "肛门是邻", "女优", "淫情女", "二痴", "变态", "团体", "卖比", "冈本真", "炮的小蜜", "淫肉", "蛋白质", "凤姐", "游行", "傻吊", "钢针狗", "喷尿", "淫骚妹", "王八", "屁股", "小日本", "人模狗样", "钢珠枪", "嫖俄罗", "淫兽", "三八", "MMD", "坯子", "港澳博球", "嫖鸡", "淫兽学", "东方标志", "NND", "大麻", "歪逼", "港马会", "仆不怕饮", "淫水", "东方婊子", "禽兽", "起义", "操逼", "港鑫华", "普通嘌", "淫穴", "比样迪", "兽", "抵制", "装葱", "高莺莺", "叫床", "咏妓", "逼样的", "下贱", "拉萨", "癞蛤蟆", "搞媛交", "色黄", "幽谷三", "DBF", "欠踹", "开打", "狼心狗肺", "共狗", "色黄图", "游精佑", "大泼妇", "欠拍", "李登辉", "挨刀的货", "共王储", "奇淫散", "有奶不一", "兔崽子", "欠拧", "陈水扁", "死不要脸", "狗粮", "贱淫", "右转是政", "不想活啦", "死皮赖脸", "卧槽", "屎坨坨", "滚圆大乳", "淫荡", "幼齿类", "他奶奶的", "剑人", "我擦", "卖骚", "国家妓", "贱B", "愚民同", "去死吧你", "醉银剑", "屌爆了", "卖逼", "和狗交", "柔胸粉", "愚民政", "祖宗", "人剑合一", "我嘞个去", "阳痿", "和狗性", "肉洞", "与狗性", "祖宗十八代", "化粪池", "二货", "寄生虫", "和狗做", "肉棍", "玉蒲团", "蠢材", "流氓", "脑弱", "傻子", "红色恐", "如厕死", "鸳鸯洗", "蠢货", "山寨", "次奥", "窝囊", "胡江内斗", "乳交", "砍杀", "呕像", "恶心", "蛋碎", "窝囊废", "胡紧套", "软弱的国", "杀人犯", "小妞", "该死", "粉木耳", "歪瓜劣枣", "胡锦涛", "赛后骚", "凶杀", "老娘", "BT", "黑木耳", "胡扯", "胡适眼", "三挫", "血案", "青蛙头", "呆瓜", "搞基", "狗屁", "胡耀邦", "三级片", "韵徐娘", "阴阳失调", "呆子", "撸管", "仆街", "湖淫娘", "三秒倒", "炸死", "河马", "dork", "谢特", "南朝鲜人", "虎头猎", "三网友", "植物冰", "火山喷发", "下流", "装逼", "后庭", "华国锋", "三唑", "殖器护", "垃圾人", "泼妇", "矮穷挫", "总理", "华门开", "骚妇", "惨案", "垃圾", "淫猥", "活春宫", "我日", "吹萧", "骚浪", "凶案", "恐龙", "公驴", "银枪小霸王", "屁眼", "还看锦涛", "骚穴", "贪官", "青蛙", "傻瓜", "拔吊无情", "老二", "换妻", "骚嘴", "狗官", "废材", "蠢驴", "拔屌无情", "鞭鞭", "浑圆豪乳", "扫了爷爷", "昼将近", "孙了", "神经病", "屁话", "汉奸", "激情电", "色电影", "主席忏", "装孙", "青楼", "滚粗", "强暴", "激情短", "色妹妹", "着涛哥", "装孙子", "便便", "废柴", "钉子户", "激情炮", "色小说", "自由圣", "瞎搞", "马屁精", "打炮", "揩油", "激情妹", "色视频", "自慰用", "扯蛋", "大便", "聊骚", "恶爆", "急需嫖", "尸博", "自由亚", "一陀粪", "痴呆", "潮吹", "恶霸", "腐败", "失身水", "有毛病", "一陀屎", "牛逼烘烘", "煞笔", "耐操", "打砸抢", "失意药", "我靠", "草包", "无节操", "波推", "顶你个肺", "奸成瘾", "狮子旗", "靠", "自杀", "强奸", "阴经", "共和国", "江胡内斗", "十八等", "迷药", "妈蛋", "色诱", "八婆", "小鬼子", "江太上", "十大谎", "作死", "无性生殖", "手淫", "鸡婆", "李克强", "江系人", "十大禁", "做爱", "生殖", "你大姨妈的", "拉皮条", "李长春", "疆独", "熟妇", "做爱小", "智障", "坑爹", "嘿咻", "张德江", "自慰", "贱民", "套套", "丑陋", "坑妈", "约炮", "俞正声", "叫自慰", "太王四神", "泄", "自爆", "坑爷", "娘炮", "刘云山", "姐包夜", "六四", "妈蛋", "灭了", "坑奶奶", "屁民", "王歧山", "姐服务", "东突", "死边去", "基因突变", "你有病", "援交", "张高丽", "姐兼职", "探测狗", "屌丝", "你tmd", "渣滓", "土肥圆", "李援朝", "姐上门", "涛共产", "鸟", "吹牛b", "碎渣", "基佬", "李源朝", "猪头", "涛一样胡", "鸟人", "群殴", "杂碎", "孬种", "博熙来", "狗蛋", "特码", "屌人", "撒子", "没用的家伙", "备胎", "傻蛋", "天朝特", "草泥马", "自恋", "混蛋", "民奸", "蛋疼", "偷偷贪", "法克由", "吹牛", "废物", "傻冒", "操蛋", "推油按", "法克", "狗眼", "畜牲", "歇菜", "MLGB", "脱衣艳", "吊儿郎当的", "狗嘴", "八嘎", "歇火", "去年买了个表", "瓦斯手", "他妈的", "矫情", "笨脑子", "菊花紧", "mlgb", "袜按摩", "他妈", "屁颠", "阿呆", "牛X", "qnmgb", "温家堡", "XXOO", "骗钱", "疯子", "我顶你个肺", "精子射", "温切斯特", "丫滴", "你大爷", "卑贱", "牛叉", "就爱插", "温影帝", "怂样", "脑残片", "卑鄙", "麻痹", "就要色", "温家宝", "丑角", "脑残", "小偷", "奶奶个熊", "巨乳", "瘟加饱", "死翘翘", "被驴踢", "麻子脸", "咸猪手", "拉登说", "瘟假饱", "屎样", "被驴踢", "老家伙", "天朝", "浪穴", "纹了毛", "狗屎", "你妈妈的", "该死的", "鬼畜", "黎阳平", "台独", "邓小平", "二百五", "色狼", "抽风", "李洪志", "乌蝇水", "猪", "250", "肥猪", "打手枪", "李咏曰", "无耻", "马B", "奇葩", "神棍", "尼玛", "骗中央", "无码专", "周恩来", "臭鸡蛋", "畜生", "丽媛离", "西藏限", "刘少奇", "脱裤子", "豆腐渣", "节操掉了", "利他林", "希脏", "朱德", "放屁", "吹潮", "蹭炮", "六合彩", "习进平", "宋庆龄", "拽", "龟头", "法克鱿", "乱奸", "习晋平", "习近平", "shit", "射入", "达菲鸡", "乱伦类", "席复活", "李克强", "SHIT", "A片", "马勒戈壁", "乱伦小", "席临终前", "人渣", "欠抽", "中南海", "互撸娃", "乱伦", "席指着护", "渣男", "找抽", "处女", "吃翔", "伦理大", "洗澡死", "渣", "欠扁", "吃精", "爆出翔", "伦理毛", "喜贪赃", "切克闹", "挂了", "你全家", "打蝴蝶", "伦理片", "陷害案", "来死狗", "猥琐", "黄片", "贱骨头", "裸聊网", "陷害罪", "药药药", "龌龊", "斯大林", "屁轻", "裸舞视", "小穴", "盖塔奥", "愚昧", "阿扁", "老三老四", "成人圖片", "落霞綴", "死一邊去", "蓋塔奧", "母豬", "強淫", "挨了一炮", "麻古", "滾蛋", "黑餵狗", "豬公", "中共主席", "攪基", "賣淫", "麻果配", "騷人", "鬧太套", "大腦短路", "藏獨", "黃段子", "藏獨", "麻果丸", "騷", "本宮", "爛泥", "疆獨", "笨拉燈", "操了嫂", "麻將透", "新建戶", "攻受", "廢渣", "馬英九", "戰五渣", "操嫂子", "麻醉狗", "新疆叛", "小妾", "作嘔", "水扁", "矮仔", "插屁屁", "麻醉槍", "新疆限", "可攻可受", "進天堂", "衰人", "傻仔", "察象螞", "麻醉槍", "新金瓶", "不是人", "裹胸", "處男", "姦夫", "成人電", "麻醉藥", "新唐人", "何棄療", "裹腳布", "馬克思", "黑鬼", "成人卡通", "毛一鮮", "姓忽悠", "土憋", "耗子", "列寧", "洗了滾", "成人聊", "美艷少婦", "性愛日", "綠茶婊", "你丫", "中華人民", "娼妓", "成人片", "妹按摩", "性福情", "婊", "綁大款", "共和國", "豬仔", "成人視", "妹上門", "性感少", "婊了", "養小蜜", "社會", "啥表", "成人圖", "蒙汗藥", "性推廣歌", "吊炸天", "吃裡扒外", "民主黨", "銼斃", "成人文", "迷幻型", "胸主席", "菊花", "濺B", "64", "糞便", "成人小", "迷幻藥", "徐玉元", "爆菊", "跑堂狗", "民主", "膣屄", "充氣娃", "迷幻藥", "爆菊花", "特媽", "破鞋", "尿泡", "催眠水", "迷昏口", "丫的", "無節操", "嬤痺", "扯巴子", "吹簫", "催情粉", "迷昏藥", "性器", "菜鳥", "娘個B德", "溜洽子", "干你娘", "催情藥", "迷昏藥", "煙感器", "波霸", "B叫", "瓜哇子", "屌你老母", "催情藥", "迷魂香", "嚴曉玲", "泡M", "滾", "龜兒子", "肏你媽", "挫侖", "迷魂藥", "顏射", "泡妞", "滾回去", "臭婊子", "打飛機", "雞巴", "迷魂藥", "勞教", "毛片", "滾床單", "二流子", "泥馬", "雞巴", "迷姦藥", "勞改犯", "好個毛", "滾床單", "雞雞", "騷貨", "奶子", "迷情水", "顏射", "你妹", "犢子", "糞脹", "雛妓", "肉棒", "迷情藥", "姚明進去", "毛線", "滾犢子", "雜種", "狗吸", "代孕", "迷藥", "要射精了", "傻帽", "草死你媽", "十三點", "爛臭鞋", "法車侖", "謎奸藥", "要射了", "傻X", "廢了你", "該豬吃", "惡狗", "法正乾", "蜜穴", "要洩了", "熊樣", "殘廢", "狗造化", "惡棍", "法輪", "內射", "夜激情", "唾棄", "大比岔", "你算老幾", "無賴", "法輪佛", "嫩穴", "液體炸", "腐植質", "賣騷", "秀逗", "蠢人", "法維權", "嫩陰", "一小撮別", "裝B", "賣弄", "沒腦子", "賤貨", "法一輪", "操你媽", "遺情書", "裝b", "扮純", "腦子進水", "沒屁眼", "法院給廢", "擬濤哥", "蟻力神", "夫妻交換", "妞上門", "陰唇", "二逼", "fuck", "解放軍", "蠢豬", "感撲克", "濃精", "陰道", "死逼", "damn", "妓女", "婊子養的", "岡本真", "女被人家搞", "陰戶", "笨蛋", "丑角", "政府", "瘋狗", "肛交", "女激情", "淫魔舞", "白癡", "ET", "國軍", "縮頭烏龜", "肛門是鄰", "女優", "淫情女", "二癡", "變態", "團體", "賣比", "岡本真", "炮的小蜜", "淫肉", "蛋白質", "鳳姐", "遊行", "傻吊", "鋼針狗", "噴尿", "淫騷妹", "王八", "屁股", "小日本", "人模狗樣", "鋼珠槍", "嫖俄羅", "淫獸", "三八", "MMD", "黨", "坯子", "港澳博球", "嫖雞", "淫獸學", "東方標誌", "NND", "大麻", "歪逼", "港馬會", "僕不怕飲", "淫水", "東方婊子", "禽獸", "起義", "操逼", "港鑫華", "普通嘌", "淫穴", "比樣迪", "獸", "抵制", "裝蔥", "高鶯鶯", "叫床", "詠妓", "逼樣的", "下賤", "拉薩", "癩蛤蟆", "搞媛交", "色黃", "幽谷三", "DBF", "欠踹", "開打", "狼心狗肺", "共狗", "色黃圖", "游精佑", "大潑婦", "欠拍", "李登輝", "挨刀的貨", "共王儲", "奇淫散", "有奶不一", "兔崽子", "欠擰", "陳水扁", "死不要臉", "狗糧", "賤淫", "右轉是政", "不想活啦", "死皮賴臉", "臥槽", "屎坨坨", "滾圓大乳", "淫蕩", "幼齒類", "他奶奶的", "劍人", "我擦", "賣騷", "國家妓", "賤B", "愚民同", "去死吧你", "醉銀劍", "屌爆了", "賣逼", "和狗交", "柔胸粉", "愚民政", "祖宗", "人劍合一", "我勒個去", "陽痿", "和狗性", "肉洞", "與狗性", "祖宗十八代", "化糞池", "二貨", "寄生蟲", "和狗做", "肉棍", "玉蒲團", "蠢材", "流氓", "腦弱", "傻子", "紅色恐", "如廁死", "鴛鴦洗", "蠢貨", "山寨", "次奧", "窩囊", "胡江內鬥", "乳交", "砍殺", "嘔像", "噁心", "蛋碎", "窩囊廢", "胡緊套", "軟弱的國", "殺人犯", "小妞", "該死", "粉木耳", "歪瓜劣棗", "胡錦濤", "賽後騷", "兇殺", "老娘", "BT", "黑木耳", "胡扯", "胡適眼", "三挫", "血案", "青蛙頭", "呆瓜", "搞基", "狗屁", "胡耀邦", "三級片", "韻徐娘", "陰陽失調", "呆子", "擼管", "仆街", "湖淫娘", "三秒倒", "炸死", "河馬", "dork", "謝特", "南朝鮮人", "虎頭獵", "三網友", "植物冰", "火山噴發", "下流", "裝逼", "後庭", "華國鋒", "三唑", "殖器護", "垃圾人", "潑婦", "矮窮挫", "總理", "華門開", "騷婦", "慘案", "垃圾", "淫猥", "活春宮", "我日", "吹蕭", "騷浪", "兇案", "恐龍", "公驢", "銀槍小霸王", "屁眼", "還看錦濤", "騷穴", "貪官", "青蛙", "傻瓜", "拔吊無情", "老二", "換妻", "騷嘴", "狗官", "廢材", "蠢驢", "拔屌無情", "鞭鞭", "渾圓豪乳", "掃了爺爺", "晝將近", "孫了", "神經病", "屁話", "漢奸", "激情電", "色電影", "主席懺", "裝孫", "青樓", "滾粗", "強暴", "激情短", "色妹妹", "著濤哥", "裝孫子", "便便", "廢柴", "釘子戶", "激情炮", "色小說", "自由聖", "瞎搞", "馬屁精", "打炮", "揩油", "激情妹", "色視頻", "自慰用", "扯蛋", "大便", "聊騷", "惡爆", "急需嫖", "屍博", "自由亞", "一陀糞", "癡呆", "潮吹", "惡霸", "腐敗", "失身水", "有毛病", "一陀屎", "牛逼烘烘", "煞筆", "耐操", "打砸搶", "失意藥", "我靠", "草包", "無節操", "波推", "頂你個肺", "奸成癮", "獅子旗", "靠", "自殺", "強姦", "陰經", "共和國", "江胡內鬥", "十八等", "迷藥", "媽蛋", "色誘", "八婆", "小鬼子", "江太上", "十大謊", "作死", "無性生殖", "手淫", "雞婆", "李克強", "江系人", "十大禁", "做愛", "生殖", "你大姨媽的", "拉皮條", "李長春", "疆獨", "熟婦", "做愛小", "智障", "坑爹", "嘿咻", "張德江", "自慰", "賤民", "套套", "醜陋", "坑媽", "約炮", "俞正聲", "叫自慰", "太王四神", "洩", "自爆", "坑爺", "娘炮", "劉雲山", "姐包夜", "六四", "媽蛋", "滅了", "坑奶奶", "屁民", "王歧山", "姐服務", "東突", "死邊去", "基因突變", "你有病", "援交", "張高麗", "姐兼職", "探測狗", "屌絲", "你tmd", "渣滓", "土肥圓", "李援朝", "姐上門", "濤共產", "鳥", "吹牛b", "碎渣", "基佬", "李源朝", "豬頭", "濤一樣胡", "鳥人", "群毆", "雜碎", "孬種", "博熙來", "狗蛋", "特碼", "屌人", "撒子", "沒用的傢伙", "備胎", "傻蛋", "天朝特", "草泥馬", "自戀", "混蛋", "民奸", "蛋疼", "偷偷貪", "法克由", "吹牛", "廢物", "傻冒", "操蛋", "推油按", "法克", "狗眼", "畜牲", "歇菜", "MLGB", "脫衣艷", "吊兒郎當的", "狗嘴", "八嘎", "歇火", "去年買了個表", "瓦斯手", "他媽的", "矯情", "笨腦子", "菊花緊", "mlgb", "襪按摩", "他媽", "屁顛", "阿呆", "牛X", "qnmgb", "溫家堡", "XXOO", "騙錢", "瘋子", "我頂你個肺", "精子射", "溫切斯特", "丫滴", "你大爺", "卑賤", "牛叉", "就愛插", "溫影帝", "慫樣", "腦殘片", "卑鄙", "麻痺", "就要色", "溫家寶", "丑角", "腦殘", "小偷", "奶奶個熊", "巨乳", "瘟加飽", "死翹翹", "被驢踢", "麻子臉", "鹹豬手", "拉登說", "瘟假飽", "屎樣", "被驢踢", "老傢伙", "天朝", "浪穴", "紋了毛", "狗屎", "你媽媽的", "該死的", "鬼畜", "黎陽平", "台獨", "鄧小平", "二百五", "色狼", "抽風", "李洪志", "烏蠅水", "豬", "250", "肥豬", "打手槍", "李詠曰", "無恥", "馬B", "奇葩", "神棍", "尼瑪", "騙中央", "無碼專", "周恩來", "臭雞蛋", "畜生", "銀槍小霸王", "麗媛離", "西藏限", "劉少奇", "脫褲子", "豆腐渣", "節操掉了", "利他林", "希髒", "朱德", "放屁", "吹潮", "蹭炮", "六合彩", "習進平", "宋慶齡", "拽", "龜頭", "法克魷", "亂奸", "習晉平", "習近平", "shit", "射入", "達菲雞", "亂倫類", "席復活", "李克強", "SHIT", "A片", "馬勒戈壁", "亂倫小", "席臨終前", "人渣", "欠抽", "中南海", "互擼娃", "亂倫", "席指著護", "渣男", "找抽", "處女", "吃翔", "倫理大", "洗澡死", "渣", "欠扁", "吃精", "爆出翔", "倫理毛", "喜貪贓", "切克鬧", "掛了", "你全家", "打蝴蝶", "倫理片", "陷害案", "來死狗", "猥瑣", "黃片", "賤骨頭", "裸聊網", "陷害罪", "藥藥藥", "齷齪", "斯大林", "屁輕", "裸舞視", "小穴", "蓋塔奧", "愚昧", "阿扁", "老三老四", "共産黨", "共产党"],
                    a = 0, n = e.replace(/(^\s*)|(\s*$)|(\s)/g, "");
                for (i = 0; i < t.length; i++) -1 != n.indexOf(t[i]) && a++;
                return 0 != a
            }
            function showToast(msg) {
                var zhiwu_toast_wrap = zhiwu("zhiwu_toast_wrap");
                var toast = zhiwu("toast");
                zhiwu_toast_wrap.style.display = "flex";
                toast.classList.add('zhiwu-toast');
                toast.innerText =  msg;
                setTimeout(function () {
                    zhiwu_toast_wrap.style.display = "none";
                }, 2000);
            }
            function expres(score) {
                scores = parseInt(score);
                if (scores == 1) {
                    emoji.src="http://divine.cdn.h55u.com/platform/image/expres_01.png?v=1.2";
                    emoji_desc.innerText="失望";
                } else if (scores == 2) {
                    emoji.src="http://divine.cdn.h55u.com/platform/image/expres_02.png?v=1.2";
                    emoji_desc.innerText="不满";
                } else if (scores == 3) {
                    emoji.src="http://divine.cdn.h55u.com/platform/image/expres_03.png?v=1.2";
                    emoji_desc.innerText="一般";
                } else if (scores == 4) {
                    emoji.src="http://divine.cdn.h55u.com/platform/image/expres_04.png?v=1.2";
                    emoji_desc.innerText="满意";
                } else if (scores == 5) {
                    emoji.src="http://divine.cdn.h55u.com/platform/image/expres_05.png?v=1.2";
                    emoji_desc.innerText="非常满意";
                }
            }
            function zhiwu(selector) {
                return document.getElementById(selector);
            }
        }
    },
    recordUv: function(){
        if(sessionStorage.zwDivineInit == undefined){
            sessionStorage.zwDivineInit="1";
            if(this.zwUid){
                var data = {
                    uid : this.zwUid,
                    gid : this.zwGameId,
                    src : this.zwSource
                };
                var incimage = new Image();
                incimage.src = this.uvUrl + "?" + this._buildQuery(data)
            }
        }
    },
    recordUserInfo: function(data){
        data.gameId = this.zwGameId;
        data.src = this.zwSource;
        data.zwUid = this.zwUid;
        this._ajaxGet(this.userInfoUrl + "?" + this._buildQuery(data));
    },
    payIndex: function(data){
        var payType = localStorage.getItem("payType" + data.zwGameId) || 1;
        var source = localStorage.getItem("zwSource") || 1;

        if(payType <= 2){
            data.src = source;
            window.location.href = zwDivine.payUrl + "?" + zwDivine._buildQuery(data);
            return true;
        }
        if(payType == 3){
            var ua = navigator.userAgent.toLowerCase();
            if(ua.match(/MicroMessenger/i) != "micromessenger"){
                data.src = source;
                data.pay_channel = 0;
                window.location.href = zwDivine.payUrl + "?" + zwDivine._buildQuery(data);
                return true;
            }

            var payHtml = '<div id="zhiwu-divine-pay-filter"style="position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: black;opacity: 0.7;z-index: 10000;"></div><div id="zhiwu-divine-pay-wrapper"style="width: 7em;height: auto;margin:0 auto;border-radius: 6px;position: fixed;left: 0;right: 0;top: 50px;background-color: #ffffff;z-index: 10001;"><img id="zhiwu-divine-pay-close"style="display: inline-block; position: absolute; top: 0; right: 0; margin:0.16em 0.18em; width: 0.3em;"src="http://uploads-admin.cdn.woquhudong.cn/admin/article/1548235936SJrDj.png"alt=""><div id="zhiwu-divine-pay-row-1"style="font-size: 0.36em; text-align: center"><p style="margin: 0.4em 0;padding: 0;color: #000000; font-size: 18px;">咨询项目</p><p id="zhiwu-divine-pay-goods-name"style="margin: 0.4em 0;padding: 0;color: #838383; font-size: 18px;">塔罗-未来运势解密</p></div><div id="zhiwu-divine-pay-row-2"style="margin: 0 0.4em; overflow: hidden;"><p style="font-size: 16px; line-height: 2.9em; display: inline-block; float: left;">咨询金额</p><p style="font-size: 34px; float:right; display: inline-block;">￥<span id="zhiwu-divine-pay-money">28.8</span></p><hr style="border-bottom: none;border-left: none;border-right: none;border-top: 1px solid #eeeeee;width: 100%;margin: 0 auto;"></div><div id="zhiwu-divine-pay-row-3"style="margin: 0 0.4em; overflow: hidden; margin-top: 0.32em"><p style="font-size: 16px; display: inline-block; float: left;">原价</p><s style="font-size: 14px; display: inline-block; float: right">￥88.8</s></div><div id="zhiwu-divine-pay-row-4"style="margin: 0 0.4em; overflow: hidden; margin-top: 0.32em; margin-bottom: 0.3em"><p style="font-size: 14px; display: inline-block; float: left; color: #999999;">距优惠结束</p><p style="font-size: 14px; display: inline-block; float: right; color:#ff3900;">00:<span id="zhiwu-divine-pay-remain">00:00</span></p></div><div id="zhiwu-divine-pay-row-5"style="margin: 0 0.4em; overflow: hidden; margin-top: 0.3em; margin-bottom: 0.32em;"><hr style="border-bottom: none;border-left: none;border-right: none;border-top: 1px solid #eeeeee;width: 100%;margin: 0 auto;"><p style="font-size: 14px; display: inline-block; float: left; color: #999999; margin-top: 1em;">选择支付方式</p></div><div id="zhiwu-divine-pay-row-6"style="margin: 0 0.4em; overflow: hidden;"><img style="display: inline-block; width: 0.73em; float: left;"src="http://uploads-admin.cdn.woquhudong.cn/admin/article/1548234781vpGbo.png"alt=""><p style="display: inline-block; font-size: 16px; float: left; line-height: 2.3em; margin-left: 1em;">微信支付</p><img id="zhiwu-divine-pay-wx-select"style="display: inline-block; float: right; width: 0.42em; margin-top: 0.16em;"src="http://uploads-admin.cdn.woquhudong.cn/admin/article/15482379193APq9.png"alt=""></div><div style="margin: 0.2em 0.4em"><hr style="border-bottom: none;border-left: none;border-right: none;border-top: 1px solid #eeeeee;width: 100%;margin: 0 auto;"></div><div id="zhiwu-divine-pay-row-7"style="margin: 0 0.4em; overflow: hidden;"><img style="display: inline-block; width: 0.73em; float: left;"src="http://uploads-admin.cdn.woquhudong.cn/admin/article/1548234897kYOW0.png"alt=""><p style="display: inline-block; font-size: 16px; float: left; line-height: 2.3em; margin-left: 1em;">支付宝支付</p><img id="zhiwu-divine-pay-zfb-select"style="display: inline-block; float: right; width: 0.42em; margin-top: 0.16em;"src="http://uploads-admin.cdn.woquhudong.cn/admin/article/1548234865Ducgz.png"alt=""></div><div style="margin: 0.36em 0.4em 0.4em 0.4em;"><img id="zhiwu-divine-pay-btn"style="display: inline-block; width: 100%;"src="http://divine.cdn.h55u.com/AppDivine/divine/img/newpay/start_btn.png?v=1.0" alt=""></div></div>';
            if(!document.getElementById('zhiwu-divine-pay-filter')){
                document.getElementsByTagName('body')[0].insertAdjacentHTML("afterbegin", payHtml);
                var wWidth = (screen.width > 0) ? (window.innerWidth >= screen.width || window.innerWidth == 0) ? screen.width :
                    window.innerWidth : window.innerWidth;
                var wFsize = wWidth > 512 ? 70 : wWidth / 7.5;
                document.getElementById('zhiwu-divine-pay-wrapper').style.fontSize = wFsize + 'px';
                document.getElementById('zhiwu-divine-pay-goods-name').innerHTML = data.goodsName;
                document.getElementById('zhiwu-divine-pay-money').innerHTML = data.money / 100;

                document.getElementById('zhiwu-divine-pay-close').onclick = function(){
                    document.getElementById('zhiwu-divine-pay-filter').style.display = "none";
                    document.getElementById('zhiwu-divine-pay-wrapper').style.display = "none";
                    zwDivine.payRemain = 1200;
                    document.getElementById('zhiwu-divine-pay-remain').innerHTML = "20:00";
                };
                document.getElementById('zhiwu-divine-pay-wx-select').onclick = function(){
                    if((typeof zwDivine.payChannel == "number") && (zwDivine.payChannel == 2)){
                        document.getElementById('zhiwu-divine-pay-wx-select').src = "http://uploads-admin.cdn.woquhudong.cn/admin/article/15482379193APq9.png";
                        document.getElementById('zhiwu-divine-pay-zfb-select').src = "http://uploads-admin.cdn.woquhudong.cn/admin/article/1548234865Ducgz.png";
                        zwDivine.payChannel = 1;
                    }
                };
                document.getElementById('zhiwu-divine-pay-zfb-select').onclick = function(){
                    if((typeof zwDivine.payChannel == "number") && (zwDivine.payChannel == 1)){
                        document.getElementById('zhiwu-divine-pay-wx-select').src = "http://uploads-admin.cdn.woquhudong.cn/admin/article/1548234865Ducgz.png";
                        document.getElementById('zhiwu-divine-pay-zfb-select').src = "http://uploads-admin.cdn.woquhudong.cn/admin/article/15482379193APq9.png";
                        zwDivine.payChannel = 2;
                    }
                };
                document.getElementById('zhiwu-divine-pay-btn').onclick = function(){
                    var source = localStorage.getItem("zwSource");
                    if(source){
                        data.src = source;
                    }
                    data.pay_channel = zwDivine.payChannel;
                    window.location.href = zwDivine.payUrl + "?" + zwDivine._buildQuery(data);
                };

                function initTimer1(seconds){
                    var h = Math.floor(seconds / 3600);
                    var m = Math.floor( (seconds % 3600) / 60 );
                    var s = Math.ceil( (seconds % 3600) % 60 );
                    h = h < 10 ? ('0' + h) : h;
                    m = m < 10 ? ('0' + m) : m;
                    s = s < 10 ? ('0' + s) : s;
                    if (seconds<0) {
                        document.getElementById('zhiwu-divine-pay-remain').innerHTML = "00:00";
                    }else{
                        document.getElementById('zhiwu-divine-pay-remain').innerHTML = m+':'+s;
                    }
                }
                initTimer1(zwDivine.payRemain--);
                setInterval(function(){
                    initTimer1(zwDivine.payRemain--);
                }, 1000);
            }else{
                document.getElementById('zhiwu-divine-pay-filter').style.display = "block";
                document.getElementById('zhiwu-divine-pay-wrapper').style.display = "block";
            }
        }
    },
    indexComplaint : function(){
        var complaintHtml = '<div id="zhiwu-divine-complaint-btn"style="position: fixed;right: 0;bottom: 20%;z-index: 10000;"><img style="width: 31px;"src="http://uploads-admin.cdn.woquhudong.cn/admin/article/1548732162NznN4.png"alt=""></div>';
        var gid = this.zwGameId;
        if(gid && !document.getElementById('zhiwu-divine-complaint-btn')){
            document.getElementsByTagName('body')[0].insertAdjacentHTML("afterbegin", complaintHtml);
            document.getElementById('zhiwu-divine-complaint-btn').onclick = function(){
                window.location.href = zwDivine.complaintUrl + "?gid=" + gid;
            };
        }
    },
    divineList: function(){
        var backFlag = this._getRequest("back_flag");
        if(parseInt(backFlag)){
            window.history.back(-1);
        }else{
            window.location.href = "http://j.5flyyou.com/divine.php/Url/Platform/divineList";
        }
    },
    result: function(){
        var resultHtml = '<div style="position: fixed;left:0; bottom: 0; width: 100%; height: 60px; background: black;opacity: 0.7;z-index: 10000;"></div><div style="position: fixed;left:0; bottom: 0; width: 100%; height: 60px; z-index: 10001; font-size: 18px; overflow: hidden;"><div id="zhiwu-divine-save-result-btn"style="margin-left: 2%;width: 47%;height: 60px; float: left; text-align: center;"><img style="display: inline-block;width: 100%;position: relative;top: 50%;-webkit-transform: translateY(-50%);transform: translateY(-50%);"src="http://uploads-admin.cdn.woquhudong.cn/admin/article/1550560170DvmgR.png"alt=""></div><div id="zhiwu-divine-play-again-btn"style="margin-left: 2%;width: 47%; float: left; text-align: center;height: 60px;"><img style="display: inline-block;width: 100%;position: relative;top: 50%;-webkit-transform: translateY(-50%);transform: translateY(-50%);"src="http://uploads-admin.cdn.woquhudong.cn/admin/article/1548727536J0Tn8.png"alt=""></div></div><div id="zhiwu-divine-save-result-filter"style="display:none; position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: black;opacity: 0.7;z-index: 10000;pointer-events: none;"></div><div id="zhiwu-divine-save-result-wrapper"style="display:none; position: fixed; top: 30%; width:87%; height: 272px; z-index: 10001; left: 0; right: 0; margin: 0 auto; font-size: 18px; color: #d6463d; background-color: #ffffff; text-align: center; border-radius: 4px; font-weight: 500;"><p style="margin: 26px 0 12px 0; color:rgb(214, 70, 61)!important;">长按识别&nbsp;关注公众号</p><p style="margin-bottom: 17px; color:rgb(214, 70, 61)!important;">即可永久保存你的结果</p><img id="zhiwu-divine-save-result-qrcode"style="width: 130px; border: 2px solid #e67c75; margin: 0 auto;"src="http://uploads-user.cdn.woquhudong.cn/quce/qrcode/platform_315_divine_1003_1002.jpg"alt=""><img style="position: absolute; width: 45px; top: 225px; left: 70%;"src="http://uploads-admin.cdn.woquhudong.cn/admin/article/1548730542ix2dH.png"alt=""><img id="zhiwu-divine-save-result-close-btn"style="position: absolute;top: -50px;right: -5px;width: 30px;margin: 5px;"src="http://uploads-admin.cdn.woquhudong.cn/admin/article/1548731120yACNw.png"alt=""><img style="position:absolute;width:100%;height:100%;display:block;left:0;top:0;opacity:0;"src="http://uploads-user.cdn.woquhudong.cn/quce/qrcode/platform_315_divine_1003_1002.jpg"></div><div id="zhiwu-divine-complaint-btn"style="position: fixed;right: 0;bottom: 20%;z-index: 10000;"><img style="width: 31px;"src="http://uploads-admin.cdn.woquhudong.cn/admin/article/1548732162NznN4.png"alt=""></div>';
        if(!document.getElementById('zhiwu-divine-save-result-btn')){
            var orderId = this.zwOrderId;
            var gid = this.zwGameId;
            var source = this.zwSource;
            gid = parseInt(gid);
            source = parseInt(source);
            var style1Gid = new Set([1049, 1050, 1047, 1006]);      //易知测试
            var style2Gid = new Set([1012, 1013, 1014, 1015, 1016, 1017, 1018, 1019, 1028]);        //易知正式
            if(orderId.length == 0){
                return false;
            }
            if(gid == 1001){
                document.getElementsByTagName('body')[0].style.padding = "0 0 2.1rem 0";
                document.getElementsByClassName('chance_btn')[0].style.bottom = "60px";
            }
            if(style1Gid.has(gid)){
                document.getElementsByTagName('body')[0].style.padding = "0 0 60px 0";
            }
            if(style2Gid.has(gid)){
                document.getElementsByTagName('body')[0].style.padding = "0 0 60px 0";
            }

            document.getElementsByTagName('body')[0].insertAdjacentHTML("afterbegin", resultHtml);
            document.getElementById('zhiwu-divine-save-result-btn').onclick = function(){
                zwDivine._ajaxPost(zwDivine.qrcodeUrl, {orderId: orderId}, function(re){
                    var reJ = JSON.parse(re);
                    if(reJ.code == 1){
                        document.getElementById('zhiwu-divine-save-result-qrcode').src = reJ.data.url;
                        document.getElementById('zhiwu-divine-save-result-filter').style.display = "block";
                        document.getElementById('zhiwu-divine-save-result-wrapper').style.display = "block";
                    }else{
                        alert(reJ.message);
                    }
                });
            };
            document.getElementById('zhiwu-divine-play-again-btn').onclick = function(){
                var url = zwDivine.playAgainUrl + "?gid=" + gid + "&src=" + source + "&play_again=1";
                window.location.href = url;
            }
            document.getElementById('zhiwu-divine-save-result-close-btn').onclick = function(){
                document.getElementById('zhiwu-divine-save-result-filter').style.display = "none";
                document.getElementById('zhiwu-divine-save-result-wrapper').style.display = "none";
            };
            document.getElementById('zhiwu-divine-complaint-btn').onclick = function(){
                window.location.href = zwDivine.complaintUrl + "?orderId=" + orderId;
            };
        }
    },
    playAgain : function(){
        var gid = this.zwGameId;
        var source = this.zwSource || 101;
        if(gid){
            window.location.href = zwDivine.playAgainUrl + "?gid=" + gid + "&src=" + source + "&play_again=1";
        }
    },
    _getRequest: function(name){
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        var reg_rewrite = new RegExp("(^|/)" + name + "/([^/]*)(/|$)", "i");
        var r = window.location.search.substr(1).match(reg);
        var q = window.location.pathname.substr(1).match(reg_rewrite);
        if(r != null){
            return unescape(r[2]);
        }else if(q != null){
            return unescape(q[2]);
        }else{
            return null;
        }
    },
    _ajaxPost: function(url, data, callback, error){
        var postData = data;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        if(typeof(postData) === 'object'){
            postData = this._buildQuery(postData)
        }
        xhr.onreadystatechange = function(){
            var XMLHttpReq = xhr;
            if (XMLHttpReq.readyState == 4) {
                if (XMLHttpReq.status == 200) {
                    var text = XMLHttpReq.responseText;
                    callback&&callback( text);
                }else{
                    xhr.abort();
                    error&&error(XMLHttpReq.status);
                }
            }
        };
        xhr.send(postData);
    },

    _ajaxGet:function(url,callback){
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open("GET",url,false);
        xmlHttp.onreadystatechange= function(){
            if (xmlHttp.readyState==4 && xmlHttp.status==200){
                callback&&callback(xmlHttp.responseText);
            }
        }
        xmlHttp.send();
    },

    _buildQuery: function(data){
        if(typeof data == "object"){
            var str = "";
            for(var prop in data){
                str += prop + "=" + data[prop] + "&"
            }
            return str.substr(0, str.length - 1);
        }else{
            return false;
        }
    }
}

zwDivine.init();

/*2018-12-01*/