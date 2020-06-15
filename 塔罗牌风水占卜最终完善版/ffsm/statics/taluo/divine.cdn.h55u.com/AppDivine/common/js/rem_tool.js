
var clientWidth = 320;
var clientWidthTrue = 320;
var value = 16;


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
    clientWidthTrue = docEl.clientWidth;
    clientWidth = clientWidthTrue > 640 ? 640 : clientWidthTrue;
    if (!clientWidth) return;
    value = parseInt(50 * (clientWidth / 640));
    //var value_new = value / xs;
    var value_new = value;
    docEl.style.fontSize = value_new + 'px';
  };
  if (!doc.addEventListener) return;
  win.addEventListener(resizeEvt, recalc, false);
  doc.addEventListener('DOMContentLoaded', recalc, false);
  recalc();
})(document, window);