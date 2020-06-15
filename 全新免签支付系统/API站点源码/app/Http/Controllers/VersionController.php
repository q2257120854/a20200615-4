<?php
	namespace App\Http\Controllers;
	use Illuminate\Support\Facades\DB;
	class VersionController extends Controller
	{
		private $nv = '5.3';//最新版本
		private $url = 'nurl下载地址:end';//最新版本下载地址
		public function check($v)
		{
			if(is_numeric($v)){
				if($v<$this->nv){
					return $this->url;
				}else{
					return 'Not New';
				}
			}else{
				return 'Join Us?';
			}
		}
	}	