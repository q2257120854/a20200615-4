<?php

namespace WY\app;
class Config{
	static function db(){
		return array(
			'server'=>'127.0.0.1',
			'port'=>'3306',
			'user'=>'lanrenzhijia.com',
			'pass'=>'lanrenzhijia.com',
			'name'=>'lanrenzhijia.com',
			'prefix'=>'wy_',
			'driver'=>'pdo',
			'debug'=>true,
			'path'=>'dy',		//设置后台目录名称
		);
	}

	public function shipCycle($st=false){
		$ships=array(
			0=>'T+0',
			1=>'T+1',
			7=>'T+7',
		);
		return $st===false ? $ships : $ships[$st];
	}


	public function shipType($st=false){
		$ships=array(
			0=>'平台结算',
			1=>'商户提现',
		);
		return $st===false ? $ships : $ships[$st];
	}

	public function billState($st=false){
		$bills=array(
			0=>'待处理',
			1=>'已付款',
			2=>'已冻结',
			3=>'已拒绝',
		);
		return $st===false ? $bills : $bills[$st];
	}

	public function shipBank(){
		return array(
			'工商银行',
			'农业银行',
			'建设银行',
			'中国银行',
		);
	}

	public function cfoBank($code=''){
		$banklist=array(
			'BOC'=>'中国银行',
			'ICBC'=>'工商银行',
			'ABC'=>'农业银行',
			'BOCOM'=>'交通银行',
			'GDB'=>'广东发展银行',
			'SDB'=>'深圳发展银行',
			'CCB'=>'建设银行',
			'SPDB'=>'上海浦东发展银行',
			'ZJTLCB'=>'浙江泰隆商业银行',
			'CMB'=>'招商银行',
			'CMBC'=>'中国民生银行',
			'CIB'=>'兴业银行',
			'CITIC'=>'中信银行',
			'HXB'=>'华夏银行',
			'CEB'=>'中国光大银行',
			'BCCB'=>'北京银行',
			'BOS'=>'上海银行',
			'TCCB'=>'天津银行',
			'BODL'=>'大连银行',
			'HCCB'=>'杭州银行',
			'NBCB'=>'宁波银行',
			'XMCCB'=>'厦门银行',
			'GZCB'=>'广州银行',
			'PINAN'=>'平安银行',
			'CZB'=>'浙商银行',
			'SRCB'=>'上海农村商业银行',
			'CQCB'=>'重庆银行',
			'PSBC'=>'中国邮政储蓄银行',
			'JSB'=>'江苏银行',
			'BJRCB'=>'北京农村商业银行',
			'JNB'=>'济宁银行',
			'TZB'=>'台州银行',
		);
		if($code){
			if(array_key_exists($code,$banklist)){
				return $banklist[$code];
			} else {
				return '';
			}
		}
		return $banklist;
	}

	public function getMailTpl(){
		return array(
			'注册确认','修改密码','付款通知','提现通知','账号审核','找回密码'
		);
	}

	public function retMsg($code){
		$rets=array(
			'001'=>'商户不存在',
			'002'=>'商户账号未审核',
			'003'=>'商户账号已停用',
			'004'=>'商户网站未绑定',
			'100'=>'该通道维护中,临时关闭,请使用其它通道或联系在线客服',
			'101'=>'商户通道不存在',
			'102'=>'平台通道维护中,临时关闭,请使用其它通道或联系在线客服',
			'103'=>'平台通道不存在',
			'104'=>'商户通道功能未开通,请联系客服开通',
			'105'=>'商户收银台功能未开通',
			'106'=>'支付方式不存在',
			'200'=>'参数不完整',
			'201'=>'Sign验证失败',
			'202'=>'订单金额格式错误',
			'203'=>'订单号长度超过限制(50)',
			'204'=>'备注信息长度超过限制(50)',
			'205'=>'订单号已存在',
			'206'=>'交易网址错误',
			'207'=>'金额超过限定额',
			'208'=>'非法空值',
			'209'=>'订单提交失败',
			'210'=>'订单提交失败',
			'211'=>'订单提交失败',
			'212'=>'订单提交失败',
			'213'=>'订单信息不存在',
			'214'=>'订单提交失败',
			'215'=>'订单已付款',
			'216'=>'订单已关闭',
			'217'=>'订单30分钟内未付款，已关闭',
			'300'=>'同一张卡号提交多次',
			'301'=>'点卡面值错误',
			'302'=>'卡密提交成功',
			'303'=>'卡密已被使用',
			'304'=>'卡面值金额不能小于订单金额',
			'305'=>'充值卡号长度错误',
			'306'=>'充值卡密长度错误',
			'400'=>'其他',
			'500'=>'网关不存在',
			'501'=>'空的银行编号',
			'502'=>'银行接口维护',
			'503'=>'非法的银行编号',
		);
		return array_key_exists($code,$rets) ? $rets[$code] : '意外错误';
	}
}
?>
