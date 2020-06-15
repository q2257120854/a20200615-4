<?php
namespace App\Http\Controllers;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LpController extends Controller
{
	//软件取TOKEN
	public function token($appid){
		if($appid){
			if(isset($_POST['pwd'])){
				if($_POST['pwd']!=""){
					$results = DB::table('lpapi')->where('apiid', $appid)->first();
					if($results){
						if($results->apipwd==$_POST['pwd']){
							if($results->dqtime>=time()){
								if(isset($_POST['stop']) and isset($_POST['type'])){
									if(!empty($_POST['mail'])){
										$mail = DB::table('users')->where('lpapi',$appid)->pluck('email')->first();
										$ch = curl_init();
										curl_setopt($ch, CURLOPT_URL, '邮件通知接口?s='.$mail.'&t='.$_POST['type']);
										curl_exec($ch);
										curl_close($ch);
									}
									if($_POST['type']=='alipay'){
										$results = DB::table('lpapi')->where('id', $results->id)->update(['zfbt' => 0]);
										if($results){
											return response()->json(
												[
										            'error' => '0',
										            'msg' => '支付宝收款停止成功'
										        ]
											);
										}else{
											return response()->json(
												[
										            'error' => '8',
										            'msg' => '支付宝收款停止失败,请手动点击顶部按钮再次开启'
										        ]
											);
										}
									}else if($_POST['type']=='wxpay'){
										if($results->type<1){
											return response()->json(
												[
										            'error' => '9',
										            'msg' => '您的API属于AliPay单独版,无法正常使用专业版服务,如需使用专业版请先前往L Pays控制面板,详见顶部红色提示!'
										        ]
											);
										}
										$results = DB::table('lpapi')->where('id', $results->id)->update(['wxt' => 0]);
										if($results){
											return response()->json(
												[
										            'error' => '0',
										            'msg' => '微信收款停止成功'
										        ]
											);
										}else{
											return response()->json(
												[
										            'error' => '8',
										            'msg' => '微信收款停止失败,请手动点击顶部按钮再次开启'
										        ]
											);
										}
									}else if($_POST['type']=='qqpay'){
										if($results->type<1){
											return response()->json(
												[
										            'error' => '9',
										            'msg' => '您的API属于AliPay单独版,无法正常使用专业版服务,如需使用专业版请先前往L Pays控制面板,详见顶部红色提示!'
										        ]
											);
										}
										$results = DB::table('lpapi')->where('id', $results->id)->update(['qqt' => 0]);
										if($results){
											return response()->json(
												[
										            'error' => '0',
										            'msg' => 'QQ收款停止成功'
										        ]
											);
										}else{
											return response()->json(
												[
										            'error' => '8',
										            'msg' => 'QQ收款停止失败,请手动点击顶部按钮再次开启'
										        ]
											);
										}
									}
								}else if(isset($_POST['s']) and isset($_POST['type'])){
									if($_POST['type']=='alipay'){
										//得到支付宝PID
										if(!empty($_POST['zpid'])){
											$results = DB::table('lpapi')->where('id', $results->id)->update([
												'zfbt' => 8,
												'zfbpid' => $_POST['zpid']
											]);
										}else{
											$results = DB::table('lpapi')->where('id', $results->id)->update([
												'zfbt' => 8,
												'zfbpid' => NULL
											]);
										}
										//
										if($results){
											return response()->json(
												[
										            'error' => '0',
										            'msg' => '开启支付宝收款成功'
										        ]
											);
										}else{
											return response()->json(
												[
										            'error' => '8',
										            'msg' => '开启支付宝收款失败,请手动点击顶部按钮再次开启'
										        ]
											);
										}
									}else if($_POST['type']=='wxpay'){
										if($results->type<1){
											return response()->json(
												[
										            'error' => '9',
										            'msg' => '您的API属于AliPay单独版,无法正常使用专业版服务,如需使用专业版请先前往L Pays控制面板,详见顶部红色提示!'
										        ]
											);
										}
										$results = DB::table('lpapi')->where('id', $results->id)->update(['wxt' => 8]);
										if($results){
											return response()->json(
												[
										            'error' => '0',
										            'msg' => '开启微信收款成功'
										        ]
											);
										}else{
											return response()->json(
												[
										            'error' => '8',
										            'msg' => '开启微信收款失败,请手动点击顶部按钮再次开启'
										        ]
											);
										}
									}else if($_POST['type']=='qqpay'){
										if($results->type<1){
											return response()->json(
												[
										            'error' => '9',
										            'msg' => '您的API属于AliPay单独版,无法正常使用专业版服务,如需使用专业版请先前往L Pays控制面板,详见顶部红色提示!'
										        ]
											);
										}
										$results = DB::table('lpapi')->where('id', $results->id)->update(['qqt' => 8]);
										if($results){
											return response()->json(
												[
										            'error' => '0',
										            'msg' => 'QQ开启收款成功'
										        ]
											);
										}else{
											return response()->json(
												[
										            'error' => '8',
										            'msg' => 'QQ开启收款失败,请手动点击顶部按钮再次开启'
										        ]
											);
										}
									}
								}else{
									$token = md5(time().$appid.'maddog');
									$ts = $results->type;
									$results = DB::table('lpapi')->where('id', $results->id)->update(['apitoken' => $token]);
									if($results){
										return response()->json(
											[
									            'error' => '0',
									            'token' => $token,
									            'vip' => $ts
									        ]
										);
									}else{
										return response()->json(
											[
									            'error' => '3',
									            'token' => '获取Token失败,请再次获取！'
									        ]
										);
									}
								}
							}else{
								return response()->json(
									[
							            'error' => '8',
							            'msg' => '您的API服务已过期,如需继续使用,请尽快续费'
							        ]
								);
							}
						}else{
							return response()->json(
							[
					            'error' => '1',
					            'msg' => 'ID密码错误'
					        ]
						);
						}
					}else{
						return response()->json(
							[
					            'error' => '2',
					            'msg' => '不存在此ID'
					        ]
						);
					}
				}else{
					return response()->json(
						[
				            'error' => '1',
				            'msg' => 'ID密码错误'
				        ]
					);
				}
			}else{
				return response()->json(
					[
			            'error' => '1',
			            'msg' => 'ID密码错误'
			        ]
				);
			}
		}else{
			return response()->json(
				[
		            'error' => '-1',
		            'token' => '空数据'
		        ]
			);
		}
	}
	//软件加入订单数据
	public function entry($token){
		if($token){
			$results = DB::table('lpapi')->where('apitoken', $token)->first();
			if($results){
				if($results->dqtime>=time()){
					if(isset($_POST['lt']) and $_POST['lt']=='wx'){
						if($results->type<1){
							return response()->json(
								[
						            'error' => '9',
						            'msg' => '您的API属于AliPay单独版,无法正常使用专业版服务,如需使用专业版请先前往L Pays控制面板,详见顶部红色提示!'
						        ]
							);
						}
						if(isset($_POST['tradeNo']) and $_POST['tradeNo']){
							if(isset($_POST['tradeAmount']) and $_POST['tradeAmount']){
								if(isset($_POST['goodsTitle']) and $_POST['goodsTitle']){
									$appid = $results->apiid;
									$pwd = $results->apipwd;
									$tradeNo = $this->rc4b($pwd,$_POST['tradeNo']);
									$tradeAmount = $this->rc4b($pwd,$_POST['tradeAmount']);
									$tradeTime = date("Y-m-d H:i:s",$tradeNo);
									$goodsTitle = iconv("gb2312","utf-8//IGNORE",$this->rc4b($pwd,$_POST['goodsTitle']));
									$results = DB::table('wx')->where('tradeNo', $tradeNo)->first();
									if($results){
										return response()->json(
											[
									            'error' => '7',
									            'msg' => '此微信订单已存在,将自动忽略'
									        ]
										);
									}else{
										$win =  DB::table('wxs')->where([
											['appid', '=', $appid],
											['income', '=', $tradeAmount],
											['time', '>=', time()]
										])
										->whereNull('state')
										->first();
										if($win){
											$update = DB::table('wxs')->where('id', $win->id)->update(['state' => '8']);
											$row = DB::insert('insert into wx (appid, tradeNo, tradeAmount, tradeTime, goodsTitle, dh) values (?, ?, ?, ?, ?, ?)', [$appid,$tradeNo, $tradeAmount, $tradeTime, $goodsTitle, $win->dh]);
											if($row){
												return response()->json(
													[
											            'error' => '0',
											            'tradeNo' => $tradeNo,
											            'tradeAmount' => $tradeAmount,
											            'tradeTime' => $tradeTime,
											            'goodsTitle' => $goodsTitle,
											            'msg' => '记录收款信息成功',
											            'gu' => $win->gu
											        ]
												);
											}else{
												return response()->json(
													[
											            'error' => '6',
											            'msg' => '记录收款信息失败,将在下一次再次记录'
											        ]
												);
											}
										}else{
											$row = DB::insert('insert into wx (appid, tradeNo, tradeAmount, tradeTime, goodsTitle, dh) values (?, ?, ?, ?, ?, ?)', [$appid,$tradeNo, $tradeAmount, $tradeTime, $goodsTitle, '']);
											if($row){
												return response()->json(
													[
											            'error' => '0',
											            'tradeNo' => $tradeNo,
											            'tradeAmount' => $tradeAmount,
											            'tradeTime' => $tradeTime,
											            'goodsTitle' => $goodsTitle,
											            'msg' => '记录收款信息成功'
											        ]
												);
											}else{
												return response()->json(
													[
											            'error' => '6',
											            'msg' => '记录收款信息失败,将在下一次再次记录'
											        ]
												);
											}
										}
									}
								}else{
									return response()->json(
										[
								            'error' => '5',
								            'msg' => 'goodsTitle无效'
								        ]
									);
								}
							}else{
								return response()->json(
									[
							            'error' => '3',
							            'msg' => 'tradeAmount无效'
							        ]
								);
							}
						}else{
							return response()->json(
								[
						            'error' => '2',
						            'msg' => 'tradeNo无效'
						        ]
							);
						}
					}else if(isset($_POST['lt']) and $_POST['lt']=='qq'){
						if($results->type<1){
							return response()->json(
								[
						            'error' => '9',
						            'msg' => '您的API属于AliPay单独版,无法正常使用专业版服务,如需使用专业版请先前往L Pays控制面板,详见顶部红色提示!'
						        ]
							);
						}
						if(isset($_POST['tradeNo']) and $_POST['tradeNo']){
							if(isset($_POST['tradeAmount']) and $_POST['tradeAmount']){
								if(isset($_POST['tradeTime']) and $_POST['tradeTime']){
									if(isset($_POST['qqn']) and $_POST['qqn']){
										$appid = $results->apiid;
										$pwd = $results->apipwd;
										$tradeNo = $this->rc4b($pwd,$_POST['tradeNo']);
										$tradeAmount = $this->rc4b($pwd,$_POST['tradeAmount']);
										$tradeTime = $this->rc4b($pwd,$_POST['tradeTime']);
										$qqn = (int)$this->rc4b($pwd,$_POST['qqn']);
										$results = DB::table('qq')->where('tradeNo', $tradeNo)->first();
										if($results){
											return response()->json(
												[
										            'error' => '7',
										            'msg' => '此QQ订单已存在,将自动忽略'
										        ]
											);
										}else{
											$win =  DB::table('qqs')->where([
												['appid', '=', $appid],
												['income', '=', $tradeAmount],
												['time', '>=', time()]
											])
											->whereNull('state')
											->first();
											if($win){
												$update = DB::table('qqs')->where('id', $win->id)->update(['state' => '8']);
												$row = DB::insert('insert into qq (appid, tradeNo, tradeAmount, tradeTime, qqn, dh) values (?, ?, ?, ?, ?, ?)', [$appid,$tradeNo, $tradeAmount, $tradeTime, $qqn, $win->dh]);
												if($row){
													return response()->json(
														[
												            'error' => '0',
												            'tradeNo' => $tradeNo,
												            'tradeAmount' => $tradeAmount,
												            'tradeTime' => $tradeTime,
												            'qqn' => $qqn,
												            'msg' => '记录收款信息成功',
											            	'gu' => $win->gu
												        ]
													);
												}else{
													return response()->json(
														[
												            'error' => '6',
												            'msg' => '记录收款信息失败,将在下一次再次记录'
												        ]
													);
												}
											}else{
												$row = DB::insert('insert into qq (appid, tradeNo, tradeAmount, tradeTime, qqn, dh) values (?, ?, ?, ?, ?, ?)', [$appid,$tradeNo, $tradeAmount, $tradeTime, $qqn, '']);
												if($row){
													return response()->json(
														[
												            'error' => '0',
												            'tradeNo' => $tradeNo,
												            'tradeAmount' => $tradeAmount,
												            'tradeTime' => $tradeTime,
												            'qqn' => $qqn,
												            'msg' => '记录收款信息成功'
												        ]
													);
												}else{
													return response()->json(
														[
												            'error' => '6',
												            'msg' => '记录收款信息失败,将在下一次再次记录'
												        ]
													);
												}
											}
										}
									}else{
										return response()->json(
											[
									            'error' => '5',
									            'msg' => 'qqn无效'
									        ]
										);
									}
								}else{
									return response()->json(
										[
								            'error' => '4',
								            'msg' => 'tradeTime无效'
								        ]
									);
								}
							}else{
								return response()->json(
									[
							            'error' => '3',
							            'msg' => 'tradeAmount无效'
							        ]
								);
							}
						}else{
							return response()->json(
								[
						            'error' => '2',
						            'msg' => 'tradeNo无效'
						        ]
							);
						}
					}else{
						if(isset($_POST['tradeNo']) and $_POST['tradeNo']){
							if(isset($_POST['tradeAmount']) and $_POST['tradeAmount']){
								if(isset($_POST['tradeTime']) and $_POST['tradeTime']){
									if(isset($_POST['goodsTitle']) and $_POST['goodsTitle']){
										$appid = $results->apiid;
										$pwd = $results->apipwd;
										$tradeNo = $this->rc4b($pwd,$_POST['tradeNo']);
										$tradeAmount = $this->rc4b($pwd,$_POST['tradeAmount']);
										$tradeTime = $this->rc4b($pwd,$_POST['tradeTime']);
										$goodsTitle = $this->rc4b($pwd,$_POST['goodsTitle']);
										$encode = mb_detect_encoding($goodsTitle, array('GB2312','GBK'));
								        if($encode == "GB2312"){
								        	$goodsTitle = iconv("gb2312","utf-8//IGNORE",$goodsTitle);
								        }else{
								            $goodsTitle = iconv("gbk","utf-8//IGNORE",$goodsTitle);
								        }
										$results = DB::table('zfb')->where('tradeNo', $tradeNo)->first();
										if($results){
											return response()->json(
												[
										            'error' => '7',
										            'msg' => '此支付宝订单已存在,将自动忽略'
										        ]
											);
										}else{
											$win =  DB::table('zfbs')->where([
												['appid', '=', $appid],
												['income', '=', $tradeAmount],
												['time', '>=', time()]
											])
											->whereNull('state')
											->first();
											if($win){
												$update = DB::table('zfbs')->where('id', $win->id)->update(['state' => '8']);
												$row = DB::insert('insert into zfb (appid, tradeNo, tradeAmount, tradeTime, goodsTitle, dh) values (?, ?, ?, ?, ?, ?)', [$appid,$tradeNo, $tradeAmount, $tradeTime, $goodsTitle, $win->dh]);
												if($row){
													return response()->json(
														[
												            'error' => '0',
												            'tradeNo' => $tradeNo,
												            'tradeAmount' => $tradeAmount,
												            'tradeTime' => $tradeTime,
												            'goodsTitle' => $goodsTitle,
												            'msg' => '记录收款信息成功',
											            	'gu' => $win->gu
												        ]
													);
												}else{
													return response()->json(
														[
												            'error' => '6',
												            'msg' => '记录收款信息失败,将在下一次再次记录'
												        ]
													);
												}
											}else{
												$row = DB::insert('insert into zfb (appid, tradeNo, tradeAmount, tradeTime, goodsTitle, dh) values (?, ?, ?, ?, ?, ?)', [$appid,$tradeNo, $tradeAmount, $tradeTime, $goodsTitle, '']);
												if($row){
													return response()->json(
														[
												            'error' => '0',
												            'tradeNo' => $tradeNo,
												            'tradeAmount' => $tradeAmount,
												            'tradeTime' => $tradeTime,
												            'goodsTitle' => $goodsTitle,
												            'msg' => '记录收款信息成功'
												        ]
													);
												}else{
													return response()->json(
														[
												            'error' => '6',
												            'msg' => '记录收款信息失败,将在下一次再次记录'
												        ]
													);
												}
											}
										}
									}else{
										return response()->json(
											[
									            'error' => '5',
									            'msg' => 'goodsTitle无效'
									        ]
										);
									}
								}else{
									return response()->json(
										[
								            'error' => '4',
								            'msg' => 'tradeTime无效'
								        ]
									);
								}
							}else{
								return response()->json(
									[
							            'error' => '3',
							            'msg' => 'tradeAmount无效'
							        ]
								);
							}
						}else{
							return response()->json(
								[
						            'error' => '2',
						            'msg' => 'tradeNo无效'
						        ]
							);
						}
					}
				}else{
					return response()->json(
						[
				            'error' => '8',
				            'msg' => '您的API服务已过期,如需继续使用,请尽快续费'
				        ]
					);
				}
			}else{
				return response()->json(
					[
			            'error' => '1',
			            'msg' => 'Token无效'
			        ]
				);
			}

		}else{
			return response()->json(
				[
		            'error' => '-1',
		            'msg' => '空数据'
		        ]
			);
		}
	}
	//支付宝创建订单
	public function apost($appid){
		if($appid){
			if(isset($_POST['dh']) and $_POST['dh']){
				if(isset($_POST['income']) and $_POST['income']){
					if(isset($_POST['token'])){
						if($_POST['token']==md5($_POST['dh'].$appid)){
							$results = DB::table('lpapi')->where('apiid', $appid)->first();
							//新增参数
							if(isset($_POST['gu'])){
								$gu = base64_decode($_POST['gu']);
								if(strstr($gu, '?')){
									$gu = $gu.'&dh='.$_POST['dh'].'&ltype='.'alipay';
								}else{
									$gu = $gu.'?dh='.$_POST['dh'].'&ltype='.'alipay';
								}
							}else{
								$gu = "";
							}
							//
							if($results){
								if($results->zfbt==8){
									if($results->dqtime>=time()){
										$s = DB::table('zfbs')->where([
											['appid','=',$appid],
											['dh','=',$_POST['dh']]
										])->exists();
										if($s){
											return response()->json(
												[
										            'error' => '7',
										            'msg' => '订单已付款或已存在,无法再次创建！'
										        ]
											);
										}
										$income = str_replace(",","",number_format($_POST['income'],2));
										$time = $results->gqtime * 60;
										$time = time() + $time;
										$zpid = NULL;
										if(!empty($results->zfbpid) and $results->type>=1){
											$skewm = "alipays://platformapi/startapp?appId=20000123&actionType=scan&biz_data=";
											$zpid = $results->zfbpid;
										}else{
											$skewm = $results->skewm;
										}
										$row =  DB::table('zfbs')->where([
													['appid', '=', $appid],
													['income', '=', $income],
													['time', '>', time()]
												])
												->whereNull('state')
												->first();
										if($row){
											$tt = 0;
											do{
												$tt = $tt+0.01;
												$money = $income+$tt;
												$money = str_replace(",","",number_format($money,2));
												$times = $time;
												$row =  DB::table('zfbs')->where([
													['appid', '=', $appid],
													['income', '=', $money],
													['time', '>', time()]
												])
												->whereNull('state')
												->first();
												if($row){
													if($tt>=0.88){
									        			return response()->json(
															[
													            'error' => '6',
													            'msg' => '创建订单超时,请稍后重试'
													        ]
														);
									        		}
												}else{
													$income = str_replace(",","",number_format($money,2));
													$tt = 0.89;
												}
											}while($tt<0.88);
											$row = DB::insert('insert into zfbs (appid, dh, income, time, gu) values (?, ?, ?, ?, ?)', [$appid,$_POST['dh'], $income, $time, $gu]);
											if($row){
												if(!empty($zpid)){
													$skewm = $skewm.urlencode('{"s":"money","u":"'.$zpid.'","a":"'.$income.'","m":"LP Pro"}');
												}
												if(isset($_POST['md5'])){
													$md5 = md5($_POST['dh'].'maddog'.$appid);
													return response()->json(
														[
												            'error' => '0',
												            'income' => $income,
												            'url' => $skewm,
												            'time' => $time,
												            'token' => $md5
												        ]
													);
												}
												return response()->json(
													[
											            'error' => '0',
											            'income' => $income,
											            'url' => $skewm,
											            'time' => $time
											        ]
												);
											}else{
												return response()->json(
													[
											            'error' => '5',
											            'msg' => '创建订单失败，请稍后重试!'
											        ]
												);
											}
										}else{
											$row = DB::insert('insert into zfbs (appid, dh, income, time, gu) values (?, ?, ?, ?, ?)', [$appid,$_POST['dh'], $income, $time, $gu]);
											if($row){
												if(!empty($zpid)){
													$skewm = $skewm.urlencode('{"s":"money","u":"'.$zpid.'","a":"'.$income.'","m":"LP Pro"}');
												}
												if(isset($_POST['md5'])){
													$md5 = md5($_POST['dh'].'maddog'.$appid);
													return response()->json(
														[
												            'error' => '0',
												            'income' => $income,
												            'url' => $skewm,
												            'time' => $time,
												            'token' => $md5
												        ]
													);
												}
												return response()->json(
													[
											            'error' => '0',
											            'income' => $income,
											            'url' => $skewm,
											            'time' => $time
											        ]
												);
											}else{
												return response()->json(
													[
											            'error' => '5',
											            'msg' => '创建订单失败，请稍后重试!'
											        ]
												);
											}
										}
									}else{
										return response()->json(
											[
									            'error' => '4',
									            'msg' => '您的API服务已过期,如需继续使用,请尽快续费!'
									        ]
										);
									}
								}else{
									return response()->json(
										[
								            'error' => '8',
								            'msg' => '此商户支付宝API未挂起,无法正常付款'
								        ]
									);
								}
							}else{
								return response()->json(
									[
							            'error' => '3',
							            'msg' => '不存在此ID'
							        ]
								);
							}
						}else{
							return response()->json(
								[
						            'error' => '2',
						            'msg' => 'Token错误'
						        ]
							);
						}
					}else{
						return response()->json(
							[
					            'error' => '2',
					            'msg' => 'Token错误'
					        ]
						);
					}
				}else{
					return response()->json(
						[
				            'error' => '1',
				            'msg' => '收入信息错误'
				        ]
					);
				}	
			}else{
				return response()->json(
					[
			            'error' => '1',
			            'msg' => '单号信息错误'
			        ]
				);
			}
		}else{
			return response()->json(
				[
		            'error' => '-1',
		            'token' => '空数据'
		        ]
			);
		}
	}
	//支付宝二次查询订单
	public function acpost($appid){
		if($appid){
			if(isset($_POST['dh']) and $_POST['dh']){
				if(isset($_POST['token'])){
					if($_POST['token']==md5($_POST['dh'].$appid)){
						$results = DB::table('lpapi')->where('apiid', $appid)->first();
						if($results){
							$row = DB::table('zfb')->where([
								['appid', '=', $appid],
								[ 'dh', '=', $_POST['dh']]
							])->first();
							if($row){
								return response()->json(
									[
							            'error' => '6',
							            'msg' => '此订单已支付成功'
							        ]
								);
							}
							if($results->zfbt==8){
								if($results->dqtime>=time()){
									$row = DB::table('zfbs')->where([
										['appid', '=' , $appid],
										['dh', '=' ,$_POST['dh']],
										[ 'time', '>', time()]
									])->first();
									if($row){
										if(!empty($results->zfbpid)){
											$results->skewm = "alipays://platformapi/startapp?appId=20000123&actionType=scan&biz_data=".urlencode('{"s":"money","u":"'.$results->zfbpid.'","a":"'.$row->income.'","m":"LP Pro"}');
										}
										if(isset($_POST['md5'])){
											$md5 = md5($_POST['dh'].'maddog'.$appid);
											return response()->json(
												[
										            'error' => '0',
										            'income' => $row->income,
										            'url' => $results->skewm,
										            'time' => $row->time,
										            'token' => $md5
										        ]
											);
										}
										return response()->json(
											[
									            'error' => '0',
									            'income' => $row->income,
									            'url' => $results->skewm,
									            'time' => $row->time
									        ]
										);
									}else{
										return response()->json(
											[
									            'error' => '5',
									            'msg' => '单号已过期或并不存在'
									        ]
										);
									}
								}else{
									return response()->json(
										[
								            'error' => '4',
								            'msg' => '您的API服务已过期,如需继续使用,请尽快续费!'
								        ]
									);
								}
							}else{
								return response()->json(
									[
							            'error' => '8',
							            'msg' => '此商户支付宝API未挂起,无法正常付款'
							        ]
								);
							}
						}else{
							return response()->json(
								[
						            'error' => '3',
						            'msg' => '不存在此ID'
						        ]
							);
						}
					}else{
						return response()->json(
							[
					            'error' => '2',
					            'msg' => 'Token错误'
					        ]
						);
					}
				}else{
					return response()->json(
						[
				            'error' => '2',
				            'msg' => 'Token错误'
				        ]
					);
				}	
			}else{
				return response()->json(
					[
			            'error' => '1',
			            'msg' => '单号信息错误'
			        ]
				);
			}
		}else{
			return response()->json(
				[
		            'error' => '-1',
		            'token' => '空数据'
		        ]
			);
		}
	}
	//支付宝删除订单
	public function adpost($appid){
		if($appid){
			if(isset($_POST['dh']) and $_POST['dh']){
				if(isset($_POST['token'])){
					if($_POST['token']==md5($_POST['dh'].$appid)){
						$row = DB::table('zfbs')->where([
							['appid', '=' , $appid],
							['dh', '=' ,$_POST['dh']],
							[ 'time', '>', time()]
						])->delete();
						if($row){
							return response()->json(
								[
						            'error' => '0',
						            'msg' => '删除此订单成功'
						        ]
							);
						}else{
							return response()->json(
								[
						            'error' => '5',
						            'msg' => '单号已过期或并不存在'
						        ]
							);
						}
					}else{
						return response()->json(
							[
					            'error' => '2',
					            'msg' => 'Token错误'
					        ]
						);
					}
				}else{
					return response()->json(
						[
				            'error' => '2',
				            'msg' => 'Token错误'
				        ]
					);
				}	
			}else{
				return response()->json(
					[
			            'error' => '1',
			            'msg' => '单号信息错误'
			        ]
				);
			}
		}else{
			return response()->json(
				[
		            'error' => '-1',
		            'token' => '空数据'
		        ]
			);
		}
	}
	//支付宝查询订单状态
	public function acc($appid){
		if($appid){
			if(isset($_POST['dh']) and $_POST['dh']){
				if(isset($_POST['token'])){
					if($_POST['token']==md5($_POST['dh'].$appid)){
						$results = DB::table('zfbs')->where([
							['appid', '=', $appid],
							['dh', '=',  $_POST['dh']],
							['time', '>', time()],
							['state', '=', 8]
						])->first();
						if($results){
							return response()->json(
								[
						            'error' => '0',
						            'msg' => '付款成功'
						        ]
							);
						}else{
							//第二道保险
							$results = DB::table('zfbs')->where([
								['appid', '=', $appid],
								['dh', '=',  $_POST['dh']],
								[ 'time', '>=', time()]
							])->first();
							if($results){
								$rows = DB::table('lpapi')->where('apiid', $appid)->first();
								$tt = $rows->gqtime*60;
								$tt = date('Y-m-d H:i:s',(int)time()-$tt);
								$row = DB::table('zfb')->where([
									['appid', '=', $appid],
									['tradeAmount', '=', $results->income],
									['tradeTime', '>=', $tt],
									[ 'dh', '=', '']
								])->first();
								if($row){
									DB::table('zfbs')->where('id', $results->id)->update(['state' => '8']);
									$results = DB::table('zfb')->where('id', $row->id)->update(['dh' => $results->dh]);
									if($results){
										return response()->json(
											[
									            'error' => '0',
									            'msg' => '付款成功s'
									        ]
										);
									}
								}
							}
							//保险完
							return response()->json(
								[
						            'error' => '3',
						            'msg' => '暂未付款或订单已过期'
						        ]
							);
						}
					}else{
						return response()->json(
							[
					            'error' => '2',
					            'msg' => 'Token错误'
					        ]
						);
					}
				}else{
					return response()->json(
						[
				            'error' => '2',
				            'msg' => 'Token错误'
				        ]
					);
				}	
			}else{
				return response()->json(
					[
			            'error' => '1',
			            'msg' => '单号信息错误'
			        ]
				);
			}
		}else{
			return response()->json(
				[
		            'error' => '-1',
		            'token' => '空数据'
		        ]
			);
		}
	}
	//支付宝查询订单详细
	public function acs($appid){
		if($appid){
			if(isset($_POST['dh']) and $_POST['dh']){
				if(isset($_POST['token'])){
					if($_POST['token']==md5($_POST['dh'].$appid)){
						$results = DB::table('zfb')->where([
							['appid', '=', $appid],
							['dh', '=',  $_POST['dh']]
						])->first();
						if($results){
							$rows = DB::table('lpapi')->where('apiid', $appid)->first();
							$tradeNo = $results->tradeNo;
							$tradeAmount = $results->tradeAmount;
							$tradeTime = $results->tradeTime;
							$goodsTitle = $results->goodsTitle;
							$token = md5($tradeNo.$rows->apipwd.$_POST['dh']);
							return response()->json(
								[
						            'error' => '0',
						            'tradeNo' => $tradeNo,
						            'tradeAmount' => $tradeAmount,
						            'tradeTime' => $tradeTime,
						            'goodsTitle' => $goodsTitle,
						            'token' => $token
						        ]
							);
						}else{
							return response()->json(
								[
						            'error' => '3',
						            'msg' => '无法找到关于此订单的收款信息'
						        ]
							);
						}
					}else{
						return response()->json(
							[
					            'error' => '2',
					            'msg' => 'Token错误'
					        ]
						);
					}
				}else{
					return response()->json(
						[
				            'error' => '2',
				            'msg' => 'Token错误'
				        ]
					);
				}	
			}else{
				return response()->json(
					[
			            'error' => '1',
			            'msg' => '单号信息错误'
			        ]
				);
			}
		}else{
			return response()->json(
				[
		            'error' => '-1',
		            'token' => '空数据'
		        ]
			);
		}
	}
	//微信创建订单
	public function wpost($appid){
		if($appid){
			if(isset($_POST['dh']) and $_POST['dh']){
				if(isset($_POST['income']) and $_POST['income']){
					if(isset($_POST['token'])){
						if($_POST['token']==md5($_POST['dh'].$appid)){
							//新增参数
							if(isset($_POST['gu'])){
								$gu = base64_decode($_POST['gu']);
								if(strstr($gu, '?')){
									$gu = $gu.'&dh='.$_POST['dh'].'&ltype='.'wxpay';
								}else{
									$gu = $gu.'?dh='.$_POST['dh'].'&ltype='.'wxpay';
								}
							}else{
								$gu = "";
							}
							//
							$results = DB::table('lpapi')->where('apiid', $appid)->first();
							if($results){
								if($results->wxt==8){
									if($results->dqtime>=time()){
										if($results->type<1){
											return response()->json(
												[
										            'error' => '9',
										            'msg' => '您的API属于AliPay单独版,无法正常使用专业版服务,如需使用专业版请先前往L Pays控制面板,详见顶部红色提示!'
										        ]
											);
										}
										$s = DB::table('wxs')->where([
											['appid','=',$appid],
											['dh','=',$_POST['dh']]
										])->exists();
										if($s){
											return response()->json(
												[
										            'error' => '7',
										            'msg' => '订单已付款或已存在,无法再次创建！'
										        ]
											);
										}
										$income = str_replace(",","",number_format($_POST['income'],2));
										$time = $results->gqtime * 60;
										$time = time() + $time;
										$skewm = $results->wxskewm;
										$row =  DB::table('wxs')->where([
													['appid', '=', $appid],
													['income', '=', $income],
													['time', '>', time()]
												])
												->whereNull('state')
												->first();
										if($row){
											$tt = 0;
											do{
												$tt = $tt+0.01;
												$money = $income+$tt;
												$money = str_replace(",","",number_format($money,2));
												$times = $time;
												$row =  DB::table('wxs')->where([
													['appid', '=', $appid],
													['income', '=', $money],
													['time', '>', time()]
												])
												->whereNull('state')
												->first();
												if($row){
													if($tt>=0.88){
									        			return response()->json(
															[
													            'error' => '6',
													            'msg' => '创建订单超时,请稍后重试'
													        ]
														);
									        		}
												}else{
													$income = str_replace(",","",number_format($money,2));
													$tt = 0.89;
												}
											}while($tt<0.88);
											$row = DB::insert('insert into wxs (appid, dh, income, time, gu) values (?, ?, ?, ?, ?)', [$appid,$_POST['dh'], $income, $time, $gu]);
											if($row){
												if(isset($_POST['md5'])){
													$md5 = md5($_POST['dh'].'maddog'.$appid);
													return response()->json(
														[
												            'error' => '0',
												            'income' => $income,
												            'url' => $skewm,
												            'time' => $time,
												            'token' => $md5
												        ]
													);
												}
												return response()->json(
													[
											            'error' => '0',
											            'income' => $income,
											            'url' => $skewm,
											            'time' => $time
											        ]
												);
											}else{
												return response()->json(
													[
											            'error' => '5',
											            'msg' => '创建订单失败，请稍后重试!'
											        ]
												);
											}
										}else{
											$row = DB::insert('insert into wxs (appid, dh, income, time, gu) values (?, ?, ?, ?, ?)', [$appid,$_POST['dh'], $income, $time, $gu]);
											if($row){
												if(isset($_POST['md5'])){
													$md5 = md5($_POST['dh'].'maddog'.$appid);
													return response()->json(
														[
												            'error' => '0',
												            'income' => $income,
												            'url' => $skewm,
												            'time' => $time,
												            'token' => $md5
												        ]
													);
												}
												return response()->json(
													[
											            'error' => '0',
											            'income' => $income,
											            'url' => $skewm,
											            'time' => $time
											        ]
												);
											}else{
												return response()->json(
													[
											            'error' => '5',
											            'msg' => '创建订单失败，请稍后重试!'
											        ]
												);
											}
										}
									}else{
										return response()->json(
											[
									            'error' => '4',
									            'msg' => '您的API服务已过期,如需继续使用,请尽快续费!'
									        ]
										);
									}
								}else{
									return response()->json(
										[
								            'error' => '8',
								            'msg' => '此商户微信API未挂起,无法正常付款'
								        ]
									);
								}
							}else{
								return response()->json(
									[
							            'error' => '3',
							            'msg' => '不存在此ID'
							        ]
								);
							}
						}else{
							return response()->json(
								[
						            'error' => '2',
						            'msg' => 'Token错误'
						        ]
							);
						}
					}else{
						return response()->json(
							[
					            'error' => '2',
					            'msg' => 'Token错误'
					        ]
						);
					}
				}else{
					return response()->json(
						[
				            'error' => '1',
				            'msg' => '收入信息错误'
				        ]
					);
				}	
			}else{
				return response()->json(
					[
			            'error' => '1',
			            'msg' => '单号信息错误'
			        ]
				);
			}
		}else{
			return response()->json(
				[
		            'error' => '-1',
		            'token' => '空数据'
		        ]
			);
		}
	}
	//微信二次查询订单
	public function wcpost($appid){
		if($appid){
			if(isset($_POST['dh']) and $_POST['dh']){
				if(isset($_POST['token'])){
					if($_POST['token']==md5($_POST['dh'].$appid)){
						$results = DB::table('lpapi')->where('apiid', $appid)->first();
						if($results){
							$row = DB::table('wx')->where([
								['appid', '=', $appid],
								[ 'dh', '=', $_POST['dh']]
							])->first();
							if($row){
								return response()->json(
									[
							            'error' => '6',
							            'msg' => '此订单已支付成功'
							        ]
								);
							}
							if($results->wxt==8){
								if($results->dqtime>=time()){
									$row = DB::table('wxs')->where([
										['appid', '=' , $appid],
										['dh', '=' ,$_POST['dh']],
										[ 'time', '>', time()]
									])->first();
									if($row){
										if(isset($_POST['md5'])){
											$md5 = md5($_POST['dh'].'maddog'.$appid);
											return response()->json(
												[
										            'error' => '0',
										            'income' => $row->income,
										            'url' => $results->wxskewm,
										            'time' => $row->time,
										            'token' => $md5
										        ]
											);
										}
										return response()->json(
											[
									            'error' => '0',
									            'income' => $row->income,
									            'url' => $results->wxskewm,
									            'time' => $row->time
									        ]
										);
									}else{
										return response()->json(
											[
									            'error' => '5',
									            'msg' => '单号已过期或并不存在'
									        ]
										);
									}
								}else{
									return response()->json(
										[
								            'error' => '4',
								            'msg' => '您的API服务已过期,如需继续使用,请尽快续费!'
								        ]
									);
								}
							}else{
								return response()->json(
									[
							            'error' => '8',
							            'msg' => '此商户微信API未挂起,无法正常付款'
							        ]
								);
							}
						}else{
							return response()->json(
								[
						            'error' => '3',
						            'msg' => '不存在此ID'
						        ]
							);
						}
					}else{
						return response()->json(
							[
					            'error' => '2',
					            'msg' => 'Token错误'
					        ]
						);
					}
				}else{
					return response()->json(
						[
				            'error' => '2',
				            'msg' => 'Token错误'
				        ]
					);
				}	
			}else{
				return response()->json(
					[
			            'error' => '1',
			            'msg' => '单号信息错误'
			        ]
				);
			}
		}else{
			return response()->json(
				[
		            'error' => '-1',
		            'token' => '空数据'
		        ]
			);
		}
	}
	//微信删除订单
	public function wdpost($appid){
		if($appid){
			if(isset($_POST['dh']) and $_POST['dh']){
				if(isset($_POST['token'])){
					if($_POST['token']==md5($_POST['dh'].$appid)){
						$row = DB::table('wxs')->where([
							['appid', '=' , $appid],
							['dh', '=' ,$_POST['dh']],
							[ 'time', '>', time()]
						])->delete();
						if($row){
							return response()->json(
								[
						            'error' => '0',
						            'msg' => '删除此订单成功'
						        ]
							);
						}else{
							return response()->json(
								[
						            'error' => '5',
						            'msg' => '单号已过期或并不存在'
						        ]
							);
						}
					}else{
						return response()->json(
							[
					            'error' => '2',
					            'msg' => 'Token错误'
					        ]
						);
					}
				}else{
					return response()->json(
						[
				            'error' => '2',
				            'msg' => 'Token错误'
				        ]
					);
				}	
			}else{
				return response()->json(
					[
			            'error' => '1',
			            'msg' => '单号信息错误'
			        ]
				);
			}
		}else{
			return response()->json(
				[
		            'error' => '-1',
		            'token' => '空数据'
		        ]
			);
		}
	}
	//微信查询订单状态
	public function wcc($appid){
		if($appid){
			if(isset($_POST['dh']) and $_POST['dh']){
				if(isset($_POST['token'])){
					if($_POST['token']==md5($_POST['dh'].$appid)){
						$results = DB::table('wxs')->where([
							['appid', '=', $appid],
							['dh', '=',  $_POST['dh']],
							['time', '>', time()],
							['state', '=', 8]
						])->first();
						if($results){
							return response()->json(
								[
						            'error' => '0',
						            'msg' => '付款成功'
						        ]
							);
						}else{
							//第二道保险
							$results = DB::table('wxs')->where([
								['appid', '=', $appid],
								['dh', '=',  $_POST['dh']],
								[ 'time', '>=', time()]
							])->first();
							if($results){
								$rows = DB::table('lpapi')->where('apiid', $appid)->first();
								$tt = $rows->gqtime*60;
								$tt = date('Y-m-d H:i:s',(int)time()-$tt);
								$row = DB::table('wx')->where([
									['appid', '=', $appid],
									['tradeAmount', '=', $results->income],
									['tradeTime', '>=', $tt],
									[ 'dh', '=', '']
								])->first();
								if($row){
									DB::table('wxs')->where('id', $results->id)->update(['state' => '8']);
									$results = DB::table('wx')->where('id', $row->id)->update(['dh' => $results->dh]);
									if($results){
										return response()->json(
											[
									            'error' => '0',
									            'msg' => '付款成功s'
									        ]
										);
									}
								}
							}
							//保险完
							return response()->json(
								[
						            'error' => '3',
						            'msg' => '暂未付款或订单已过期'
						        ]
							);
						}
					}else{
						return response()->json(
							[
					            'error' => '2',
					            'msg' => 'Token错误'
					        ]
						);
					}
				}else{
					return response()->json(
						[
				            'error' => '2',
				            'msg' => 'Token错误'
				        ]
					);
				}	
			}else{
				return response()->json(
					[
			            'error' => '1',
			            'msg' => '单号信息错误'
			        ]
				);
			}
		}else{
			return response()->json(
				[
		            'error' => '-1',
		            'token' => '空数据'
		        ]
			);
		}
	}
	//微信查询订单详细
	public function wcs($appid){
		if($appid){
			if(isset($_POST['dh']) and $_POST['dh']){
				if(isset($_POST['token'])){
					if($_POST['token']==md5($_POST['dh'].$appid)){
						$results = DB::table('wx')->where([
							['appid', '=', $appid],
							['dh', '=',  $_POST['dh']]
						])->first();
						if($results){
							$rows = DB::table('lpapi')->where('apiid', $appid)->first();
							$tradeNo = $results->tradeNo;
							$tradeAmount = $results->tradeAmount;
							$tradeTime = $results->tradeTime;
							$goodsTitle = $results->goodsTitle;
							$token = md5($tradeNo.$rows->apipwd.$_POST['dh']);
							return response()->json(
								[
						            'error' => '0',
						            'tradeNo' => $tradeNo,
						            'tradeAmount' => $tradeAmount,
						            'tradeTime' => $tradeTime,
						            'goodsTitle' => $goodsTitle,
						            'token' => $token
						        ]
							);
						}else{
							return response()->json(
								[
						            'error' => '3',
						            'msg' => '无法找到关于此订单的收款信息'
						        ]
							);
						}
					}else{
						return response()->json(
							[
					            'error' => '2',
					            'msg' => 'Token错误'
					        ]
						);
					}
				}else{
					return response()->json(
						[
				            'error' => '2',
				            'msg' => 'Token错误'
				        ]
					);
				}	
			}else{
				return response()->json(
					[
			            'error' => '1',
			            'msg' => '单号信息错误'
			        ]
				);
			}
		}else{
			return response()->json(
				[
		            'error' => '-1',
		            'token' => '空数据'
		        ]
			);
		}
	}
	//QQ创建订单
	public function qpost($appid){
		if($appid){
			if(isset($_POST['dh']) and $_POST['dh']){
				if(isset($_POST['income']) and $_POST['income']){
					if(isset($_POST['token'])){
						if($_POST['token']==md5($_POST['dh'].$appid)){
							//新增参数
							if(isset($_POST['gu'])){
								$gu = base64_decode($_POST['gu']);
								if(strstr($gu, '?')){
									$gu = $gu.'&dh='.$_POST['dh'].'&ltype='.'qqpay';
								}else{
									$gu = $gu.'?dh='.$_POST['dh'].'&ltype='.'qqpay';
								}
							}else{
								$gu = "";
							}
							//
							$results = DB::table('lpapi')->where('apiid', $appid)->first();
							if($results){
								if($results->qqt==8){
									if($results->dqtime>=time()){
										$s = DB::table('qqs')->where([
											['appid','=',$appid],
											['dh','=',$_POST['dh']]
										])->exists();
										if($s){
											return response()->json(
												[
										            'error' => '7',
										            'msg' => '订单已付款或已存在,无法再次创建！'
										        ]
											);
										}
										$income = str_replace(",","",number_format($_POST['income'],2));
										$time = $results->gqtime * 60;
										$time = time() + $time;
										$skewm = $results->qqskewm;
										$row =  DB::table('qqs')->where([
													['appid', '=', $appid],
													['income', '=', $income],
													['time', '>', time()]
												])
												->whereNull('state')
												->first();
										if($row){
											$tt = 0;
											do{
												$tt = $tt+0.01;
												$money = $income+$tt;
												$money = str_replace(",","",number_format($money,2));
												$times = $time;
												$row =  DB::table('qqs')->where([
													['appid', '=', $appid],
													['income', '=', $money],
													['time', '>', time()]
												])
												->whereNull('state')
												->first();
												if($row){
													if($tt>=0.88){
									        			return response()->json(
															[
													            'error' => '6',
													            'msg' => '创建订单超时,请稍后重试'
													        ]
														);
									        		}
												}else{
													$income = str_replace(",","",number_format($money,2));
													$tt = 0.89;
												}
											}while($tt<0.88);
											$row = DB::insert('insert into qqs (appid, dh, income, time, gu) values (?, ?, ?, ?, ?)', [$appid,$_POST['dh'], $income, $time, $gu]);
											if($row){
												if(isset($_POST['md5'])){
													$md5 = md5($_POST['dh'].'maddog'.$appid);
													return response()->json(
														[
												            'error' => '0',
												            'income' => $income,
												            'url' => $skewm,
												            'time' => $time,
												            'token' => $md5
												        ]
													);
												}
												return response()->json(
													[
											            'error' => '0',
											            'income' => $income,
											            'url' => $skewm,
											            'time' => $time
											        ]
												);
											}else{
												return response()->json(
													[
											            'error' => '5',
											            'msg' => '创建订单失败，请稍后重试!'
											        ]
												);
											}
										}else{
											$row = DB::insert('insert into qqs (appid, dh, income, time, gu) values (?, ?, ?, ?, ?)', [$appid,$_POST['dh'], $income, $time, $gu]);
											if($row){
												if(isset($_POST['md5'])){
													$md5 = md5($_POST['dh'].'maddog'.$appid);
													return response()->json(
														[
												            'error' => '0',
												            'income' => $income,
												            'url' => $skewm,
												            'time' => $time,
												            'token' => $md5
												        ]
													);
												}
												return response()->json(
													[
											            'error' => '0',
											            'income' => $income,
											            'url' => $skewm,
											            'time' => $time
											        ]
												);
											}else{
												return response()->json(
													[
											            'error' => '5',
											            'msg' => '创建订单失败，请稍后重试!'
											        ]
												);
											}
										}
									}else{
										return response()->json(
											[
									            'error' => '4',
									            'msg' => '您的API服务已过期,如需继续使用,请尽快续费!'
									        ]
										);
									}
								}else{
									return response()->json(
										[
								            'error' => '8',
								            'msg' => '此商户QQAPI未挂起,无法正常付款'
								        ]
									);
								}
							}else{
								return response()->json(
									[
							            'error' => '3',
							            'msg' => '不存在此ID'
							        ]
								);
							}
						}else{
							return response()->json(
								[
						            'error' => '2',
						            'msg' => 'Token错误'
						        ]
							);
						}
					}else{
						return response()->json(
							[
					            'error' => '2',
					            'msg' => 'Token错误'
					        ]
						);
					}
				}else{
					return response()->json(
						[
				            'error' => '1',
				            'msg' => '收入信息错误'
				        ]
					);
				}	
			}else{
				return response()->json(
					[
			            'error' => '1',
			            'msg' => '单号信息错误'
			        ]
				);
			}
		}else{
			return response()->json(
				[
		            'error' => '-1',
		            'token' => '空数据'
		        ]
			);
		}
	}
	//QQ二次查询订单
	public function qcpost($appid){
		if($appid){
			if(isset($_POST['dh']) and $_POST['dh']){
				if(isset($_POST['token'])){
					if($_POST['token']==md5($_POST['dh'].$appid)){
						$results = DB::table('lpapi')->where('apiid', $appid)->first();
						if($results){
							$row = DB::table('qq')->where([
								['appid', '=', $appid],
								[ 'dh', '=', $_POST['dh']]
							])->first();
							if($row){
								return response()->json(
									[
							            'error' => '6',
							            'msg' => '此订单已支付成功'
							        ]
								);
							}
							if($results->qqt==8){
								if($results->dqtime>=time()){
									$row = DB::table('qqs')->where([
										['appid', '=' , $appid],
										['dh', '=' ,$_POST['dh']],
										[ 'time', '>', time()]
									])->first();
									if($row){
										if(isset($_POST['md5'])){
											$md5 = md5($_POST['dh'].'maddog'.$appid);
											return response()->json(
												[
										            'error' => '0',
										            'income' => $row->income,
										            'url' => $results->qqskewm,
										            'time' => $row->time,
										            'token' => $md5
										        ]
											);
										}
										return response()->json(
											[
									            'error' => '0',
									            'income' => $row->income,
									            'url' => $results->qqskewm,
									            'time' => $row->time
									        ]
										);
									}else{
										return response()->json(
											[
									            'error' => '5',
									            'msg' => '单号已过期或并不存在'
									        ]
										);
									}
								}else{
									return response()->json(
										[
								            'error' => '4',
								            'msg' => '您的API服务已过期,如需继续使用,请尽快续费!'
								        ]
									);
								}
							}else{
								return response()->json(
									[
							            'error' => '8',
							            'msg' => '此商户QQAPI未挂起,无法正常付款'
							        ]
								);
							}
						}else{
							return response()->json(
								[
						            'error' => '3',
						            'msg' => '不存在此ID'
						        ]
							);
						}
					}else{
						return response()->json(
							[
					            'error' => '2',
					            'msg' => 'Token错误'
					        ]
						);
					}
				}else{
					return response()->json(
						[
				            'error' => '2',
				            'msg' => 'Token错误'
				        ]
					);
				}	
			}else{
				return response()->json(
					[
			            'error' => '1',
			            'msg' => '单号信息错误'
			        ]
				);
			}
		}else{
			return response()->json(
				[
		            'error' => '-1',
		            'token' => '空数据'
		        ]
			);
		}
	}
	//QQ删除订单
	public function qdpost($appid){
		if($appid){
			if(isset($_POST['dh']) and $_POST['dh']){
				if(isset($_POST['token'])){
					if($_POST['token']==md5($_POST['dh'].$appid)){
						$row = DB::table('qqs')->where([
							['appid', '=' , $appid],
							['dh', '=' ,$_POST['dh']],
							[ 'time', '>', time()]
						])->delete();
						if($row){
							return response()->json(
								[
						            'error' => '0',
						            'msg' => '删除此订单成功'
						        ]
							);
						}else{
							return response()->json(
								[
						            'error' => '5',
						            'msg' => '单号已过期或并不存在'
						        ]
							);
						}
					}else{
						return response()->json(
							[
					            'error' => '2',
					            'msg' => 'Token错误'
					        ]
						);
					}
				}else{
					return response()->json(
						[
				            'error' => '2',
				            'msg' => 'Token错误'
				        ]
					);
				}	
			}else{
				return response()->json(
					[
			            'error' => '1',
			            'msg' => '单号信息错误'
			        ]
				);
			}
		}else{
			return response()->json(
				[
		            'error' => '-1',
		            'token' => '空数据'
		        ]
			);
		}
	}
	//QQ查询订单状态
	public function qcc($appid){
		if($appid){
			if(isset($_POST['dh']) and $_POST['dh']){
				if(isset($_POST['token'])){
					if($_POST['token']==md5($_POST['dh'].$appid)){
						$results = DB::table('qqs')->where([
							['appid', '=', $appid],
							['dh', '=',  $_POST['dh']],
							['time', '>', time()],
							['state', '=', 8]
						])->first();
						if($results){
							return response()->json(
								[
						            'error' => '0',
						            'msg' => '付款成功'
						        ]
							);
						}else{
							//第二道保险
							$results = DB::table('qqs')->where([
								['appid', '=', $appid],
								['dh', '=',  $_POST['dh']],
								[ 'time', '>=', time()]
							])->first();
							if($results){
								$rows = DB::table('lpapi')->where('apiid', $appid)->first();
								$tt = $rows->gqtime*60;
								$tt = date('Y-m-d H:i:s',(int)time()-$tt);
								$row = DB::table('qq')->where([
									['appid', '=', $appid],
									['tradeAmount', '=', $results->income],
									['tradeTime', '>=', $tt],
									[ 'dh', '=', '']
								])->first();
								if($row){
									DB::table('qqs')->where('id', $results->id)->update(['state' => '8']);
									$results = DB::table('qq')->where('id', $row->id)->update(['dh' => $results->dh]);
									if($results){
										return response()->json(
											[
									            'error' => '0',
									            'msg' => '付款成功s'
									        ]
										);
									}
								}
							}
							//保险完
							return response()->json(
								[
						            'error' => '3',
						            'msg' => '暂未付款或订单已过期'
						        ]
							);
						}
					}else{
						return response()->json(
							[
					            'error' => '2',
					            'msg' => 'Token错误'
					        ]
						);
					}
				}else{
					return response()->json(
						[
				            'error' => '2',
				            'msg' => 'Token错误'
				        ]
					);
				}	
			}else{
				return response()->json(
					[
			            'error' => '1',
			            'msg' => '单号信息错误'
			        ]
				);
			}
		}else{
			return response()->json(
				[
		            'error' => '-1',
		            'token' => '空数据'
		        ]
			);
		}
	}
	//QQ查询订单详细
	public function qcs($appid){
		if($appid){
			if(isset($_POST['dh']) and $_POST['dh']){
				if(isset($_POST['token'])){
					if($_POST['token']==md5($_POST['dh'].$appid)){
						$results = DB::table('qq')->where([
							['appid', '=', $appid],
							['dh', '=',  $_POST['dh']]
						])->first();
						if($results){
							$rows = DB::table('lpapi')->where('apiid', $appid)->first();
							$tradeNo = $results->tradeNo;
							$tradeAmount = $results->tradeAmount;
							$tradeTime = $results->tradeTime;
							$qqn = $results->qqn;
							$token = md5($tradeNo.$rows->apipwd.$_POST['dh']);
							return response()->json(
								[
						            'error' => '0',
						            'tradeNo' => $tradeNo,
						            'tradeAmount' => $tradeAmount,
						            'tradeTime' => $tradeTime,
						            'qqn' => $qqn,
						            'token' => $token
						        ]
							);
						}else{
							return response()->json(
								[
						            'error' => '3',
						            'msg' => '无法找到关于此订单的收款信息'
						        ]
							);
						}
					}else{
						return response()->json(
							[
					            'error' => '2',
					            'msg' => 'Token错误'
					        ]
						);
					}
				}else{
					return response()->json(
						[
				            'error' => '2',
				            'msg' => 'Token错误'
				        ]
					);
				}	
			}else{
				return response()->json(
					[
			            'error' => '1',
			            'msg' => '单号信息错误'
			        ]
				);
			}
		}else{
			return response()->json(
				[
		            'error' => '-1',
		            'token' => '空数据'
		        ]
			);
		}
	}
	//rc4加密
	public function rc4 ($pwd, $data) {
	    $key = [];
	    $box = []; 
	    $pwd_length = strlen($pwd);
	    $data_length = strlen($data);  
	    for ($i = 0; $i < 256; $i++) {
	    	$key[$i] = ord($pwd[$i % $pwd_length]);
	    	$box[$i] = $i;
	    }  
	    for ($j = $i = 0; $i < 256; $i++) {
	    	$j = ($j + $box[$i] + $key[$i]) % 256;
	    	$tmp = $box[$i];
	    	$box[$i] = $box[$j];
	    	$box[$j] = $tmp;
	    }  
	    for ($a = $j = $i = 0; $i < $data_length; $i++) {
	    	$a = ($a + 1) % 256;
	    	$j = ($j + $box[$a]) % 256;  
	    	$tmp = $box[$a];
	    	$box[$a] = $box[$j];
	    	$box[$j] = $tmp;  
	    	$k = $box[(($box[$a] + $box[$j]) %256)];
	    	@$cipher .= chr(ord($data[$i]) ^ $k);  
	    }  
	    return $cipher;  
	}
	//rc4转换函数
	public function strToHex($string){   
	    return substr(chunk_split(bin2hex($string)),0,-2);
	}
	//rc4加密
	public function rc4a($key,$string){
		return $this->strToHex($this->rc4($key,$string));   
	}
	//rc4解密
	public function rc4b($key,$string){
		return @$this->rc4($key,pack('H*',$string));  
	}
}