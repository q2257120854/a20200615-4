
function InitExpandList(id) {
    var expandList = $(id);
    expandList.find('.J_listTit').on('click',
        function () {
            var thisI = $(this).children('i');
            if (!thisI.hasClass('on')) {
                expandList.find('.J_listTit').children('i').removeClass('on');
                expandList.find('.J_listCon').hide();
                thisI.addClass('on');
                $("html, body").scrollTop(thisI.offset().top - 10);
                $(this).siblings('.J_listCon').show();
            } else {
                thisI.removeClass('on');
                $(this).siblings('.J_listCon').hide();
            }
        });
}

function UpdateRecordTrialTime(guid) {
    $.ajax({
        url: "/caiyun/UpdateRecordTrialTime",
        type: "Post",
        data: { guid: guid },
        dataType: "JSON",
        success: function (d) {

        },
        error: function () {

        }
    });
}

function UpdateRecordPopPayTime(guid) {
    $.ajax({
        url: "/caiyun/UpdateRecordPopPayTime",
        type: "Post",
        data: { guid: guid },
        dataType: "JSON",
        success: function (d) {

        },
        error: function () {

        }
    });
}

function FeedBack(guid, feed) {
    $.ajax({
        url: "/caiyun/TrialFeedback",
        type: "Post",
        data: { guid: guid, feed: feed },
        dataType: "JSON",
        success: function (d) {

        },
        error: function () {

        }
    });
}


function parseWxH5Pay(url, cb) {
    $.ajax({
        url: url,
        type: "GET",
        dataType: "text/html",
        async: true,
        success: function (str) {
            var tag = "url=\"";
            var pos1 = str.indexOf(tag) + tag.length;
            var pos2 = str.indexOf("\"", pos1);
            var wxurl = str.substring(pos1, pos2 - pos1);
            cb(wxurl);
        },
        error: function () {
            cb(url);
        }
    });
}

//本地存储{{
function writeStorage(key, value) {
    try {
        if (window.localStorage) {
            localStorage.setItem(key, value);
        } else {
            setCookie(key, value);
        }
    } catch (e) { }
}
function getStorage(key) {
    try {
        var strStoreData = window.localStorage ? localStorage.getItem(key) : getCookie(key);
        return strStoreData;
    } catch (e) { return ''; }
}
function getCookie(cookiename) {
    var result;
    var mycookie = document.cookie;
    var start2 = mycookie.indexOf(cookiename + "=");
    if (start2 > -1) {
        start = mycookie.indexOf("=", start2) + 1;
        var end = mycookie.indexOf(";", start);
        if (end == -1) {
            end = mycookie.length;
        }
        result = unescape(mycookie.substring(start, end));
    }
    return result;
}
function setCookie(cookiename, cookievalue) {
    document.cookie = cookiename + "=" + cookievalue;
}
//本地存储}}

//统计接口{{
function UpdateOrderPageTime(oid, page) {
    $.ajax({
        url: "/Statis/OrderPageTime",
        type: "Post",
        data: { order_id: oid, page: page },
        dataType: "JSON",
        success: function (d) {

        },
        error: function () {

        }
    });
}

function AddOrderPageBehavior(oid, page, behavior, p1,p2,p3) {
    $.ajax({
        url: "/Statis/OrderBehavior",
        type: "Post",
        data: { order_id: oid, page: page, behavior: behavior, param1: p1, param2: p2, param3:p3 },
        dataType: "JSON",
        success: function (d) {

        },
        error: function () {

        }
    });
}

function AddPageBehavior(c, a, b,r,o, p1, p2, p3) {
    $.ajax({
        url: "/Statis/AddPageBehavior",
        type: "Post",
        data: {controller:c,action:a, behavior: b, record_id:r,order_id: o,  param1: p1, param2: p2, param3: p3 },
        dataType: "JSON",
        success: function (d) {

        },
        error: function () {

        }
    });
}


function GetQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]); return null;
}

function PutUserAct(kid, act)
{
    $.ajax({
        url: "/t/c?kid=" + kid + "&act="+act,
        type: "GET",
        dataType: "JSON",
        success: function (d) {

        },
        error: function () {

        }
    });
}
//统计接口}}