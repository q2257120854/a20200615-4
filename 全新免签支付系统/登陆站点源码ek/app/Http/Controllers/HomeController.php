<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use app\Edlm\edlm;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;
    class HomeController extends Controller
    {
        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
            $this->middleware('auth');
        }

        /**
         * Show the application dashboard.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $data['home'] = '1';
            //页面数据
            $data['gg'] = DB::table('config')->where('id', 1)->first();
            $data['gg'] = $data['gg']->gg;
            $hot = DB::table('config')->where('id', 1)->first();
            $hot = $hot->rqek;
            $data['hname'] = DB::table('users')->where('id', $hot)->first();
            $data['hname'] = $data['hname']->name;
            //页面数据
            return view('home',$data);
        }
    }