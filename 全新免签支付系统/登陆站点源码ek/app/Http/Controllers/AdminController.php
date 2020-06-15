<?php
	namespace App\Http\Controllers;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	class AdminController extends Controller
	{
		public function lpads(){
			$data['lpads'] = '1';
			//
			if(Auth::user()->type>=1){
				//总
				$data['uc'] = DB::table('users')->count();
				$data['pc'] = DB::table('lpapi')->where([
					['type','=',1],
					['dqtime','>=',time()]
				])->count();
				$data['ac'] = DB::table('lpapi')->where([
					['type','=',0],
					['dqtime','>=',time()]
				])->count();
				//月
				$y=mktime(0,0,0,date('m'),1,date('Y'));
				$data['yc'] = DB::table('users')->where([
					['created_at','>=',date('Y-m-d H:i:s',$y)]
				])->count();
				//天
				$t=mktime(0,0,0,date('m'),date('d'),date('Y'));
				$data['tc'] = DB::table('users')->where([
					['created_at','>=',date('Y-m-d H:i:s',$t)]
				])->count();
				return view('lpads',$data);
			}
			return '???';
		}
	}