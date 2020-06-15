<?php
use xh\library\url;
?>
	<?php include_once (PATH_VIEW . 'common/header.php');?>
	<link href="<?php echo URL_VIEW;?>/static/js/plugins/prism/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
	<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/prism/prism.js"></script>
    <!-- START CONTENT -->
      <section id="content">
        
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
            <!-- Search for small screen -->
            <div class="header-search-wrapper grey hide-on-large-only">
                <i class="mdi-action-search active"></i>
                <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
            </div>
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">接口文档</h5>
                <ol class="breadcrumbs">
                    <li><a href="#">文档</a></li>
                    <li class="active">接收异步通知</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
        <!--start container-->
        <div class="container">
          <div class="section">
          
 <p class="caption">查询异步通知参数</p>
 
        <!--Striped Table-->
      
            <div id="striped-table">
              
              <div class="row">
             
                <div class="col s12 m12 l12">
                  <table class="striped">
                    <thead>
                      <tr>
                        <th>参数(POST)</th>
                        <th>说明</th>
                        <th>示例</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>account_name</td>
                        <td>商户登录名（会员名），识别是哪个会员名回调过来的请求</td>
                        <td><?php echo WEB_NAME; ?></td>
                      </tr>
                      <tr>
                        <td>pay_time</td>
                        <td>支付成功的时间戳（10位）</td>
                        <td>1529775437</td>
                      </tr>
                      <tr>
                        <td>status</td>
                        <td>支付状态，支付状态只有成功一个状态（success）</td>
                        <td>success</td>
                      </tr>
                      <tr>
                        <td>amount</td>
                        <td>支付金额</td>
                        <td>1.00</td>
                      </tr>
                      <tr>
                        <td>out_trade_no</td>
                        <td>订单信息，在发起订单时附加的信息，如用户名，充值订单号等字段参数</td>
                        <td>2018062312410711888</td>
                      </tr>
                      
                      <tr>
                        <td>trade_no</td>
                        <td>交易流水号，由系统生成的交易流水号</td>
                        <td>2018062312410729584 </td>
                      </tr>
                      
                      <tr>
                        <td>fees</td>
                        <td>手续费，本次回调过程产生的手续费用（已经在平台账户中扣除）</td>
                        <td>0.04</td>
                      </tr>
                      
                      <tr>
                        <td>sign</td>
                        <td>签名算法，在支付时进行签名算法，详见<a href="<?php echo url::s("index/doc/sign");?>">《<?php echo WEB_NAME; ?>签名算法》</a></td>
                        <td>d92eff67b3be05f5e61502e96278d01b</td>
                      </tr>
                      
                      
                      <tr>
                        <td>callback_time</td>
                        <td>回调时间，在回调时产生的时间戳（10位）</td>
                        <td>1529775437</td>
                      </tr>
                      
                      
                      <tr>
                        <td>type</td>
                        <td>当前订单支付类型，1为微信，2为支付宝，3为银行卡，4为拉卡拉，5为云闪付</td>
                        <td>1</td>
                      </tr>
                      
                      
                      <tr>
                        <td>account_key</td>
                        <td>商户KEY（S_KEY）</td>
                        <td>4C61C86ABEBC6243</td>
                      </tr>
                      
                  
                      
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!--Hoverable Table-->

 

          </div>


        </div>
        <!--end container-->
        
      </section>
      <!-- END CONTENT -->
      
      
       <!--start container-->
        <div class="container">
          <div class="section">

         

            <div class="divider"></div>

            <!--Input fields-->
            <div id="input-fields">
               <div class="row">
           <div class="col s12 m12 l6">
                        <p>PHP版本接收异步通知</p>
             <pre class="language-javascript"><code class="language-javascript" style="font-family: 微软雅黑;"><\?php
//接收异步通知请求demo文件
//签名算法库
include ('sign.php');

//商户名称
$account_name  = $_POST['account_name'];
//支付时间戳
$pay_time  = $_POST['pay_time'];
//支付状态
$status  = $_POST['status'];
//支付金额
$amount  = $_POST['amount'];
//支付时提交的订单信息
$out_trade_no  = $_POST['out_trade_no'];
//平台订单交易流水号
$trade_no  = $_POST['trade_no'];
//该笔交易手续费用
$fees  = $_POST['fees'];
//签名算法
$sign  = $_POST['sign'];
//回调时间戳
$callback_time  = $_POST['callback_time'];
//支付类型
$type = $_POST['type'];
//商户KEY（S_KEY）
$account_key = $_POST['account_key'];


//第一步，检测商户KEY是否一致
if ($account_key != '你的商户KEY') exit('error:key');
//第二步，验证签名是否一致
if (sign('你的商户KEY', ['amount'=>$amount,'out_trade_no'=>$out_trade_no]) != $sign) exit('error:sign');

//下面就可以安全的使用上面的信息给贵公司平台进行入款操作

//支付成功后必须要返回该信息,否则默认为发送失败，补发3次，3次还未返回，则默认为发送失败

echo 'success';

//测试时，将来源请求写入到txt文件，方便分析查看
file_put_contents("callback_log.txt", json_encode($_POST));
             
             </code></pre>
            
            </div>
            
            
            <div class="col s12 m12 l6">
                        <p>JAVA版本接收异步通知</p>
             <pre class="language-javascript"><code class="language-javascript" style="font-family: 微软雅黑;">package im.jik.demo;

import java.io.IOException;
import java.util.HashMap;
import java.util.Map;

import com.alibaba.fastjson.JSONObject;

import okhttp3.FormBody;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.RequestBody;
import okhttp3.Response;

public class Demo {
	private static final String CALLBACK_URL = "http://www.baidu.com/";
	private static final String SUCCESS_URL = "http://www.baidu.com/";
	private static final String ERROT_URL = "http://www.baidu.com/";
	private static final String KEY = "4C61C86ABEBC7249";
	private static OkHttpClient client = new OkHttpClient();

	public static void main(String[] args) {
		HashMap<String, String> params = new HashMap<>();
		params.put("account_id", "10000");// 商户ID
		params.put("content_type", "json");// 网页类型
		params.put("thoroughfare", "service_auto");// 支付通道
		params.put("out_trade_no", "201806261212440");// 订单信息
		params.put("robin", "2");// 轮训状态 //2开启1关闭
		params.put("amount", "20.01");// 支付金额
		params.put("callback_url", CALLBACK_URL);// 异步通知url
		params.put("success_url", SUCCESS_URL);// 支付成功后跳转到url
		params.put("error_url", ERROT_URL);// 支付失败后跳转到url
		String sign = Demo.getSign("20.01", "201806261212440");
		params.put("sign", sign);// 签名算法
		params.put("type", "1");// 支付类型 //1为微信，2为支付宝
		params.put("keyId", "");// 设备KEY 轮询无需填写

		String order = Demo.post("http://x.qakmak.com", params);
		// 获取结果
		System.out.println("result:" + order);

		JSONObject object = JSONObject.parseObject(order);
		JSONObject object2 = object.getJSONObject("data");
		String order_id = object2.getString("order_id");

		String result = Demo.get("http://x.qakmak.com/gateway/pay/service.do?content_type=json&id=" + order_id);
		System.out.println("result:" + result);
	}

	/**
	 * 
	 * @param account_name
	 *            商户名称
	 * @param pay_time
	 *            支付时间戳
	 * @param status
	 *            支付状态
	 * @param amount
	 *            支付金额
	 * @param out_trade_no
	 *            订单信息
	 * @param trade_no
	 *            交易流水号
	 * @param fees
	 *            该订单手续费
	 * @param sign
	 *            订单签名
	 * @param callback_time
	 *            回调时间
	 * @param type
	 *            支付类型
	 * @param account_key
	 *            商户KEY（S_KEY）
	 * @return
	 */
	public static String notify(String account_name, //
			String pay_time, //
			String status, //
			String amount, //
			String out_trade_no, //
			String trade_no, //
			String fees, //
			String sign, //
			String callback_time, //
			String type, //
			String account_key) {
		//验证key是否正确
		if (!KEY.equalsIgnoreCase(account_key)) {
			return "error";
		}
		//验证签名是否正确
		String s = Demo.getSign(amount, out_trade_no);
		if (!s.equalsIgnoreCase(sign)) {
			return "sign error";
		}
		return "success";
	}

	/**
	 * 获得sign
	 * 
	 * @param amount
	 *            金额
	 * @param orderNo
	 *            订单信息
	 * @return
	 */
	public static String getSign(String amount, String orderNo) {
		String data = amount + orderNo;

		System.out.println("data:" + data);

		String md5Crypt = MD5Utils.md5(data.getBytes());

		System.out.println("md5Crypt:" + md5Crypt);

		byte[] rc4_string = RC4.encry_RC4_byte(md5Crypt, KEY);

		System.out.println("rc4_string:" + rc4_string);

		String sign = MD5Utils.md5(rc4_string);

		System.out.println("sign:" + sign);
		return sign;
	}

	public static String post(String url, Map<String, String> params) {
		FormBody.Builder builder = new FormBody.Builder();
		for (String key : params.keySet()) {
			builder.add(key, params.get(key).toString());
		}

		RequestBody formBody = builder.build();
		Request request = new Request.Builder().url(url).post(formBody).build();
		String result = null;
		try {
			Response response = client.newCall(request).execute();
			int code = response.code();
			System.err.println("状态码:" + code);
			result = response.body().string();

		} catch (IOException e) {
			e.printStackTrace();
		}
		return result;
	}

	public static String get(String url) {

		Request request = new Request.Builder().url(url).build();
		String json = null;
		okhttp3.Response response = null;
		try {

			response = client.newCall(request).execute();
			json = response.body().string();

		} catch (IOException e) {
			e.printStackTrace();
		}
		return json;
	}
}
             
             
             </code></pre>
            
            </div>
            
            
            
            
            
            
            
            
            
            
            
            </div>
            
            
            
            </div>
</div></div>
      <?php include_once (PATH_VIEW . 'common/footer.php');?>    
   