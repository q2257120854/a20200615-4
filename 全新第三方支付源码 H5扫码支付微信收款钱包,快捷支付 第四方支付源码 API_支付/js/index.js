/**
 * Created by Nature on 16/1/22.
 */
function hide(id) {
    var obj = typeof id == "string" ? document.getElementById(id) : id;
    obj.style.display = "none";
}
function show(id) {
    var obj = typeof id == "string" ? document.getElementById(id) : id;
    obj.style.display = "block";
}
function newsTab(dir) {
    var newsBox = document.getElementById("news-box");
    var lis = newsBox.getElementsByTagName("li");
    var _index;
    for (var i = 0, ln = lis.length; i < ln; i++) {
        lis[i].index = i;
        if (YEEPAY.hasClass(lis[i], "block")) {
            _index = i;
        }
    }
    if (dir == "pre") {
        if (_index == 0) {
            YEEPAY.removeClass(lis[_index], "block");
            YEEPAY.addClass(lis[lis.length - 1], "block");
        } else {
            YEEPAY.removeClass(lis[_index], "block");
            YEEPAY.addClass(lis[_index - 1], "block");
        }
    }
    if (dir == "next") {
        if (_index == lis.length - 1) {
            YEEPAY.removeClass(lis[_index], "block");
            YEEPAY.addClass(lis[0], "block");
        } else {
            YEEPAY.removeClass(lis[_index], "block");
            YEEPAY.addClass(lis[_index + 1], "block");
        }
    }
}
function pullShow() {
    var nav = document.getElementById("nav");
    var pullDown = YEEPAY.getElementByClass("pull-down", nav);
    var menuNav = YEEPAY.getElementByClass("menu-nav", nav);
    var navChild = YEEPAY.getElementByClass("nav-child" , nav);
    var width = document.documentElement.clientWidth || document.body.clientWidth;
    for (var i = 0, ln = pullDown.length; i < ln; i++) {
        pullDown[i].index = i;
        if(width <=1024){
            pullDown[i].onclick = function(){
				alert('1');
                if(this.classList.contains("active")){
                    for (var j = 0, ln = menuNav.length; j < ln; j++) {
                        YEEPAY.removeClass(pullDown[j] , "active");
                        menuNav[j].style.display = "none";
                    }
                }else{
                    for (var j = 0, ln = menuNav.length; j < ln; j++) {
                        menuNav[j].style.display = "none";
                        pullDown[j].classList.remove("active");
                    }
                    YEEPAY.addClass(this, "active");
                    menuNav[this.index].style.display = "block";
                }
            }
        }else{
            pullDown[i].onmouseover = function(){
                for (var j = 0, ln = menuNav.length; j < ln; j++) {
                    menuNav[j].style.display = "none";
                }
                YEEPAY.addClass(this, "active");
                menuNav[this.index].style.display = "block";
            };
            pullDown[i].onmouseout = function(){
                for (var j = 0, ln = menuNav.length; j < ln; j++) {
                    YEEPAY.removeClass(this, "active");
                    menuNav[j].style.display = "none";
                }
            };
        }
    }
    for (var h = 0, ln = navChild.length; h < ln; h++) {
        if(width > 1024){
            navChild[h].onmouseover = function(){
                YEEPAY.addClass(this , "on");
            };
            navChild[h].onmouseout = function(){
                YEEPAY.removeClass(this , "on");
            }
        }else{}
    }
}
function login(){
    var login = document.getElementById("login");
    var width = document.documentElement.clientWidth || document.body.clientWidth;
    if(width <= 1024){
        login.onclick = function(){
            if(login.classList.contains("on")){
                this.classList.remove("on");
                hide("login-pull");
            }else{
                this.classList.add("on");
                show("login-pull");
            }
        }
    }else{
        login.onmouseover = function(){
            show("login-pull");
        };
        login.onmouseleave = function(){
            hide("login-pull");
        }
    }
}
function ewmShow() {
    var wx = document.getElementById("wx");
    var ewm = document.getElementById("ewm");
    var ico = document.getElementById("ico");
    var width = document.documentElement.clientWidth || document.body.clientWidth;
    if(width <= 1024){
        wx.onclick = function(){
            if(ico.classList.contains("active")){
                ewm.style.display = "none";
                YEEPAY.removeClass(ico, "active");
            }else{
                ewm.style.display = "block";
                YEEPAY.addClass(ico, "active");
            }
        };
    }else{
        wx.onmouseover = function () {
            ewm.style.display = "block";
            YEEPAY.addClass(ico, "active");
        };
        wx.onmouseleave = function () {
            ewm.style.display = "none";
            YEEPAY.removeClass(ico, "active");
        }
    }
}
function toggle() {
    document.querySelector(".nav-btn").classList.toggle("nav-btn-active");
    document.querySelector(".pull-nav").classList.toggle("h-auto");
    document.querySelector(".mask").classList.toggle("mask-on");
}
function nav(){
    var showBtn = document.querySelectorAll(".showBtn");
    var childNav = document.querySelectorAll(".child-nav");
    for(var i=0, ln=showBtn.length; i<ln; i++){
        showBtn[i].onclick = function(){
            var nextNode = this.nextElementSibling;
            if(this.classList.contains("active")){
                this.classList.remove("active");
                nextNode.classList.remove("h-auto");
            }else{
                for(var i=0, ln=showBtn.length; i<ln; i++){
                    showBtn[i].classList.remove("active");
                    childNav[i].classList.remove("h-auto");
                }
                this.classList.add("active");
                nextNode.classList.add("h-auto");
            }
        }
    }
    for(var i=0, ln=childNav.length; i<ln; i++){
        childNav[i].onclick = function(){
            var childs = this.children;
            var _target = event.target;
            for(var j=0 , ln=childs.length; j<ln; j++){
                childs[j].classList.remove("click");
            }
            _target.classList.add("click");
        }
    }
}

function carousel() {
    /*广告位初始化开始*/
    var carousel = document.getElementById("carousel");
    var bannerInfoData = getBannerInfo().data;
    for (var i = 0, ln = bannerInfoData.length; i < ln; i++) {
        var li = document.createElement("li");
        if(i == 0){
            //li.setAttribute("class", "front");
            YEEPAY.addClass(li,"front");
        }
        var a = document.createElement("a");
        a.setAttribute("target", "_blank");
        a.setAttribute("href", bannerInfoData[i].href);
        var img = document.createElement("img");
        img.setAttribute("src", bannerInfoData[i].imgSrc);
        if(bannerInfoData[i].href==null||trim(bannerInfoData[i].href)===""){
            li.appendChild(img);
        }else{
            a.appendChild(img);
            li.appendChild(a);
        }
        carousel.appendChild(li);
    }
    /*广告位初始化结束*/
    var script = document.createElement("script");
    script.type = "text/javascript";
    var width = document.documentElement.clientWidth || document.body.clientWidth;
    if (width <= 700) {
        /*公告栏初始化开始*/
        var noticeLink = document.getElementById("mobile_noticeLink");
        var noticeInfoData = getNoticeInfo().data;
        var noticeIndex = 0;
        noticeLink.setAttribute("target", "_blank");
        noticeLink.setAttribute("href", noticeInfoData[noticeIndex].url);
        noticeLink.innerHTML=noticeInfoData[noticeIndex++].title;
        window.setInterval(function (){
            noticeLink.setAttribute("target", "_blank");
            noticeLink.setAttribute("href", noticeInfoData[noticeIndex].url);
            noticeLink.innerHTML=noticeInfoData[noticeIndex].title;
            if(++noticeIndex >= noticeInfoData.length){
                noticeIndex = 0 ;
            }
        },5000);
        /*公告栏初始化结束*/
        script.src = "/js/carousel.js";
        nav();
    } else {
        /*公告栏初始化开始*/
        var noticeList = document.getElementById("news-list");
        var noticeInfoData = getNoticeInfo().data;
        for (var i = 0, ln = noticeInfoData.length; i < ln; i++) {
            var li = document.createElement("li");
            if(i == 0){
                YEEPAY.addClass(li,"block");
            }
            var a = document.createElement("a");
            a.setAttribute("target", "_blank");
            a.setAttribute("href", noticeInfoData[i].url);
            a.innerHTML=noticeInfoData[i].title;
            li.appendChild(a);
            noticeList.appendChild(li);
        }
        /*公告栏初始化结束*/
        /*易宝动态初始化开始*/
        var newsBox = document.getElementById("news-box");
        var newsInfoData = getNewsInfo().data;
        for (var i = 0, ln = newsInfoData.length; i < ln; i++) {
            var li = document.createElement("li");
            if(i == 0){
                //li.setAttribute("class", "block");
                YEEPAY.addClass(li,"block");
            }
            var a = document.createElement("a");
            a.setAttribute("target", "_blank");
            a.setAttribute("href", newsInfoData[i].url);
            a.innerHTML = "虎付动态 :" + newsInfoData[i].title;
            var span = document.createElement("span");
            span.innerHTML = newsInfoData[i].retime;
            li.appendChild(a);
            li.appendChild(span);
            newsBox.appendChild(li);
        }
        /*易宝动态初始化结束*/
        //加入轮播
        window.setInterval(function (){
            newsTab('next');
        },5000);
        script.src = "/js/wrapper.js";
    }
    document.body.appendChild(script);
}
//carousel();
pullShow();
ewmShow();
login();
(function() {
    var newsBox = document.getElementById("news-list");
    var lis = newsBox.getElementsByTagName("li");
    var preBtn = document.getElementById("pre");
    var nextBtn = document.getElementById("next");
    var _index;
    var tt = null;

    function pre(){
        for (var i = 0, ln = lis.length; i < ln; i++) {
            if (YEEPAY.hasClass(lis[i], "block")) {
                _index = i;
            }
        }
        if (_index == 0) {
            YEEPAY.removeClass(lis[_index], "block");
            YEEPAY.addClass(lis[lis.length - 1], "block");
        } else {
            YEEPAY.removeClass(lis[_index], "block");
            YEEPAY.addClass(lis[_index - 1], "block");
        }
    }
    function next(){
        for (var i = 0, ln = lis.length; i < ln; i++) {
            if (YEEPAY.hasClass(lis[i], "block")) {
                _index = i;
            }
        }
        if (_index == lis.length - 1) {
            YEEPAY.removeClass(lis[_index], "block");
            YEEPAY.addClass(lis[0], "block");
        } else {
            YEEPAY.removeClass(lis[_index], "block");
            YEEPAY.addClass(lis[_index + 1], "block");
        }
    }
    function autoPlay(){
        tt = setTimeout(function(){
            next();
            tt = setTimeout(arguments.callee , 3000);
        } , 3000);
    }
    function stopPlay(){
        clearTimeout(tt);
    }
    autoPlay();
    YEEPAY.addHandler(preBtn , "mouseover" , stopPlay);
    YEEPAY.addHandler(preBtn , "mouseout" , autoPlay);
    YEEPAY.addHandler(preBtn , "click" , pre);
    YEEPAY.addHandler(nextBtn , "mouseover" , stopPlay);
    YEEPAY.addHandler(nextBtn , "mouseout" , autoPlay);
    YEEPAY.addHandler(nextBtn , "click" , next);
})();
(function(){
    var searchBtn = document.getElementById("search-btn");
    searchBtn.onclick = function(){
        show("search");
        $('#search-text').val(" 网银支付 一键支付 商户后台");
        $("#search-text").css("color","#AAAAAA");
        window.onclick = function(event){
            var target = YEEPAY.getTarget(event);
            if(YEEPAY.hasClass(target , "search-a")){
                var val = document.getElementById("search-text").value;
                if(val != ""){
                    $('#isHidden').val("");
                }else{
                    $('#search-text').val(" 网银支付 一键支付 商户后台");
                    $("#search-text").css("color","#AAAAAA");
                    hide("search");
                }
            }else{
                while (target.nodeName.toLowerCase() != "div" && target.nodeName.toLowerCase() != "html") {
                    target = target.parentNode;
                }
                if (target.nodeName.toLowerCase() == "html" || (target.nodeName.toLowerCase() == "div" && !YEEPAY.hasClass(target , "search-box") && !YEEPAY.hasClass(target , "search"))) {
                    hide("search");
                }
            }
        };
    };
    var searchText = document.getElementById("search-text");
    searchText.onfocus = (function(){
        $('#search-text').val("");
        $('#search-text').css("color","#000000");
    });
    //searchText.onkeydown = (function(){
    //    $('#isHidden').val("v");
    //});
    //searchText.onblur = (function(){
    //    if(document.getElementById("search-text").value.color=='rgb(170,170,170)'){
    //        $('#isHidden').val('v');
    //    }
    //        $('#search-text').val("支付");
    //        $("#search-text").css("color", "#AAAAAA");
    //
    //});
})();