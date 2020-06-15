<?php
	namespace App\Http\Controllers;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	class ApiController extends Controller
	{
		public function api()
		{
			$data['api'] = '1';
			$data['lpapi'] = '1';
			$data['msg'] = null;
			//页面信息
			$app = DB::table('lpapi')->where('apiid', Auth::user()->lpapi)->first();
			$data['app'] = $app;
			if($app){
				//操作
				if(isset($app->type) and $app->type==0 or $app->type==1){
					if(isset($_POST['bc']) and $_POST['bc']){
						if(isset($_POST['zewm']) and $_POST['zewm'] and isset($_POST['wewm']) and $_POST['wewm'] and isset($_POST['gqtime']) and $_POST['gqtime']){
							DB::table('lpapi')->where('id', $app->id)->update([
		                        'skewm' => $_POST['zewm'],
		                        'wxskewm' => $_POST['wewm'],
		                        'qqskewm' => $_POST['qewm'],
		                        'gqtime' => $_POST['gqtime']
		                    ]);
		                    $data['msg'] = 'Pays Pro 信息保存成功';
		                    //重载数据，及时显示
			                $app = DB::table('lpapi')->where('apiid', Auth::user()->lpapi)->first();
							$data['app'] = $app;
						}else if(isset($_POST['zewm']) and $_POST['zewm'] and isset($_POST['gqtime']) and $_POST['gqtime']){
							DB::table('lpapi')->where('id', $app->id)->update([
			                    'skewm' => $_POST['zewm'],
			                    'gqtime' => $_POST['gqtime']
			                ]);
			                $data['msg'] = 'Pays Alipay 信息保存成功';
			                //重载数据，及时显示
			                $app = DB::table('lpapi')->where('apiid', Auth::user()->lpapi)->first();
							$data['app'] = $app;
						}else{
							$data['msg'] = '请先完善以上所有信息！';
						}
					}
				}
				//页面信息
			}
			return view('api',$data);
		}
		public function lps(){
			$data['api'] = '1';
			$data['lpapis'] = '1';
			$data['msg'] = null;
			//页面信息
			$app = DB::table('lpapi')->where('apiid', Auth::user()->lpapi)->first();
			$data['app'] = $app;
			if($app){
				//操作
				if(isset($app->type) and $app->type==0 or $app->type==1){
					if($data['app']->type==0){
						//月收入
						$data['byl'] = DB::select('SELECT SUM(tradeAmount) as byl FROM zfb  WHERE DATE_FORMAT(tradeTime, "%Y%m") = DATE_FORMAT(CURDATE(), "%Y%m") AND appid = :appid AND dh != ""', ['appid' => Auth::user()->lpapi]);
						$data['byl'] = $data['byl'][0]->byl;
						if(!$data['byl']){
			                $data['byl'] = '0';
			            }else{
			                $data['byl'] = str_replace(",","",number_format($data['byl'],2));
			            }
			            //周收入
			            $data['bzl'] = DB::select('SELECT SUM(tradeAmount) as bzl FROM zfb  WHERE DATE_SUB(CURDATE(), INTERVAL 7 DAY) < date(tradeTime) AND appid = :appid AND dh != ""', ['appid' => Auth::user()->lpapi]);
						$data['bzl'] = $data['bzl'][0]->bzl;
						if(!$data['bzl']){
			                $data['bzl'] = '0';
			            }else{
			                $data['bzl'] = str_replace(",","",number_format($data['byl'],2));
			            }
			            //日收入
			            $data['jtl'] = DB::select('SELECT SUM(tradeAmount) as jtl FROM zfb  WHERE TO_DAYS(tradeTime) = TO_DAYS(NOW()) AND appid = :appid AND dh != ""', ['appid' => Auth::user()->lpapi]);
						$data['jtl'] = $data['jtl'][0]->jtl;
						if(!$data['jtl']){
			                $data['jtl'] = '0';
			            }else{
			                $data['jtl'] = str_replace(",","",number_format($data['jtl'],2));
			            }
			            //订单数据
						$data['type'] = "zfb";
			           	$data['s'] = DB::table($data['type'])->where([
			           		['appid','=',$app->apiid],
			           		['dh','!=','']
			           	])->whereNotNull('dh');
			           	if(!empty($_GET['stime']) and !empty($_GET['etime'])){
			           		$data['stime'] = $_GET['stime'];
			           		$data['etime'] = $_GET['etime'];
			           		$data['s'] = $data['s']->where([
			           			['tradeTime','>=',$data['stime']],
			           			['tradeTime','<=',$data['etime']]
			           		]);
			           	}else{
			           		$data['stime'] = '';
			           		$data['etime'] = '';
			           	}
			           	if(isset($_GET['str']) and $_GET['str']!=''){
			           		$data['str'] = $_GET['str'];
			           		$data['s'] = $data['s']->where([['tradeNo','like','%'.$data['str'].'%']])->orwhere([['dh','like','%'.$data['str'].'%']]);
			           	}else{
			           		$data['str'] = '';
			           	}
			           	$data['s'] = $data['s']->orderBy('id', 'desc')->paginate(15);
					}else{
						//月收入
						$zfb = DB::select('SELECT SUM(tradeAmount) as byl FROM zfb  WHERE DATE_FORMAT(tradeTime, "%Y%m") = DATE_FORMAT(CURDATE(), "%Y%m") AND appid = :appid AND dh != ""', ['appid' => Auth::user()->lpapi]);
						$zfb = $zfb[0]->byl;
						if(!$zfb){
							$zfb = 0;
						}
						$wx = DB::select('SELECT SUM(tradeAmount) as byl FROM wx  WHERE DATE_FORMAT(tradeTime, "%Y%m") = DATE_FORMAT(CURDATE(), "%Y%m") AND appid = :appid AND dh != ""', ['appid' => Auth::user()->lpapi]);
						$wx = $wx[0]->byl;
						if(!$wx){
							$wx = 0;
						}
						$qq = DB::select('SELECT SUM(tradeAmount) as byl FROM qq  WHERE DATE_FORMAT(tradeTime, "%Y%m") = DATE_FORMAT(CURDATE(), "%Y%m") AND appid = :appid AND dh != ""', ['appid' => Auth::user()->lpapi]);
						$qq = $qq[0]->byl;
						if(!$qq){
							$qq = 0;
						}
						$data['byl'] = $zfb + $wx + $qq;
						$data['byl'] = str_replace(",","",number_format($data['byl'],2));
						//周收入
						$zfb = DB::select('SELECT SUM(tradeAmount) as bzl FROM zfb  WHERE DATE_SUB(CURDATE(), INTERVAL 7 DAY) < date(tradeTime) AND appid = :appid AND dh != ""', ['appid' => Auth::user()->lpapi]);
						$zfb = $zfb[0]->bzl;
						if(!$zfb){
							$zfb = 0;
						}
						$wx = DB::select('SELECT SUM(tradeAmount) as bzl FROM wx  WHERE DATE_SUB(CURDATE(), INTERVAL 7 DAY) < date(tradeTime) AND appid = :appid AND dh != ""', ['appid' => Auth::user()->lpapi]);
						$wx = $wx[0]->bzl;
						if(!$wx){
							$wx = 0;
						}
						$qq = DB::select('SELECT SUM(tradeAmount) as bzl FROM qq  WHERE DATE_SUB(CURDATE(), INTERVAL 7 DAY) < date(tradeTime) AND appid = :appid AND dh != ""', ['appid' => Auth::user()->lpapi]);
						$qq = $qq[0]->bzl;
						if(!$qq){
							$qq = 0;
						}
						$data['bzl'] = $zfb + $wx + $qq;
						$data['bzl'] = str_replace(",","",number_format($data['bzl'],2));
						//日收入
						$zfb = DB::select('SELECT SUM(tradeAmount) as jtl FROM zfb  WHERE TO_DAYS(tradeTime) = TO_DAYS(NOW()) AND appid = :appid AND dh != ""', ['appid' => Auth::user()->lpapi]);
						$zfb = $zfb[0]->jtl;
						if(!$zfb){
							$zfb = 0;
						}
						$wx = DB::select('SELECT SUM(tradeAmount) as jtl FROM wx  WHERE TO_DAYS(tradeTime) = TO_DAYS(NOW()) AND appid = :appid AND dh != ""', ['appid' => Auth::user()->lpapi]);
						$wx = $wx[0]->jtl;
						if(!$wx){
							$wx = 0;
						}
						$qq = DB::select('SELECT SUM(tradeAmount) as jtl FROM qq  WHERE TO_DAYS(tradeTime) = TO_DAYS(NOW()) AND appid = :appid AND dh != ""', ['appid' => Auth::user()->lpapi]);
						$qq = $qq[0]->jtl;
						if(!$qq){
							$qq = 0;
						}
						$data['jtl'] = $zfb + $wx + $qq;
						$data['jtl'] = str_replace(",","",number_format($data['jtl'],2));
						//订单数据
						if(!empty($_GET['type'])){
							if($_GET['type']=='wx'){
								$data['type'] = "wx";
							}elseif($_GET['type']=='qq'){
								$data['type'] = "qq";
							}else{
								$data['type'] = "zfb";
							}
						}else{
							$data['type'] = "zfb";
						}
			           	$data['s'] = DB::table($data['type'])->where([
			           		['appid','=',$app->apiid],
			           		['dh','!=','']
			           	])->whereNotNull('dh');
			           	if(!empty($_GET['stime']) and !empty($_GET['etime'])){
			           		$data['stime'] = $_GET['stime'];
			           		$data['etime'] = $_GET['etime'];
			           		$data['s'] = $data['s']->where([
			           			['tradeTime','>=',$data['stime']],
			           			['tradeTime','<=',$data['etime']]
			           		]);
			           	}else{
			           		$data['stime'] = '';
			           		$data['etime'] = '';
			           	}
			           	if(isset($_GET['str']) and $_GET['str']!=''){
			           		$data['str'] = $_GET['str'];
			           		$data['s'] = $data['s']->where([['tradeNo','like','%'.$data['str'].'%']])->orwhere([['dh','like','%'.$data['str'].'%']]);
			           	}else{
			           		$data['str'] = '';
			           	}
			           	$data['s'] = $data['s']->orderBy('id', 'desc')->paginate(15);
			           	//{{ date("Y-m-d",strtotime("-1 day",strtotime(date("Y-m-d",time())))) }}
					}
				}
				//页面信息
			}else{
				$data['msg'] = "您暂未开通Pays无法查看财务状况!请先<a href='/api'> 前往 </a>开通~!";
			}
			return view('lps',$data);
		}
		public function gu(){
			if(!empty($_POST['dh']) and !empty($_POST['type'])){
				if($_POST['type']=="zfb"){
					$s = DB::table('zfbs')->where('dh', $_POST['dh'])->pluck('gu')->first();
					if(!$s){
						return '此订单无效，无法通知！';
					}
				}elseif($_POST['type']=="wx"){
					$s = DB::table('wxs')->where('dh', $_POST['dh'])->pluck('gu')->first();
					if(!$s){
						return '此订单无效，无法通知！';
					}
				}else{
					$s = DB::table('qqs')->where('dh', $_POST['dh'])->pluck('gu')->first();
					if(!$s){
						return '此订单无效，无法通知！';
					}
				}
				$data['gu'] = $s;
				return view('get',$data);
			}else{
				return '非法操作';
			}
		}
	}	