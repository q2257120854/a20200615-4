/**
 * 图标加载效果
 * 触发的按钮，input元素，是否修改checked属性 =1为修改
 */
function loadingIco(self, input, change) {
    checked = checked || null;
    var span = self.find("span");
    var i = self.find("i");
    // 检查
    if (span.hasClass('hide')) {
        i.remove();
        span.removeClass("hide");
        if (change) {
            checked(input);
        }
    } else {
        span.after("<i class='fa fa-asterisk fa-2x fa-spin text-primary'></i>");
        span.addClass("hide");
    }
}
/**
 * 按钮文字加载
 * 触发的按钮，修改的文字
 */
function loadingText(self, changeText) {
    if (self.attr('disabled')) {
        self.removeAttr("disabled");
    } else {
        self.attr("disabled", true);
    }
    self.text(changeText);
}
/**
 * 修改input的checked属性
 * */
function checked(inputs) {
    if (inputs.is(':checked')) {
        inputs.prop("checked", false);
    } else {
        inputs.prop("checked", true);
    }
}
function getCookie(name) {
    var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
    if (arr = document.cookie.match(reg))
        return unescape(arr[2]);
    else
        return null;
}
//// 获取所有obj为字符串
//function allPrpos(obj) {
//    // 用来保存所有的属性名称和值
//    var props = "";
//    // 开始遍历
//    for (var p in obj) {
//        // 方法
//        if (typeof(obj[p]) == "function") {
//            //obj[p]();
//        } else {
//            // p 为属性名称，obj[p]为对应属性的值
//            props += p + "=" + obj[p] + ";  ";
//        }
//    }
//    // 最后显示所有的属性
//    return props;
//}

var TianYa = {
    postData: function (url, post, callback, dataType) {
        dataType = arguments[3] ? arguments[3] : 'json';
        $.ajax({
            type: "POST",
            url: url,
            async: true,
            dataType: dataType,
            json: "callback",
            data: post,
            success: function (data) {
                if (callback == null) {
                    return;
                }
                callback(data);
            },
            error: function (XMLHttpRequest) {
                swal("连接失败:" + XMLHttpRequest.status, '请尝试以下解决方案：1、可能数据未加载完成，请刷新本页面后重试；2、手机用户可尝试使用UC、QQ、百度等非自带浏览器');
            }
        });
    }
};