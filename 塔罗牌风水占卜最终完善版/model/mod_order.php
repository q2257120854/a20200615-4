<?php
if (!defined('CORE')) {
	exit('Request Error!');
}

class mod_order {


    /***
     * @param $type
     * 生成订单单号
     */
    public static function createoid($type){
        $oid = ''.$type.date('YmdH').time().rand(1,999);
        return $oid;
    }


    /***
     * 转换日期
     * 旧历转新历
     * 格式
     * 2017年正月十三 05:00-05:59卯时
     */
    public static function datereplace($time){
        $yue1 = array('正月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月');
        $yue2 = array('1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月');

        $ri1 = array('初一','初二','初三','初四','初五','初六','初七','初八','初九','初十','十一','十二','十三','十四','十五','十六','十七','十八','十九','二十','廿一','廿二','廿三','廿四','廿五','廿六','廿七','廿八','廿九','三十','三十一');
        $ri2 = array('1日','2日','3日','4日','5日','6日','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');

        return $time;

    }

    /***
     * @param $data
     * @return string
     * 根据type生成标题
     */
    public static function makeordertitle($data){

        $title = '八字合婚';

        if($data['type']=='1'){
            $title = $data['username'].'的八字精批';
        }elseif($data['type']=='2'){
            $title = $data['xing'].$data['username'].'的姓名祥批';
        }elseif($data['type']=='3'){
            $title = $data['malexing'].$data['malename'].'与'.$data['femalexing'].$data['femalename'].'的姓名配对';
        }elseif($data['type']=='4'){
            $title = $data['username'].'与'.$data['girl_username'].'的八字合婚';
        }elseif($data['type']=='5'){
            $title = $data['username'].'的年度运势';
        }elseif($data['type']=='6'){
            $title = $data['username'].'的八字事业运';
        }elseif($data['type']=='7'){
            $title = $data['username'].'的姻缘分析';
        }elseif($data['type']=='8'){
            $title = $data['username'].'的综合分析';
        }elseif($data['type']=='9'){
            $title = $data['username'].'的紫微斗数精批';
        }elseif($data['type']=='10'){
            $title = $data['username'].'的号码吉凶';
        }elseif($data['type']=='11'){
            $title = $data['username'].'的星座命盘详解';
        }elseif($data['type']=='13'){
            $title = $data['username'].'的2019年星座运势';
        }elseif($data['type']=='14'){
            $title = $data['username'].'的未来运势大揭秘塔罗牌';
        }elseif($data['type']=='15'){
            $title = $data['username'].'的你暗恋的人喜欢你吗';
        }elseif($data['type']=='16'){
            $title = $data['username'].'TA心里有没有你测算';
        }elseif($data['type']=='17'){
            $title = $data['username'].'和他该继续走下去吗';
        }elseif($data['type']=='18'){
            $title = $data['username'].'感情运势大揭秘';
        }elseif($data['type']=='19'){
            $title = $data['username'].'三个月内能脱单吗';
        }

        return $title;
    }

	public static function add_order($data) {


        preg_match('/t([\d]*)\./is',$_SERVER['HTTP_HOST'],$do);
        $cpid = empty($do[1])? 1 : $do[1];
		
	    //整理数据
        $orders['oid'] = $data['oid'];
        $orders['type'] = $data['type'];
        $orders['data'] = urlencode(json_encode($data['datas']));
        $orders['cp'] = $cpid;
        $orders['money'] = $data['money'];

        $orders['des'] = self::makeordertitle($data);
        $orders['createtime'] = date('Y-m-d H:i:s');
        $orders['ip'] = util::get_client_ip();


		$reo = db::ins('ffsm_orders', $orders);
        self::set_history($data['oid']);
		return $reo;
	}
	public static function get_order($id) {
		$oinfo = db::query_f("select * from `ffsm_orders` where oid='$id'");
		return $oinfo;
    }

    public static function add_feedback($data) {
                $reo = db::ins('ffsm_feedback', $data);
                        return $reo;
                    }

	public static function up_order($data, $where) {
		return db::up('ffsm_orders', $data, $where);
	}


	public static function set_history($oid){

	    $history = self::get_history();
        if($history==''){
            $cookies=array('ord_history'=>array($oid));
            $cookies_s=json_encode($cookies);
            setCookie('ord_history',$cookies_s);
        }else{
            if(!in_array($oid,$history)){
                $new_history = array_merge($history,array($oid));
                $cookies=array('ord_history'=>$new_history);
                $cookies_s=json_encode($cookies);
                setCookie('ord_history',$cookies_s);
            }
        }
        return true;

    }


	public static function get_history(){
		if(isset($_COOKIE['ord_history'])){
			$history = $_COOKIE['ord_history'];
		}else{
			$history = '';
		}
        
		
        if(empty($history)){
            return '';
        }
        $history=json_decode(str_replace('\"','"',$history),true);
        return $history['ord_history'];

    }
	/***
     *内容页分页
	*/

    public static function typetochannel($type){
        if($type==1){
            $ac = 'bzjp';
        }elseif($type==2){
            $ac = 'xmfx';
        }elseif($type==3){
            $ac = 'xmpd';
        }elseif($type==4){
            $ac = 'hehun';
        }elseif($type==5){
            $ac = 'yuncheng';
        }elseif($type==6){
            $ac = 'bzsy';
        }elseif($type==7){
            $ac = 'yinyuan';
        }elseif($type==8){
            $ac = 'bazi';
        }elseif($type==9){
            $ac = 'ziwei';
        }elseif($type==10){
            $ac = 'hmjx';
        }elseif($type==11){
            $ac = 'zhanxing';
        }elseif($type==13){
            $ac = 'xingzuo2019';
        }elseif($type==14){
            $ac = 'taluoyunshi';
        }elseif($type==15){
            $ac = 'taluoanlian';
        }elseif($type==16){
            $ac = 'taluoxinli';
        }elseif($type==17){
            $ac = 'taluojixu';
        }elseif($type==18){
            $ac = 'taluoaiqing';
        }elseif($type==19){
            $ac = 'taluotuodan';
        }

        return $ac;
    }


}
