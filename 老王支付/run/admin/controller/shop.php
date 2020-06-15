<?php
namespace xh\run\admin\controller;

use xh\library\functions;
use xh\library\model;
use xh\library\mysql;
use xh\library\request;
use xh\library\session;
use xh\library\url;
use xh\library\view;
use xh\unity\page;
use xh\unity\upload;

class shop
{

    // 构造一个mysql请求
    private $mysql;

    // 权限验证
    protected function powerLogin($Mid)
    {
        session::check();
        if (! (new model())->load('user', 'authority')->moduleValidate($Mid)) {
            url::address(url::s('admin/index/home'), '您没有权限访问', 3);
        }
        $this->mysql = new mysql();
    }

    // 商品管理
    // 权限ID：29
    public function index()
    {
        $this->powerLogin(29);
        $result = page::conduct('shop', request::filter('get.page'), 15, null, null, 'sort', 'asc');
        
        //查詢用戶組
        $group = $this->mysql->query("client_group","authority!=-1");
        
        new view("shop/index", [
            'mysql' => $this->mysql,
            'result' => $result,
            'group'=>$group
        ]);
    }

    // 商品添加
    public function add()
    {
        $this->powerLogin(29);
        $name = request::filter('post.shop_name', '', 'htmlspecialchars');
        $description = request::filter('post.description');
        $money = floatval(request::filter('post.money', '', 'htmlspecialchars'));
        $cost = floatval(request::filter('post.cost', '', 'htmlspecialchars'));
        $category = request::filter('post.category', '', 'htmlspecialchars');
        $discount = request::filter('post.discount', '', 'htmlspecialchars');
        $restriction = intval(request::filter('post.restriction', '', 'htmlspecialchars'));
        $bind_special = intval(request::filter('post.bind_special'));
        $warehouse = intval(request::filter('post.warehouse'));;
        
        if (strlen($name) < 1) functions::json(-3, '商品名称不能小于1个字');
        if (strlen($description) < 5) functions::json(-4, '商品描述不能少于5个字');
        if ($money <= 0) functions::json(-5, '商品单价输入不正确');
        if (!in_array($category, [1,2,3])) functions::json(-6, '商品类型未找到,请刷新页面后重试');
        if ($category == 2 || $category == 3){
            //分解规则
            $discount = explode(PHP_EOL, trim($discount,PHP_EOL));
            $discount_array = [];
            $discount_length = count($discount);
            for ($i=0;$i<$discount_length;$i++){
                //检测规则是否存在错误
                $rule = explode(",", trim($discount[$i]));
                if (count($rule) != 2) functions::json(-7, '批发规则识别失败,请检查重新填写');
                if (intval($rule[0]) < 1 || floatval($rule[1]) <= 0) functions::json(-8, '批发规则中检测到有项目超出正规出售范围');
                $discount_array[] = [
                    'num'=>intval($rule[0]),
                    'money'=>floatval($rule[1])
                ];
            }
            $discount = json_encode($discount_array);
            $bind_special = 0;
        }else {
            $discount = 0;
            $restriction = 0;
        }
        
        if ($category != 3) $warehouse=0;
        
        //写到数据库
        $in = $this->mysql->insert("shop", [
            'name'=>$name,
            'description'=>$description,
            'money'=>$money,
            'cost'=>$cost,
            'category'=>$category,
            'discount'=>$discount,
            'restriction'=>$restriction,
            'purchases'=>0,
            'sort'=>0,
            'status'=>1,
            'release_time'=>time(),
            'bind_special'=>$bind_special,
            'warehouse'=>$warehouse
        ]);
        
        if ($in > 0){
            functions::json(200, '商品发布成功');
        }
        
        functions::json(-9, '商品发布失败');
    }
    
    //商品排序
    public function rule(){
        $this->powerLogin(29);
        $id = intval(request::filter('get.id'));
        //序号
        $no = request::filter('get.no');
        $rc = $this->mysql->update("shop", ['sort'=>intval($no)],"id={$id}");
        if ($rc > 0) functions::json(200, '更新成功');
        functions::json(-1, '没有更新任何数据');
    }
    
    //商品修改
    public function updateView(){
        $this->powerLogin(29);
        $id = base64_decode(str_replace('@', '=', request::filter('get.id')));
        $result = $this->mysql->query("shop","id={$id}")[0];
        if (!is_array($result)) url::address(url::s('admin/shop/index'),'当前商品不存在',1);

        //查詢用戶組
        $group = $this->mysql->query("client_group","authority!=-1");
        
        new view("shop/edit", [
            'mysql' => $this->mysql,
            'result' => $result,
            'group'=>$group
        ]);
    }
    
    // 商品修改
    public function edit()
    {
        $this->powerLogin(29);
        $id = intval(request::filter('get.id'));
        $name = request::filter('post.shop_name', '', 'htmlspecialchars');
        $description = request::filter('post.description');
        $money = floatval(request::filter('post.money', '', 'htmlspecialchars'));
        $cost = floatval(request::filter('post.cost', '', 'htmlspecialchars'));
        $discount = request::filter('post.discount', '', 'htmlspecialchars');
        $restriction = intval(request::filter('post.restriction', '', 'htmlspecialchars'));
        $bind_special = intval(request::filter('post.bind_special'));
        $warehouse = intval(request::filter('post.warehouse'));

        if (strlen($name) < 1) functions::json(-3, '商品名称不能小于1个字');
        if (strlen($description) < 5) functions::json(-4, '商品描述不能少于5个字');
        if ($money <= 0) functions::json(-5, '商品单价输入不正确');
        
        $result = $this->mysql->query("shop","id={$id}")[0];
        
        if (!is_array($result)) functions::json(-11, '商品信息异常');
        
        if ($result['category'] == 2 || $result['category'] == 3){
            //分解规则
            $discount = explode(PHP_EOL, trim($discount,PHP_EOL));
            $discount_array = [];
            $discount_length = count($discount);
            for ($i=0;$i<$discount_length;$i++){
                //检测规则是否存在错误
                $rule = explode(",", trim($discount[$i]));
                if (count($rule) != 2) functions::json(-7, '批发规则识别失败,请检查重新填写');
                if (intval($rule[0]) < 1 || floatval($rule[1]) <= 0) functions::json(-8, '批发规则中检测到有项目超出正规出售范围');
                $discount_array[] = [
                    'num'=>intval($rule[0]),
                    'money'=>floatval($rule[1])
                ];
            }
            $discount = json_encode($discount_array);
            $bind_special = 0;
        }else {
            $discount = 0;
            $restriction = 0;
        }
        
        if ($result['category'] != 3){
            $warehouse = 0;
        }
        
        //写到数据库
        $rc = $this->mysql->update("shop", [
            'name'=>$name,
            'description'=>$description,
            'money'=>$money,
            'cost'=>$cost,
            'discount'=>$discount,
            'restriction'=>$restriction,
            'bind_special'=>$bind_special,
            'warehouse'=>$warehouse
        ],"id={$id}");
        
        if ($rc > 0){
            functions::json(200, '商品资料更新成功');
        }
        
        functions::json(-9, '你还没有做任何修改');
    }
    
    //删除商品
    public function delete(){
        $this->powerLogin(29);
        $id = intval(request::filter('get.id'));
        $result = $this->mysql->query("shop","id={$id}")[0];
        if (!is_array($result)) functions::json(-2, '商品不存在');
        $this->mysql->delete("shop", "id={$id}");
        functions::json(200, '您已经将该商品成功移除!');
    }
    
    //更改商品状态
    public function changeStatus(){
        $this->powerLogin(29);
        $id = intval(request::filter('get.id'));
        $result = $this->mysql->query("shop","id={$id}")[0];
        if (!is_array($result)) functions::json(-2, '商品不存在');
        $status = 1;
        if ($result['status'] == 1) $status = 2;
        $rc = $this->mysql->update("shop", ['status'=>$status],"id={$id}");
        if ($rc > 0) functions::json(200, '更新成功');
        functions::json(-6, '更新失败');
    }
    
    
    //卡密列表 31
    public function card(){
        $this->powerLogin(31);
        $sorting = request::filter('get.sorting','','htmlspecialchars');
        $code = request::filter('get.code','','htmlspecialchars');
        
        if ($_SESSION['PAGE_NUM'] == ''){
            $_SESSION['PAGE_NUM'] = 15;
        }
        
        if (request::filter('get.page_num') > 1){
            $_SESSION['PAGE_NUM'] = request::filter('get.page_num');
        }
        
        $where = '';

        //where
        if ($sorting == 'status'){
            $where = "status={$code}";
            $status = $code+1;
            if ($status >= 2){
                $status = 0;
            }
        }else{
            $status = 1;
        }
        
        //卡号查询
        if ($card_no = request::filter('get.card')){
            $where = "card_no={$card_no}";
        }
        
        //卡密查询
        if ($card_pwd = request::filter('get.card_pwd')){
            $where = "card_pwd='{$card_pwd}'";
        }
        
        //商品id查询
        if ($shop_id = request::filter('get.shop_id')){
            $_SESSION['CARD_WHERE'] = "shop_id={$shop_id}";
        }
        
        $result = page::conduct('shop_card', request::filter('get.page'), $_SESSION['PAGE_NUM'], $where, null, 'id', 'asc');
        //查询卡号类型的商品
        $shop = $this->mysql->query("shop","category=2");

        new view("shop/card", [
            'mysql' => $this->mysql,
            'result' => $result,
            'shop'=>$shop,
            'page_num'=>$_SESSION['PAGE_NUM'],
            'status'=>$status
        ]);
    }
    
    //添加卡密
    public function addCard(){
        $this->powerLogin(31);
        $path =  '/download/upload/card';
        $upload = (new upload())->run($_FILES['file'], ROOT_PATH . $path, array('txt'),100000000);
        
        if (is_array($upload)){
            $card = file_get_contents(URL_ROOT . $path . '/' . $upload['new']);
        }else{
            $card = request::filter("post.card");
        }
        
        if ($card == '') functions::json(-1, '卡密不能为空');
        
        $shop_id = intval(request::filter('post.shop_id'));
        $delimiter = request::filter('post.delimiter');
        
        $card_list = explode(PHP_EOL, trim($card,PHP_EOL));
        $card_list_count = count($card_list);
        
        $value_list_array = [];
        
        for ($i=0;$i<$card_list_count;$i++){
            $cardInfo = explode($delimiter, trim($card_list[$i]));
            $value_list_array[] = [$cardInfo[0],$cardInfo[1],$shop_id,0,time(),0,0];
        }

        $in = $this->mysql->insert_array("shop_card", ['card_no','card_pwd','shop_id','status','add_time','sell_time','user_id'], $value_list_array);

        functions::json(200, '卡密导入完成,共添加:' . $card_list_count . '张卡密');
    }
    
    
    //删除卡密
    public function delCard(){
        $this->powerLogin(32);
        $id = intval(request::filter('get.id'));
        $this->mysql->delete("shop_card", "id={$id}");
        functions::json(200, '操作完成');
    }

    
    //订单管理
    public function order(){
        $this->powerLogin(32);
        $sorting = request::filter('get.sorting','','htmlspecialchars');
        $code = request::filter('get.code','','htmlspecialchars');

        //锁定用户查询
        if ($sorting == 'user'){
            if (!empty($code)){
                $_SESSION['SHOP']['ORDER']['WHERE'] = 'user_id=' . $code . ' and ';
            }else{
                unset($_SESSION['SHOP']['ORDER']['WHERE']);
            }
        }
        
        if ($sorting == 'session'){
            if ($code == 'unset'){
                unset($_SESSION['SHOP']['ORDER']['WHERE']);
            }
        }
        
        $where = $_SESSION['SHOP']['ORDER']['WHERE'];
        
        //支付类型
        if ($sorting == 'status'){
            if (in_array($code, [0,1,2,3,4,5,6,7])){
                $where .= "status={$code}";
            }
        }
        
        //订单号
        if ($sorting == 'serial_no'){
            if ($code != '') {
                $code = trim($code);
                $where = "serial_no like '%{$code}%'";
            }
        }
        



        $where = trim(trim($where),'and');
        
        $result = page::conduct('shop_order',request::filter('get.page'),15,$where,null,'id','desc');
        
        new view('shop/order',[
            'result'=>$result,
            'mysql'=>$this->mysql,
            'sorting'=>[
                'code'=>$code,
                'name'=>$sorting
            ],
            'where' => $where
        ]);
    }
    
    //关闭交易
    public function closeBuy(){
        $this->powerLogin(32);
        $id = intval(request::filter('get.id','','htmlspecialchars'));//ID
        $findOrder = $this->mysql->query("shop_order","id={$id}")[0];
        if (!is_array($findOrder)) functions::json(-3, '当前交易不存在');
        //检测交易是否不为未支付
        if ($findOrder['status'] != 0) functions::json(-2, '当前交易状态不可更改');
        $rc = $this->mysql->update("shop_order", ['status'=>7],"id={$id}");
        if ($rc > 0) functions::json(200, '当前订单关闭成功');
        functions::json(-5, '当前订单关闭失败');
    }
    
    //确认发货
    public function ship(){
        $this->powerLogin(32);
        $id = intval(request::filter('post.id','','htmlspecialchars'));//ID
        $waybill = request::filter('post.waybill','','htmlspecialchars');//运单号
        $courierCode =  request::filter('post.courierCode','','htmlspecialchars');//快递代码
        if (mb_strlen($waybill) < 5 || empty($courierCode)) functions::json(-8, '快递信息有误');
        $findOrder = $this->mysql->query("shop_order","id={$id}")[0];
        if (!is_array($findOrder)) functions::json(-3, '当前交易不存在');
        if ($findOrder['status'] != 1) functions::json(-2, '当前交易状态不可更改');
        //更改状态
        $rc = $this->mysql->update("shop_order", ['status'=>2,'ship'=>$waybill,'express'=>$courierCode],"id={$id}");
        if ($rc > 0) functions::json(200, '发货成功');
        functions::json(-5, '发货失败');

    }
    
    
    //查询物流或卡密
    public function logistics(){
        $this->powerLogin(32);
        $id = intval(request::filter('get.id','','htmlspecialchars'));//ID
        $findOrder = $this->mysql->query("shop_order","id={$id}")[0];
        if (!is_array($findOrder)) exit('<b style="color:red;">当前交易订单不存在</b>');
        if (!in_array($findOrder['status'], [2,3])) exit('<b style="color:red;">当前交易订单状态不可查询</b>');
        //查询商品信息
        $shopInfo = $this->mysql->query("shop","id={$findOrder['shop_id']}")[0];
        new view('shop/logistics',[
            'result'=>$findOrder,
            'shop'=>$shopInfo
        ]);
    }
    
    //获得物流id
    public function express(){
        $this->powerLogin(32);
        $id = intval(request::filter('get.id','','htmlspecialchars'));//ID
        $findOrder = $this->mysql->query("shop_order","id={$id}")[0];
        if (!is_array($findOrder)) functions::json(-2, '当前交易订单不存在');
        if (!in_array($findOrder['status'], [2,3])) functions::json(-3, '当前交易订单状态不可查询');
        if (intval($findOrder['ship']) < 200) functions::json(-4, '当前订单暂未发货');
        $url_id = file_get_contents("http://www.kuaidi100.com/applyurl?key=5b42d3c815d963ec&com={$findOrder['express']}&nu={$findOrder['ship']}");
        return functions::json(200, '查询成功',['url_id'=>$url_id]);
    }
    
    //确认退款
    public function refund(){
        $this->powerLogin(32);
        $id = intval(request::filter('get.id','','htmlspecialchars'));//ID
        $findOrder = $this->mysql->query("shop_order","id={$id}")[0];
        if (!is_array($findOrder)) functions::json(-2, '当前交易订单不存在');
        if ($findOrder['status'] != 4) functions::json(-2, '当前交易状态不可更改');
        //加载退货进度
        $refund_schedule = json_decode($findOrder['refund_schedule'],true);
        $refund_schedule[] = [
            'time'=>time(),
            'info'=>'退款成功,款项已经退款至您的盈利余额'
        ];
        $rc = $this->mysql->update("shop_order", ['status'=>5,'refund_schedule'=>$refund_schedule],"id={$findOrder['id']}");
        if ($rc > 0){
            //查询用户信息
            $findUser = $this->mysql->query("client_user","id={$findOrder['user_id']}")[0];
            $this->mysql->update("client_user", ['money'=>$findUser['money']+$findOrder['refund_amount']],"id={$findUser['id']}");
            functions::json(200, '退款成功');
        }
        
        functions::json(-6, '退款失败');
    }
    
    //拒绝退款
    public function cancelRefund(){
        $this->powerLogin(32);
        $id = intval(request::filter('get.id'));
        $reason = request::filter('get.reason','','htmlspecialchars');
        $findOrder = $this->mysql->query("shop_order","id={$id}")[0];
        if (!is_array($findOrder)) functions::json(-2, '当前交易订单不存在' . $id);
        if ($findOrder['status'] != 4) functions::json(-2, '当前交易状态不可更改');
        //加载退货进度
        $refund_schedule = json_decode($findOrder['refund_schedule'],true);
        $refund_schedule[] = [
            'time'=>time(),
            'info'=>$reason
        ];
        $rc = $this->mysql->update("shop_order", ['status'=>6,'refund_schedule'=>$refund_schedule],"id={$findOrder['id']}");
        if ($rc > 0) functions::json(200, '已经成功拒绝该退款');
        functions::json(-6, '处理失败');
    }
    
    //删除订单
    public function del(){
        $this->powerLogin(32);
        $id = intval(request::filter('get.id'));
        $this->mysql->delete("shop_order", "id={$id}");
        functions::json(200, '操作完成');
    }
    
    
}