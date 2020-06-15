<?php
	namespace App\Http\Controllers;
	use app\Edlm\edlm;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Support\Facades\Hash;
	use Illuminate\Support\Facades\Auth;
	class ResetController extends Controller
	{
		public function mail(){
			$edlm = new Edlm;
			if(!empty($_GET['s']) and !empty($_GET['t'])){
				$url = "http://邮件接口地址/post.php";
				$title = "[Pays]:".ucwords($_GET['t'])."掉线通知";
				//
				$msg="经检测，您的".ucwords($_GET['t'])."现已掉线，为了保证您的业务正常，请尽快前往Pays软件端处理！！！";
				$token = $edlm->ede1('maddog','sjr:'.$_GET['s'].'title:'.$title.'content:'.$msg.'maddog',0);
				$edlm->tomail($url,$token);
				return 'ok';
			}
			//
			$url = "http://邮件接口地址/post.php";
			$title = "[重要]:Pays全套已开源！！！";
			//
			$dql = DB::table('lpapi')->where([
				['dqtime','<=',time()+259200]
			])->leftJoin('users', 'lpapi.apiid', '=', 'users.lpapi')->paginate(10);

			foreach ($dql as $v) {
				$msg="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;尊敬的【".$v->name."】，您好！";
				$token = $edlm->ede1('maddog','sjr:'.$v->email.'title:'.$title.'content:'.$msg.'maddog',0);
				$edlm->tomail($url,$token);
            	echo '<br>'.$v->email.'完成';
            	sleep(1);
			}
			return '<br>提醒完成';
		}
		public function reset($s)
		{
			if(isset(Auth::user()->id)){
				return '当前已登陆，无需进入此处修改密码';die;
			}
			//头部初始化
			header('content-type:text/html;charset=utf-8');
			$edlm = new Edlm;
			$mds8="QWERTYUIOPASDFGHJKLZXCVBNM1234567890=+";
			str_shuffle($mds8);
			$data['msg'] = '';
			//判断步骤 o==one 第一步，t==two 第二步，以此类推
			if($s=='1'){
				$data['s'] = $s;
				session()->put('time', $edlm->ede1(md5(date('YmdH',time())."maddog"),"100",3));
				return view('reset',$data);
			}else if($s=='2'){
				$data['s'] = $s;
				if(isset($_POST['email']) and $_POST['email']){
					if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$_POST['email'])){
						$data['msg'] = '提示:邮箱格式错误';
						session()->put('time', "100");
						$data['s'] = '1';
					}else{
						$email = $_POST['email'];
	                    $results = DB::table('users')->where('email', $email)->first();
	                    if($results){
	                    	if($results->etime==null){
		                    	$time = (int)$edlm->edd1(md5(date('YmdH',time())."maddog"),session('time'),3);
	                            $data['msg'] = "提示:验证码已发送至你的邮箱,如过没有收到请1分钟后再试!";
	                            if($time<time()){
	                                $userid = $results->id;
	                                $code = substr(str_shuffle($mds8),26,2).rand(0,9).rand(0,9).rand(0,9);
	                                $url = "http://邮件接口地址/post.php";
	                                $token = $edlm->ede1('maddog','sjr:'.$email.'title:E Ke - 重置密码content:E Ke 你好，你正在尝试修改进入密码，你的验证码是:<a href="#">'.$code.'</a>(验证码只在1分钟内有效,请立刻使用)如非你本人操作(打死都不能告诉别人)，请忽略！maddog',0);
	                                if($edlm->getSubstr($edlm->tomail($url,$token),"http://www.",".cn/)")=="edlm"){
	                                    $time = time() + 60;
	                                    session()->put('time', $edlm->ede1(md5(date('YmdH',time())."maddog"),(string)$time.'co:'.$edlm->ede1('abc123',$code,0).':de'.$edlm->ede1('abc123',(string)$userid,0).':id',3));
	                                    session()->put('keys',$edlm->ede1(md5(date('YmdH',time())."md"),(string)0,2));
	                                    $ts = time()+86400;
	                                    $ts = $edlm->ede1('maddog','t:'.$ts.':t1:e',0);
	                                    $row = DB::table('users')->where('id', $results->id)->update(['etime' => $ts]);
	                                    $data['msg'] = "提示:验证码已发送至你的邮箱.";
	                                }else{
	                                    $data['msg'] = "提示:发送失败请刷新一下,如果还是失败,请确认此邮箱是否可正常接收邮件.";
	                                    session()->put('time', "100");
										$data['s'] = '1';
	                                }
	                            }
		                    }elseif((int)$edlm->getSubstr($edlm->edd1('maddog',$results->etime,0),":t",":e")<=3){
		                    	$ts = (int)$edlm->getSubstr($edlm->edd1('maddog',$results->etime,0),":t",":e")+1;
	                            $ds = time()+86400;
	                            $time = (int)$edlm->edd1(md5(date('YmdH',time())."maddog"),session('time'),3);
	                            $data['msg'] = "提示:验证码已发送至你的邮箱,如过没有收到请1分钟后再试!";
	                            if($time<time()){
	                                $userid = $results->id;
	                                $code = substr(str_shuffle($mds8),26,2).rand(0,9).rand(0,9).rand(0,9);
	                                $url = "http://邮件接口地址/post.php";
	                                $token = $edlm->ede1('maddog','sjr:'.$email.'title:E Ke - 重置密码content:E Ke 你好，你正在尝试修改进入密码，你的验证码是:<a href="#">'.$code.'</a>(验证码只在1分钟内有效,请立刻使用)如非你本人操作(打死都不能告诉别人)，请忽略！maddog',0);
	                                if($edlm->getSubstr($edlm->tomail($url,$token),"http://www.",".cn/)")=="edlm"){
	                                    $time = time() + 60;
	                                    session()->put('time', $edlm->ede1(md5(date('YmdH',time())."maddog"),(string)$time.'co:'.$edlm->ede1('abc123',$code,0).':de'.$edlm->ede1('abc123',(string)$userid,0).':id',3));
	                                    session()->put('keys',$edlm->ede1(md5(date('YmdH',time())."md"),(string)0,2));
	                                    $ts = $edlm->ede1('maddog','t:'.$ds.':t'.$ts.':e',0);
	                                    $row = DB::table('users')->where('id', $results->id)->update(['etime' => $ts]);
	                                    $data['msg'] = "提示:验证码已发送至你的邮箱.";
	                                }else{
	                                    $data['msg'] = "提示:发送失败请刷新一下,如果还是失败,请确认此邮箱是否可正常接收邮件.";
	                                    session()->put('time', "100");
										$data['s'] = '1';
	                                }
	                            }
		                    }elseif((int)$edlm->getSubstr($edlm->edd1('maddog',$results->etime,0),"t:",":t")>=time()){
		                    	$data['msg'] = "一天之内只能修改三次密码,请在24小时之后重试或联系客服重置密码!";
		                    	$data['s'] = '1';
		                    }else{
		                    	$ts = time()+86400;
	                            $time = (int)$edlm->edd1(md5(date('YmdH',time())."maddog"),session('time'),3);
	                            $data['msg'] = "提示:验证码已发送至你的邮箱,如过没有收到请1分钟后再试!";
	                            if($time<time()){
	                                $userid = $results->id;
	                                $code = substr(str_shuffle($mds8),26,2).rand(0,9).rand(0,9).rand(0,9);
	                                $url = "http://邮件接口地址/post.php";
	                                $token = $edlm->ede1('maddog','sjr:'.$email.'title:E Ke - 重置密码content:E Ke 你好，你正在尝试修改进入密码，你的验证码是:<a href="#">'.$code.'</a>(验证码只在1分钟内有效,请立刻使用)如非你本人操作(打死都不能告诉别人)，请忽略！maddog',0);
	                                if($edlm->getSubstr($edlm->tomail($url,$token),"http://www.",".cn/)")=="edlm"){
	                                    $time = time() + 60;
	                                    session()->put('time', $edlm->ede1(md5(date('YmdH',time())."maddog"),(string)$time.'co:'.$edlm->ede1('abc123',$code,0).':de'.$edlm->ede1('abc123',(string)$userid,0).':id',3));
	                                    session()->put('keys',$edlm->ede1(md5(date('YmdH',time())."md"),(string)0,2));
	                                    $ts = $edlm->ede1('maddog','t:'.$ts.':t1:e',0);
	                                    $row = DB::table('users')->where('id', $results->id)->update(['etime' => $ts]);
	                                    $data['msg'] = "提示:验证码已发送至你的邮箱.";
	                                }else{
	                                    $data['msg'] = "提示:发送失败请刷新一下,如果还是失败,请确认此邮箱是否可正常接收邮件.";
	                                    session()->put('time', "100");
										$data['s'] = '1';
	                                }
	                            }
		                    }
	                    }else{
	                    	$data['msg'] = '提示:此邮箱暂时还没加入E Ke,无需修改密码';
							session()->put('time', $edlm->ede1(md5(date('YmdH',time())."maddog"),"100",3));
							$data['s'] = '1';
	                    }
					}
				}
				return view('reset',$data);
			}else if($s=='3'){
                $tit = $edlm->edd1(md5(date('YmdH',time())."md"),session('keys'),2);
                $tit = intval($tit);
	            if($tit>=3){
	            	$data['s'] = '2';
	                $data['msg'] = '提示:错误次数已达上限或验证码已经失效 <a href="./">>>点我重新开始<<</a>';
	            }else{
	                $code = $edlm->edd1(md5(date('YmdH',time())."maddog"),session('time'),3);
	                $code = $edlm->getSubstr($code,"co:",":de");
	                $code = $edlm->edd1('abc123',$code,0);
	                if(isset($_POST['code'])){
	                	if(strcasecmp($_POST['code'],$code)==0){
		                	$data['s'] = $s;
		                	$data['h'] = 'ok';
		                	session()->put('md5s',md5($code));
		                }else{
		                	if(session('keys')){
			                	$tit = $edlm->edd1(md5(date('YmdH',time())."md"),session('keys'),2);
			                    $tit = intval($tit);
			                    if($tit>=3){
			                    	$data['s'] = '2';
			                    	$data['msg'] = '提示:错误次数已达上限或验证码已经失效 <a href="./">>>点我重新开始<<</a>';
			                    }else{
			                    	$data['s'] = '2';
			                    	$tit = $tit + '1';
			                        session()->put('keys',$edlm->ede1(md5(date('YmdH',time())."md"),(string)$tit,2));
			                        $data['msg'] = '提示:验证码错误,请确认后再次验证!';
			                    }
			                }else{
			                	$data['s'] = '2';
			                	$data['msg'] = '提示:内部错误 <a href="./">>>点我重新开始<<</a>';
			                }
		                }
	                }else{
	                	$data['s'] = '2';
	                	$data['msg'] = '提示:内部错误 <a href="./">>>点我重新开始<<</a>';
	                }
	            }
				return view('reset',$data);
			}else if($s=='4'){
				$code = $edlm->edd1(md5(date('YmdH',time())."maddog"),session('time'),3);
                $code = $edlm->getSubstr($code,"co:",":de");
                $code = $edlm->edd1('abc123',$code,0);
                if(isset($_POST['md5']) and $_POST['md5']==md5($code)){
                	if(isset($_POST['npassword']) and $_POST['npassword'] !="" and isset($_POST['cpassword']) and $_POST['cpassword'] !=""){
						if($_POST['npassword']==$_POST['cpassword']){
							$sj = $edlm->edd1(md5(date('YmdH',time())."maddog"),session('time'),3);
	                        $userid = $edlm->edd1('abc123',$edlm->getSubstr($sj,":de",":id"),0);
	                        $npass = Hash::make($_POST['cpassword']);
	                        $row = DB::table('users')->where('id', $userid)->update(['password' => $npass]);
	                        $data['s'] = $s;
	                        $data['msg'] = '提示:恭喜您,修改密码成功!!!<br><a href="../login">>>点我重新登陆<<</a>';
		                }else{
		                	$data['h'] = 'ok';
		                	$data['s'] = '3';
	                		$data['msg'] = '提示:两次输入的密码不一致';
		                }
					}else{
						$data['h'] = 'ok';
						$data['s'] = '3';
	                	$data['msg'] = '提示:为了保证您身份的安全,请正确输入新的密码！';
					}
                }else{
                	$data['s'] = $s;
                	$data['msg'] = 'Join Us';
                }
				return view('reset',$data);
			}else{
				return 'Error:not found.';
			}
		}
	}	