<?php
	namespace App\Http\Controllers;
	use Illuminate\Http\Resources\Json\Resource;
	use Illuminate\Support\Facades\DB;
	use App\Http\Controllers\Controller;
	class DelController extends Controller
	{
		public function del($type)
		{
			$xt = time()-86400;
			if($type=='alipay'){
				$results = DB::table('zfbs')->where([
					['time', '<', $xt],
					['state', '=', NULL]
				])->delete();
				$t = 'ali';
			}elseif($type=='wxpay'){
				$results = DB::table('wxs')->where([
					['time', '<', $xt],
					['state', '=', NULL]
				])->delete();
				$t = 'wx';
			}else{
				$results = DB::table('qqs')->where([
					['time', '<', $xt],
					['state', '=', NULL]
				])->delete();
				$t = 'qq';
			}
			return 'Tip:删除过期订单完成!OK!';
		}
	}