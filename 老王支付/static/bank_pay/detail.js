/*确认取消*/
function sureCancelOrderClick(){
    cancelOrder(cancelOrderUrl, payDetailUrl, merchantName, tradeId, preFlag, countdownTimer);
}
var isCancelLoading = false

/* 取消订单 */
function cancelOrder(cancelOrderUrl, payDetailUrl, merchantName, tradeId, preFlag, countdownTimer) {
    if (isCancelLoading){
        return;
    }
    var cancelTypeFront = $("input[name='cancelTypeFront']:checked").val();
    if (!cancelTypeFront && cancelTypeFront != 0) {
        $("#cancel-type-error").show();
        return
    }
    $("#cancel-type-error").hide();
    var param = {
        'tradeId':tradeId,
        'cancelTypeFront':cancelTypeFront
    }
    isCancelLoading = true
    postAjax(cancelOrderUrl + "?tradeId="+tradeId+ "&cancelTypeFront=" + cancelTypeFront,param,function(succData){
        if(succData.code == 200){
            if (countdownTimer) {
                clearInterval(countdownTimer)
            }
            window.location.href = payDetailUrl + "?tradeId=" + tradeId + "&preFlag=" + preFlag
        }
        isCancelLoading = false
    },function(errData){
        common.showMessage({
            content: errData.message,
            btnText: "确定",
            onClick: function () {}
        })
        isCancelLoading = false
    },"JSON",merchantName)
}
function countdownTime(endTime, nowTime) {
    if (!endTime) {
        $("#countdown").text("00:00");
    }
    // 这里必须把所有带-的日期转为/的，因为new date中带-在手机浏览器不兼容
    endTime = new Date((endTime.replace(/-/g, "/"))).getTime();
    // 获得当前剩余时间
    nowTime = nowTime || new Date().getTime();
    var overTime = endTime - nowTime;
    var minute = utils.parseInt(overTime / 1000 / 60);
    var second = utils.parseInt((overTime % (1000 * 60)) / 1000);
    // 刷新页面放行包含定时器的话就清除，重新按照剩余时间倒计时
    if (countdownTimer) {
        clearInterval(countdownTimer)
    }
    // 初始第一次时间
    if (minute >= 0 && second >= 0) {
        $("#countdown").text((minute > 9 ? minute : "0" + minute) + ":" + (second > 9 ? second : "0" + second));
    } else {
        $("#countdown").text("00:00")
    }
    // 开始计时
    countdownTimer = setInterval(function() {
        // 秒数>0就继续计算，
        if (second > 0) {
            second--;
            $("#countdown").text((minute > 9 ? minute : "0" + minute) + ":" + (second > 9 ? second : "0" + second));
        } else {
            // 秒数<=0，分钟减1
            minute--;
            if (minute >= 0) {
                second = 59;
                $("#countdown").text((minute > 9 ? minute : "0" + minute) + ":" + (second > 9 ? second : "0" + second));
            }
            if (minute == -1) {
                // 如果分钟<0，就会超时取消，会重置分钟和秒数
                minute = 0;
                second = 0;
                $("#countdown").text("00:00");
                clearInterval(countdownTimer);
                userOverCancelBuy()
                console.log('超时取消了');
            }
        }
    }, 1000)
}
/**
 * 超时取消
 */
function userOverCancelBuy() {
    var params = {
        tradeId: tradeId,
        merchantName: merchantName
    }
    postAjax(userOverCancelBuyUrl + "?tradeId="+tradeId+"&merchantName="+merchantName, params , function (succData) {
        //  啥都不用判断。。。
        location.href = finishOrCancelPageUrl + "?tradeId="+tradeId+"&preFlag="+preFlag
    }, function (errData) {
        common.showMessage({
            content: errData.message,
            btnText: "确定",
            onClick: function () {}
        })
        // 返回失败的操作
    }, "JSON", merchantName)
}
/**
 * 引导提示步骤
 */
function showGuide() {
    $("body").addClass("overflow-hidden");
   // $(".guide_modal").show();

    $('#amountCardNo').show();
    $('#orderAmountBtn').show();

 //  $(".guide_money_box").show();
    //  根据图片大小自动调节事件区域
   // adjust("group1");
}
// 引导提示第一步
function guideStep1() {
    $(".guide_money_box").hide();
    $(".guide_modal").hide();
    $(".guide_bank_box").hide();
    $("body").removeClass("overflow-hidden");
    // 弹出复制金额的提示
    $(".order_money").find(".gac-copy-tips").show();
    /*
    if ($(".guide_bank_box").length){
        $(".guide_bank_box").show();
        adjust("group2");
    } else {
        if (console) console.log("hide guide_modal");
        $(".guide_modal").hide();
        $("body").removeClass("overflow-hidden");
        //  银行卡页面没有长按保存二维码提示：guide_qrcode_box
        if ($(".guide_qrcode_box").length && utils.isMobile()) {
            $('.guide_qrcode_box').show();
            setTimeout(function test(){
                $('.guide_qrcode_box').hide();
            },3000);
        }
        // 弹出复制金额的提示
        $(".order_money").find(".gac-copy-tips").show();

    }*/
}
// 引导提示第二步
function guideStep2() {
    $(".guide_modal").hide();
    $(".guide_bank_box").hide();
    $("body").removeClass("overflow-hidden");
    // 弹出复制金额的提示
    $(".order_money").find(".gac-copy-tips").show();
}

/**
 * 显示隐藏取消订单弹框
 */
function showCancelOrderModal() {
    $("#cancel_order_modal").show();
}

function hideCancelOrderModal() {
    $("#cancel_order_modal").hide();
}
/**
 * 弹出复制文字的提示框
 */
function onShowCopyTips(_this, isHide) {
    if (isHide) {
        $(_this).children(".gac-copy-tips").hide();
    } else {
        $(_this).children(".gac-copy-tips").show();
    }
}

/* 更改账户弹出框操作*/
function changeAccountModalShow() {
    qryPayType();
}
// 点击关闭
function changeAccountModalCancel() {
    $("#change_account_modal").hide();
}


/**
 * 获取换卡时所支持的支付通道
 */
function qryPayType() {
    var params = {

    }
    var $payType = $("#payType");
    getAjax(payTypeUrl+"?tradeNo=" + tradeId, params , function (succData) {
        if (succData.code == 200) {
            var res = succData.data;
            $payType.empty();
            if (!res || res.length == 0){
                // nopayModalShow();
                noPayType($payType);
            } else {
                $.each( res , function( index, data ) {
                    converPayType($payType , data.cardType );
                });
                $("#change_account_modal").show();
            }
            /*
            getAjax(userCancleCount+"?tradeId="+tradeId, {} , function (succData) {
                if(succData.code == 200){
                    $("#changeCount").text(succData.data)
                }else{
                    $("#changeCount").text(3)
                }
            },function (errData) {
                $("#changeCount").text(3)
            })*/
        } else {
            noPayType($payType);
        }
    }, function (errData) {
        common.showMessage({
            content: errData.message,
            btnText: "确定",
            onClick: function () {}
        })
        // 返回失败的操作
    }, "JSON", merchantName)
}
var noPayType = function ($target) {
    changeAccountModalCancel();
    $(".gac-toast").text('无法选择新的支付方式，请取消后重新下单');
    $(".gac-toast").show();
    setTimeout(function() {
        $(".gac-toast").hide();
    }, 3 * 1000);
}
var converPayType = function ($target,channel) {
    if (channel == "BANK_CARD"){
        $target.append("<option class='payTypeData' value='BANK_CARD,false'>银行卡转账</option>")
    }else if (channel == "WECHAT_BANK"){
        $target.append("<option class='payTypeData' value='WECHAT_BANK,true'>微信转银行卡</option>")
    }else if (channel == "ALIPAY_BANK"){
        $target.append("<option class='payTypeData' value='ALIPAY_BANK,true'>支付宝转银行卡</option>")
    }else if ( channel == "WECHAT") {
        $target.append("<option class='payTypeData' value='WECHAT,false'>微信扫码</option>")
    }else if ( channel == 'ALIPAY') {
        $target.append("<option class='payTypeData' value='ALIPAY,false'>支付宝扫码</option>")
    }else if ( channel == 'QUICKPASS') {
        $target.append("<option class='payTypeData' value='QUICKPASS,false'>云闪付</option>")
    }else if ( channel == 'BUSINESS_ALIPAY') {
        $target.append("<option class='payTypeData' value='BUSINESS_ALIPAY,false'>支付宝快捷支付</option>")
    }else if ( channel == 'BUSINESS_ALIPAY_BANK') {
        $target.append("<option class='payTypeData' value='BUSINESS_ALIPAY_BANK,false'>支付宝扫码转银行卡</option>")
    }
}
var isBuyChangeLoading = false;
// 点击确定换卡请求
function changeAccountModalSure() {
    if (isBuyChangeLoading) {
        return
    }
    //  支付方式
    var options = $('#payType option:selected').val();
    if ( options) {
        var userCardType = options.split(",")[0];
        var bankCardTrans = options.split(",")[1];
    }else {
        $('#pay-type-error').show();
        return
    }
    var changeReason = $("input[name='changeReason']:checked").val()
    if (!changeReason && changeReason != 0) {
        $('#reason-error').show()
        return
    }
    $('#pay-type-error').hide()
    $('#reason-error').hide()
    var params = {
        'fastSubName':fastSubName,
        'userCardType':userCardType,
        'tradeNo':tradeId,
        'changeReason':$("input[name='changeReason']:checked").val(),
        'bankCardTrans':bankCardTrans
    }
    isBuyChangeLoading = true;
    postAjax(buyChangeUrl, params , function (succData) {
        // 返回成功的操作
        if (succData.code == 200) {
            //console.log(payDetailForApp + "?tradeId=" + succData.data.tradeId + "&prePayOrderFlag=" + prePayOrderFlag + "&merchantName="+merchantName )
            window.location.href = payDetailUrl + "?tradeId=" + succData.data.realTradeId + "&preFlag=" + preFlag + "&merchantName="+merchantName ;
        }else if (succData.code == 617){
            showMatchFailMsg();
            changeAccountModalCancel();
        }else if(succData.code==628){
            common.showMessage({
                content: "您当日取消或换卡次数过多，当前订单无法更换",
                btnText: "确定",
                onClick: function () {
                    changeAccountModalCancel()
                }
            });
        }
        isBuyChangeLoading = false;
    }, function (errData) {
        if ( errData.code == 617){
            showMatchFailMsg();
        }else if(errData.code==628){
            common.showMessage({
                content: "您当日取消或换卡次数过多，当前订单无法更换",
                btnText: "确定",
                onClick: function () {
                    changeAccountModalCancel()
                }
            });
        }else {
            common.showMessage({
                content: errData.message,
                btnText: "确定",
                onClick: function () {}
            });
        }
        changeAccountModalCancel();
        isBuyChangeLoading = false;
    }, "JSON", merchantName)
}

function showMatchFailMsg() {
    common.showMessage({
        content: '订单匹配失败,请稍后再试！',
        btnText: "确定",
        onClick: function () {}
    })
}

/**
 * 轮询订单状态
 * @param tradeId
 * @param merchantName
 */
function qryOrderStatus(tradeId,merchantName) {
    window.setinterval=setInterval(function() {
        var params={tradeId:tradeId}
        getAjax(qryBuyDetail,params,function(succData){
            if(succData.code==200){
                if(succData.data.tradeStatus==202 || succData.data.tradeStatus==203 ||
                    succData.data.tradeStatus==4) {
                    clearTimeout(window.setinterval);
                    location.href = payDetailUrl + "?tradeId=" + succData.data.realTradeId + "&preFlag=" + preFlag + "&merchantName="+merchantName ;
                }
            }
        },function(errData){
            $('.payment').html(errData.message)
            $('.mask').show()
        },"JSON",merchantName)
    }, 3000);
}
//  引导图点击区域处理
//页面大小变化，重新加载页面以刷新MAP
var timeoutMap = null;//onresize触发次数过多，设置定时器
window.onresize = function () {
    clearTimeout(timeoutMap);
    timeoutMap = setTimeout(function () {
        if ($(".guide_money_box").length){
         //   adjust("group1");
        }
        if ($(".guide_bank_box").length){
        //    adjust("group2");
        }
    }, 100);
}
//获取MAP中元素属性
function adjust(idStr) {
    var map = document.getElementById(idStr);
    var element = map.childNodes;
    var itemNumber = element.length / 2;

    var imgWidth = document.getElementById(idStr + "Img").clientWidth;//获取图片当前宽度
    var imgHeith = document.getElementById(idStr + "Img").clientHeight;//获取图片当前高度
    for (var i = 0; i < itemNumber - 1; i++) {
        var item = 2 * i + 1;
        var oldCoords = element[item].coords;
        var newcoords = adjustPosition(oldCoords, imgWidth, imgHeith);
        element[item].setAttribute("coords", newcoords);
    }
}

//调整MAP中坐标
function adjustPosition(position, pageWidth, pageHeith) {
    var imageWidth = 456;	//图片的长宽
    var imageHeigth = 202.22;
    var each = "330,5,528,55".split(",");   //  position.split(",");
    //获取每个坐标点
    for (var i = 0; i < each.length; i++) {
        each[i] = Math.round(parseInt(each[i]) * pageWidth / imageWidth).toString();//x坐标
        i++;
        each[i] = Math.round(parseInt(each[i]) * pageHeith / imageHeigth).toString();//y坐标
    }
    // 偏小纠正
    var newPosition = "";
    if (each[2] <= pageWidth) {
        each[2] = pageWidth + 10
    }
    if (each[3] <= pageHeith * 0.4) {
        each[3] = pageHeith * 0.4
    }
    console.log('each:',each)
    //生成新的坐标点
    for (var i = 0; i < each.length; i++) {
        newPosition += each[i];
        if (i < each.length - 1) {
            newPosition += ",";
        }
    }
    return newPosition;
}
