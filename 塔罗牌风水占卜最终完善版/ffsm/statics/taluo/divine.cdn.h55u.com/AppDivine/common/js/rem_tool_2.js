var rem_clientWidth = 320;
var rem_clientWidthTrue = 320;
var rem_value = 16;


//禁止微信修改系统字体大小
(function() {
  if (typeof WeixinJSBridge == "object" && typeof WeixinJSBridge.invoke == "function") {
    handleFontSize();
  } else {
    if (document.addEventListener) {
    document.addEventListener("WeixinJSBridgeReady", handleFontSize, false);
    } else if (document.attachEvent) {
      document.attachEvent("WeixinJSBridgeReady", handleFontSize);
      document.attachEvent("onWeixinJSBridgeReady", handleFontSize);
    }
  }
  function handleFontSize() {
    // 设置网页字体为默认大小
    WeixinJSBridge.invoke('setFontSizeCallback', { 'fontSize' : 0 });
    // 重写设置网页字体大小的事件
    WeixinJSBridge.on('menu:setfont', function() {
    WeixinJSBridge.invoke('setFontSizeCallback', { 'fontSize' : 0 });
    });
  }
})();

(function (doc, win) {
  if (doc.documentElement.currentStyle) {
    var user_webset_font = doc.documentElement.currentStyle['fontSize'];
  }else {
    var user_webset_font = getComputedStyle(doc.documentElement, false)['fontSize'];
  }
  var xs = parseFloat(user_webset_font) / 16;
  var docEl = doc.documentElement,
  resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
  recalc = function () {
    rem_clientWidthTrue = docEl.clientWidth;
    rem_clientWidth = rem_clientWidthTrue > 640 ? 640 : rem_clientWidthTrue;
    if (!rem_clientWidth) return;
    rem_value = parseInt(20 * (rem_clientWidth / 320));
    //var rem_value_new = rem_value / xs;
	var rem_value_new = rem_value / xs;
    docEl.style.fontSize = rem_value_new + 'px';
  };
  if (!doc.addEventListener) return;
  win.addEventListener(resizeEvt, recalc, false);
  doc.addEventListener('DOMContentLoaded', recalc, false);
  recalc();
})(document, window);