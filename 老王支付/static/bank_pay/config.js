
// pro
//  var httpApi="https://api.qapple.io/v2/api/";

// pre
// var httpApi="http://paysrv.qapple.io/v2/api/"

// dev
// var httpApi="http://192.168.0.201:8000/v2/api/";



//var httpApi = "http://192.168.0.178:8153/"
var httpApi = "/"

/*获得支付方式的列表 */
var payChannelList = httpApi+"merchant/matchcenter/payChannel/list";
/*确定充值(买入)*/
var buy=httpApi+"merchant/matchcenter/tradeFast/buy";

var baseAppUrl = "/merchant/matchcenter/tradeFast/app";
var createFastPayOrderForApp = "/merchant/matchcenter/tradeFast/v2/index";

var payDetailUrl = "/merchant/matchcenter/tradeFast/v2/details";

var finishOrCancelPageUrl = "/merchant/matchcenter/tradeFast/v2/finish";

//取消次数记录
var userCancleCount = "/merchant/matchcenter/tradeFast/queryChageCount";


/*确认买入*/
var userPayConfirmBuy=httpApi+"merchant/matchcenter/tradeFast/userPayConfirmBuy";
/*订单列表*/
var qryBuyList=httpApi+"merchant/matchcenter/tradeFast/qryBuyList";
/*订单详情*/
var qryBuyDetail=httpApi+"merchant/matchcenter/tradeFast/qryBuyDetail";

/*取未完成的订单*/
var getUnfinishedTradeId=httpApi+"merchant/matchcenter/tradeFast/getUnfinishedTradeId";
/*重启订单*/
var rebootTrade=httpApi+"merchant/matchcenter/tradeFast/rebootTrade";
/*关闭订单*/
var closeFreezeTrade=httpApi+"merchant/matchcenter/tradeFast/closeFreezeTrade";

var prePayDetail=httpApi+"merchant/merchantcenter/pay/prePayDetail";

var basePcUrl = "/merchant/matchcenter/tradeFast/pc";
var createPageUrl = basePcUrl + "/createFastPage?n=";

//取消订单并填写原因
var cancelOrderUrl = "/merchant/matchcenter/tradeFast/userCancelBuy";

//根据商家查询可选的支付方式
var payTypeUrl = "/merchant/matchcenter/tradeFast/qryFastCardListByTradeNo";
//超时取消
var userOverCancelBuyUrl = "/merchant/matchcenter/tradeFast/userOverCancelBuy";

//换卡支付
var buyChangeUrl = "/merchant/matchcenter/tradeFast/buyChange";
