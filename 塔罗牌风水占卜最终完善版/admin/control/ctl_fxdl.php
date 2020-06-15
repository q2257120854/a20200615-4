<?php
if( !defined('CORE') ) exit('Request Error!');

class ctl_fxdl extends common{
    // 自动验证设置
    protected $_submit_validate     =   array(
        'oid'=>array('','notempty','','all'),
        'id'=>array('id','notempty','主键必须！','update'),
    );

    protected $_db_validate     =   array(
       // 'title'=>array('title','unique','已经存在！','all','extend'=>array('cp','type')),
    );
    protected $_uploadFile = array(
        'img'=>array('name'=>'img','size'=>'','format'=>array('jpg','png','gif'),'save_path'=>PATH_ROOT),
    );
    // 自动填充设置
    protected $_auto     =   array(
        'cp'=>array('cp','value','1','all'),
        //入表时间和更新时间放到构造函数中执行，因为此处不支持动态赋值
    );
    protected $_allowAction = array();//允许操作的方法列表


    //对应的菜单项分类，1：内涵图；2：视频；3：段子手；4：微博热帖。
    protected $paytype = array( 1=>'微信', 2=>'支付宝');
    protected $status = array(0=>'待付费',1=>'已付费');
    protected $dl_status = array(0=>'未结算',1=>'已结算');

    protected $jiesuan = array(0=>'未结算',1=>'申请提现',2=>'已打款',3=>'无效退款');

    protected $type = array(1=>'八字精批', 2=>'姓名分析', 3=>'姓名配对', 4=>'八字合婚', 5=>'年度运势',6=>'八字事业运',7=>'姻缘测试',8=>'综合测试',9=>'紫微斗数',10=>'号码吉凶');


    public function __construct()
    {
        $this->categorys = $this->type;
        $sql = 'select `uid`,`user_name` from `users`';
        $row = db::querylist($sql);
        foreach($row as $k){
          $userarr[$k['uid']] = $k['user_name'];
        }
        $this->cp = $userarr;

        //$this->_auto['cp'] = array('cp', 'value', cls_access::$accctl->uid, 'insert');//属性赋予默认值无法动态计算；放到此处执行
        //$this->_auto['uptime'] = array('uptime', 'value', date("Y-m-d H:i:s"), 'insert');//属性赋予默认值无法动态计算；放到此处执行

        $this->_dbfield=array(
            'mainKey'=>'id',
            'allTableField'=>array('id'=>'编号','total'=>'提成','oid'=>'订单号','paytype'=>'支付体系','data'=>'订单内容','money'=>'金额','createtime'=>'订单时间','status'=>'支付状态','paytime'=>'支付时间','ip'=>'ip','des'=>'标题','type'=>'栏目','trade_status'=>'第三方返回值','cp'=>'渠道','jiesuan'=>'结算状态'),
            'addTableField'=>array('oid'),

            'editTableField'=>array('oid'),

            'listTableField'=>array('oid','paytype','money','status','paytime','des','type','jiesuan'),

            'batchUpdateTableField'=>array(),
            'batchDeleteTableField'=>array(
                'mainKey'=>'id',
            ),
            'id'=>array(
                'element'=>array('e_name'=>'input','e_type'=>'text'),
            ),
            'jiesuan'=>array(
                'element'=>array('e_name'=>'select','datafrom'=>$this->jiesuan),
                'search'=>'1',
            ),
            'des'=>array(
                'element'=>array('e_name'=>'input','e_type'=>'text'),

            ),
            'oid'=>array(
                'element'=>array('e_name'=>'input','e_type'=>'text'),
                'search'=>'1',
                //'search_extend'=>'like',
            ),
            'cp'=>array(
                'element'=>array('e_name'=>'select','datafrom'=>$this->cp),
                //'search_extend'=>'like',
            ),
            'paytype'=>array(
                //'element'=>array('e_name'=>'input','e_type'=>'text', 'richtext'=>true),
                'element'=>array('e_name'=>'select','datafrom'=>$this->paytype),

            ),
            'data'=>array(
                'element'=>array('e_name'=>'textarea','style'=>'width:200px;height:60px;'),
            ),
            'money'=>array(
                'element'=>array('e_name'=>'input','e_type'=>'text')
            ),
            'createtime'=>array(
                'element'=>array('e_name'=>'input','e_type'=>'text'),
            ),
            'status'=>array(
                'element'=>array('e_name'=>'select','datafrom'=>$this->status),
                'search'=>'1',
            ),
            'type'=>array(
                'element'=>array('e_name'=>'select','datafrom'=>$this->type),
                'search'=>'1',
            ),
            'paytime'=>array(
                'element'=>array('e_name'=>'input','e_type'=>'text'),
            ),
            'ip'=>array(
                'element'=>array('e_name'=>'input','e_type'=>'text'),
            ),
            'trade_status'=>array(
                'element'=>array('e_name'=>'input','e_type'=>'text'),
            ),
        );


        parent::__construct();

        $this->table = 'ffsm_orders';

        //add edit delete batch_update
        $this->_allowAction = array(
            'add'=>array('title'=>'添加','type'=>'dialog','width'=>'700','height'=>'700'),
            'edit'=>array('title'=>'编辑','type'=>'href',),
            'delete'=>array('title'=>'删除','type'=>'href',),
            'batch_update'=>array('title'=>'批量修改','type'=>'href',),
            /*'_extend'=>array(
                '?ct=commend_data&ac=add'=>array('title'=>'添加到推荐位','type'=>'dialog','width'=>'700','height'=>'700','param'=>'data_id'),
            ),*/
        );

        tpl::assign('_allowAction',$this->_allowAction);


        tpl::assign('_submit_validate',$this->_submit_validate);

        tpl::assign('_dbfield',$this->_dbfield);

    }



    public function index(){
        /**接收搜索值***/
        $where = '';

        $where_arr = array();
        if(cls_access::$accctl->uid=='1'){
            $where_arr = array();
        }else{
            $where_arr = array('`cp`="'.cls_access::$accctl->uid.'"');
        }

        //$where_arr = array('`cp`="'.cls_access::$accctl->uid.'"');

        //$where_arr = array('`cp`="'.cls_access::$accctl->uid.'"');

        $config['url_prefix'] = "?ct=".$this->ct."&ac=".$this->ac;
        foreach($this->_dbfield as $k=>$v){
            if(isset($v['search']) && $v['search']==1){
                $temp = '';
                $temp = 'search'.$k;
                $temp = req::item($k,'');

                tpl::assign('search'.$k,$temp);

                if(!empty($temp)){
                    if(isset($v['search_extend']) && $v['search_extend']=='like'){
                        $where_arr[] = "`".$k."` like '%".$temp."%'";
                    }elseif(isset($v['search_extend']) && $v['search_extend']['direct']){
                        $where_arr[] = "`".$k."`".$v['search_extend']['direct']."'".$temp."'";
                    }else{
                        $where_arr[] = "`".$k."` = '".$temp."'";
                    }
                    //将查询关键字添加到页码后面
                    $config['url_prefix'] .='&'.$k.'='.$temp;
                }
            }
        }


        //exit();

        /**************/

        if(!empty($where_arr)) $where = ' where '.implode(' and ', $where_arr);
        $size = $config['page_size'] = 16; //每页显示多少
        $config['current_page'] = req::item('page_no'); //接收页码
        empty($config['current_page']) && $config['current_page'] = 1;
        tpl::assign('current_page',$config['current_page']);


        $sql1 = "SELECT count(".$this->_dbfield['mainKey'].") as total FROM `".$this->table."`".$where;

        $rsid = db::fetch_one(db::query($sql1));
        $config['total_rs'] = $rsid['total']; //总记录数

        $pages  = util::pagination($config); //取得分页信息
        tpl::assign('pages',$pages);

        $offset = ($config['current_page'] - 1) * $size;
        $sql2 = "SELECT * FROM `".$this->table."`".$where." order by ".$this->_dbfield['mainKey']." desc LIMIT {$offset},{$size}";
        $query = db::query($sql2);
        $rows    = db::fetch_all($query);

        $uinfo = cls_access::$accctl->get_userinfos();

        //总金额
        $sqlx = "select * from `".$this->table."` where cp='".$uinfo['uid']."' and status='1' and jiesuan='0'";
        $rowx = db::querylist($sqlx);
        $total = 0;
        foreach($rowx as $v){
            $total = $total+$v['money'];
        }
        tpl::assign('total',$total);


        $sqlx = "select * from `".$this->table."` where cp='".$uinfo['uid']."' and status='1' and jiesuan='1'";
        $rowx = db::querylist($sqlx);
        $daifu = 0;
        foreach($rowx as $v){
            $daifu = $daifu+$v['money'];
        }


        $fencheng = '0.'.$uinfo['fencheng'];

        $sqlx = "select * from `ffsm_dl_tixian` where uid='".$uinfo['uid']."' and status='1'";
        $rowx = db::querylist($sqlx);
        $jiesuan = 0;
        foreach($rowx as $v){
            $jiesuan = $jiesuan+$v['money'];
        }



        tpl::assign('jiesuan',$jiesuan);
        tpl::assign('daifu',$daifu*$fencheng);
        tpl::assign('total',$total*$fencheng);


        tpl::assign('data_list',$rows);

        //tpl::assign('arrData',db::fetch_all(db::query('select * from qz_country order by sort asc')));
        if(file_exists(PATH_ROOT.'/templates/template/admin/'.$this->ct.'.'.$this->ac.'.tpl')){
            //var_dump($this->ct.'.'.$this->ac.'.tpl');exit();
            tpl::display($this->ct.'.'.$this->ac.'.tpl');
        }else{
            exit('no tpl file');
        }

    }

    public function add()
    {
        cls_msgbox::show('系统提示','你无权限操作',-1);
        exit();
    }


    public function edit()
    {
        cls_msgbox::show('系统提示','你无权限操作',-1);
        exit();
    }

    public function delete()
    {
        cls_msgbox::show('系统提示','你无权限操作',-1);
        exit();
    }

    /**
     * 批量删除
     */
    public function batch_delete(){

        cls_msgbox::show('系统提示','你无权限操作',-1);

    }


    public function links(){

        $userinfo = cls_access::$accctl->get_userinfos();


        // dump($userinfo);

        preg_match('/[\w][\w-]*\.(?:com\.cn|com|cn|co|net|org|gov|cc|biz|info|xyz)/isU', URL, $domain);
        // dump($domain);
        tpl::assign('userinfo',$userinfo);
        tpl::assign('domain',URL);
        tpl::display($this->ct.'.'.$this->ac.'.tpl');

    }
  


    private function _deleteImage($image){
        if(is_array($image)){
            foreach($image as $v){
                $this->_deleteImage($v);
            }
        }elseif($image && file_exists(PATH_ROOT.$image)){
            @unlink(PATH_ROOT.$image);
        }
    }
    
    

    //更新采集资源的状态 最新采集的资源status为99 正常status为1
    public function updatestatus(){
        echo 'start<br />';
        if(db::query('update news_data set `status`="1" where `status`="99" limit 1000')){
            echo 'success!';
        }else{
            echo 'fail!';
        }
        exit();
    }

}

