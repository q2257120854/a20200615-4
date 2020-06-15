<?php
if( !defined('CORE') ) exit('Request Error!');
/**
 * 首页控制器
 *
 * @version 2013.07.05
 */
class ctl_index
{
    public $cache_enable = true;//缓存开关,调试时可设为false
    public $cachetime    = 7200;//缓存时间,秒(注意:内容页缓存是单独的在video_view中设置)
    public $cache_prefix = 'www.xxx.com';
    public $cache_key    = 'index/index';
    public $system    = '';


    public function __construct()
    {
        if(isset($_SERVER['REQUEST_URI']) && false !== stripos($_SERVER['REQUEST_URI'],'clearcache')){
            $this->cache_enable = false;
        }
        $sql = 'select * from `system`';
        $row = db::querylist($sql);
		foreach($row as $k=>$v){
			$this->money[$v['name']] = $v['config'];
		}

    }



    /**
     * taluo
     */
    public function taluoyunshi(){

        $form['type'] = 14;
        $oid = req::post('oid');
        $update = req::post('update',0);//1位强制刷新卡牌
        $pay = req::post('pay',0);//判断用户是否选牌

        if(!empty($oid)){
            $row = mod_order::get_order($oid);
            if(empty($row)){
                $tpl     = 'index/taluo/yunshi/form.tpl';
            }elseif($row['status']!=1){
                if($update=='1'){//强制刷新订单内卡牌
                    $row['data'] = array('carinfo'=>mod_ffsm_taluo_yunshi::car());
                    $orders['data'] = urlencode(json_encode($row['data']));
                    mod_order::up_order($orders," `oid`='".$row['oid']."'");
                    //重置卡牌
                    $row['data'] = $orders['data'];
                }
                $row['data'] = json_decode(urldecode($row['data']),true);
                tpl::assign('data',$row);

                if($pay==1){
                    $tpl     = 'index/taluo/yunshi/order.tpl';
                }else{
                    $tpl     = 'index/taluo/yunshi/order_xuanpai.tpl';
                }
            }else{

                $row['data'] = json_decode(urldecode($row['data']),true);
                tpl::assign('data',$row);

                $tpl     = 'index/taluo/yunshi/find.tpl';
            }

        }else{

            $tpl     = 'index/taluo/yunshi/form.tpl';
        }


        $content = tpl::fetch($tpl);
        exit($content);

    }

    //塔罗卡牌名字以及正逆位
    //





    /**
     * 塔罗牌-增加订单-定卡牌
     */
    public function userinfosubmit(){
        $src = req::post('src');
        $gid = req::post('gid');
        $form['type'] = 14;
        $form['username'] = req::post('name','你的');
        $form['money'] = $this->money['taluoyunshi'];
        $form['oid'] = mod_order::createoid($form['type']);

        $carinfo = mod_ffsm_taluo_yunshi::car();//生成随机卡牌

        $form['datas'] = array('username'=>($form['username']),'carinfo'=>$carinfo);
        mod_order::add_order($form);
        exit(json_encode(array('code'=>1,'message'=>'保存成功','data'=>array('record_id'=>$form['oid']))));
    }

    


	
	/**
    *首页
    */
    public function index()
    {

		$tpl     = 'index/index.tpl';
		$content = tpl::fetch($tpl);
        exit($content);
		
    }
	
	
	
	
	//------以下为单页面---->
	
	
	public function select_orders(){
        $oid = req::post('oid');
        $row = mod_order::get_order($oid);

        if($row==''){
            die("没有该订单!");
        }else{
            $ac=mod_order::typetochannel($row['type']);
            $url = "/?ac=".$ac."&oid=".$row['oid']."&token=".base64_encode(md5($row['oid']));
            header('Location:'.$url);
            exit;
        }
    }

    public function history(){
        $orders= mod_order::get_history();
		
		if(!empty($orders)){
			
			foreach($orders as $k=>$v){
				$orders_arr = mod_order::get_order($v);
				$data[] = $orders_arr;
				$ac=mod_order::typetochannel($orders_arr['type']);
				$data[$k]['url'] = "/?ac=".$ac."&oid=".$orders_arr['oid']."&token=".base64_encode(md5($orders_arr['oid']));
			}
		}

        tpl::assign('data',$data);
        $tpl     = 'index/history.tpl';
        $content = tpl::fetch($tpl);
        exit($content);
    }


    public function feedback(){

        $data['username'] = req::post('username');
		$data['payment_time'] = req::post('payment_time');
		$data['typeid'] = req::post('typeid');
		$data['contact_type'] = req::post('contact_type');
		$data['contact_wx'] = req::post('contact_wx');
		$data['contact_email'] = req::post('contact_email');
		$data['contact_phone'] = req::post('contact_phone');
		
		if($data['username']){
		$falg = mod_order::add_feedback($data);
				if($falg){
					die("<script> alert('已经收到您的反馈,我们会第一时间跟进处理!');parent.location.href='/'; </script>");
				}
		}
        
        $tpl     = 'index/feedback.tpl';
        $content = tpl::fetch($tpl);
        exit($content);
    }





    public function gzh(){

        echo ceil(1);

        $tpl     = 'index/gzh.tpl';
        $content = tpl::fetch($tpl);
        exit($content);
    }
	
    public function about()
    {
		
		$tpl     = 'index/about.tpl';
		$content = tpl::fetch($tpl);
        exit($content);
		
    }
	
    public function contact()
    {
		
		$tpl     = 'index/contact.tpl';
		$content = tpl::fetch($tpl);
        exit($content);
		
    }
	
}
