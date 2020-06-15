<?php
	namespace App\Http\Controllers;
	use app\Edlm\edlm;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Support\Facades\Auth;
	class OpensController extends Controller
	{
		public function open()
		{
			if(isset($_GET['st'])){
				$st = $_GET['st'];
				if($st==='lp' and !empty($_GET['mds'])){
					$id = (int)$_GET['mds'];
					if(isset($_GET['dh']) and $_GET['dh'] and isset($_GET['ltype']) and $_GET['ltype']){
						if($_GET['ltype']=="alipay" or $_GET['ltype']=="wxpay" or $_GET['ltype']=="qqpay"){
							$gqdd = DB::table('gqdd')->where('dh', $_GET['dh'])->first();
							if($gqdd){
								return '重复提交';
							}else{
								$edlm = new Edlm;
								if($_GET['ltype']=='alipay'){
    	                            $rows = $edlm->acs("站长的APPID",$_GET['dh']);
    	                            $rows = json_decode($rows);
								}elseif($_GET['ltype']=='wxpay'){
    	                            $rows = $edlm->wcs("站长的APPID",$_GET['dh']);
    	                            $rows = json_decode($rows);
								}else{
    	                            $rows = $edlm->qcs("站长的APPID",$_GET['dh']);
    	                            $rows = json_decode($rows);
								}
								if($rows and $rows->{'error'}==0){
									$token = md5($rows->{'tradeNo'}."站长的APPPWD".$_GET['dh']);
									if($rows->{'token'}!=$token){
										return '如果没有猜错,你在尝试破解,有兴趣加入我们吗？如果猜错,很抱歉,验证收款信息出错。';
									}else{
										$lpapi = md5($id.time().'maddog');
                                        $lpawd = md5($lpapi.$id);
                                        $time = strtotime("+30 day");
                                        //
										if($rows->{'tradeAmount'}>=8 and $rows->{'tradeAmount'}<20){
											$row = DB::insert('insert into gqdd (dh, time) values (?, ?)', [$_GET['dh'], time()]);
											if($row){
												$lpid = DB::table('users')->where('id',$id)->pluck('lpapi')->first();
												if($lpid){
													$s = DB::table('lpapi')->where('apiid',$lpid)->pluck('dqtime')->first();
													if($s>=time()){
														$dqtime = strtotime("+30 day",$s);
													}else{
														$dqtime = strtotime("+30 day");
													}
													DB::table('lpapi')->where('apiid',$lpid)->update([
														'type' => 0,
														'dqtime' => $dqtime
													]);
													return '续费成功';
												}else{
													DB::table('users')->where('id', $id)->update(['lpapi' => $lpapi]);
		                                        	DB::insert('insert into lpapi (apiid, apipwd, type, dqtime) values (?, ?, ?, ?)', [$lpapi,$lpawd, 0, $time]);
		                                        	return '开通成功';
												}
											}else{
												return '内部错误:数据库操作失败,请联系客服!';
											}
										}elseif($rows->{'tradeAmount'}>=20){
											$row = DB::insert('insert into gqdd (dh, time) values (?, ?)', [$_GET['dh'], time()]);
											if($row){
		                                        $lpid = DB::table('users')->where('id',$id)->pluck('lpapi')->first();
												if($lpid){
													$ss = DB::table('lpapi')->where('apiid',$lpid)->first();
													$s = $ss->dqtime;
													if($s>=time()){
														$dqtime = strtotime("+30 day",$s);
													}else{
														$dqtime = strtotime("+30 day");
													}
													if($ss->type===0){
														$s = DB::table('users')->where('id',$id)->select('yqm')->first();
														$yqm = $s->yqm;
														if(!empty($yqm)){
															DB::table('users')->where('id',$yqm)->increment('money', 5);
														}
														DB::table('lpapi')->where('apiid',$lpid)->update([
															'type' => 1,
															'dqtime' => strtotime("+39 day")
														]);
														return '升级成功';
													}else{
														$s = DB::table('users')->where('id',$id)->first();
														if($s->fx<=0){
															$yqm = $s->yqm;
															if(!empty($yqm)){
																DB::table('users')->where('id',$yqm)->increment('money', 10);
																DB::table('users')->where('id',$id)->increment('fx');
															}
														}
														DB::table('lpapi')->where('apiid',$lpid)->update([
															'type' => 1,
															'dqtime' => $dqtime
														]);
														return '续费成功';
													}
												}else{
													$s = DB::table('users')->where('id',$id)->select('yqm')->first();
													$yqm = $s->yqm;
													if(!empty($yqm)){
														DB::table('users')->where('id',$yqm)->increment('money', 5);
													}
													DB::table('users')->where('id', $id)->update(['lpapi' => $lpapi]);
		                                        	DB::insert('insert into lpapi (apiid, apipwd, type, dqtime) values (?, ?, ?, ?)', [$lpapi,$lpawd, 1, $time]);
		                                        	return '开通成功';
												}
											}else{
												return '内部错误:数据库操作失败,请联系客服!';
											}
										}else{
											return '您付款的金额与服务价格不匹配,请勿非法操作！';
										}
									}
								}else{
									return '不存在此订单,或连接L Pays服务器失败！';
								}
							}
						}else{
							return 'Error:Ltype error!';
						}
					}else{
						return 'Error:Lack Get!';
					}
				}
				if(!Auth::user()){
					return '请先登陆！';
				}
				if($st=='lp'){
					if(isset($_GET['dh']) and $_GET['dh'] and isset($_GET['ltype']) and $_GET['ltype']){
						$data['smsg'] = '如果根据提示金额付款成功，将会自动开通/续费成功 <a href="./api">>>点我马上体验<<</a>';
						return view('api',$data);
					}else{
						return 'Error:Lack Get!';
					}
				}else{
					return 'Error:don\'t is st!';
				}
			}else{
				return 'Error:Join us';
			}
		}
	}