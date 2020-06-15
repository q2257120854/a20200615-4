<?php
if( !defined('CORE') ) exit('Request Error!');

class ctl_tixian extends common{
    // 自动验证设置
    protected $_submit_validate     =   array(
		'type'=>array('','notempty','收款平台必须','all'),
		'money'=>array('','notempty','提现金额必须（单位：元）','all'),
		//'dl_sc'=>array('','notempty','操作状态必须','all'),
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
        //'status'=>array('status','value','1','all'),
        //入表时间和更新时间放到构造函数中执行，因为此处不支持动态赋值
    );


    protected $_allowAction = array();//允许操作的方法列表


    //对应的菜单项分类，1：内涵图；2：视频；3：段子手；4：微博热帖。
	protected $type = array( 1=>'支付宝', 2=>'微信');
    protected $status = array(0=>'等待打款',1=>'打款成功',2=>'无效退款');
	
    public function __construct()
    {
        if(cls_access::$accctl->uid!='1'){
            cls_msgbox::show('系统提示','你无权限操作',-1);
            exit();
        }

        $this->categorys = $this->type;
        $sql = 'select `uid`,`user_name` from `users`';
        $row = db::querylist($sql);
        foreach($row as $k){
            $userarr[$k['uid']] = $k['user_name'];
        }
        $this->uid = $userarr;
		
        $this->_auto['uid'] = array('uid', 'value', cls_access::$accctl->uid, 'insert');//属性赋予默认值无法动态计算；放到此处执行
        //$this->_auto['uptime'] = array('uptime', 'value', date("Y-m-d H:i:s"), 'insert');//属性赋予默认值无法动态计算；放到此处执行
        $this->_dbfield=array(
            'mainKey'=>'id',
            'allTableField'=>array('id'=>'编号','uid'=>'用户id','type'=>'收款平台','oidarr'=>'订单集合','zhanghao'=>'账号','name'=>'昵称','money'=>'提现金额','status'=>'操作状态','bz'=>'备注','time'=>'添加时间'),
            'addTableField'=>array('type','zhanghao','name','money'),
			
            'editTableField'=>array('type','status','bz','oidarr','money'),
           
            'listTableField'=>array('uid','type','money','zhanghao','name','status','oidarr'),
			
            'batchUpdateTableField'=>array(),
            'batchDeleteTableField'=>array(
                'mainKey'=>'id',
            ),
             'type'=>array(
                'element'=>array('e_name'=>'select','datafrom'=>$this->type),
            ),
			'status'=>array(
                'element'=>array('e_name'=>'select','datafrom'=>$this->status),
				'search'=>'1',
            ),
            'zhanghao'=>array(
                'element'=>array('e_name'=>'input','e_type'=>'text'),
            ),
            'money'=>array(
                'element'=>array('e_name'=>'input','e_type'=>'text'),
            ),
            'bz'=>array(
                'element'=>array('e_name'=>'input','e_type'=>'text'),
            ),
            'name'=>array(
                'element'=>array('e_name'=>'input','e_type'=>'text'),
            ),
            'time'=>array(
                'element'=>array('e_name'=>'input','e_type'=>'text'),
            ),
            'uid'=>array(
                'element'=>array('e_name'=>'select','datafrom'=>$this->uid),
                //'search_extend'=>'like',
                'search'=>'1',
            ),

        );

        parent::__construct();

        $this->table = 'ffsm_dl_tixian';

        //add edit delete batch_update
        $this->_allowAction = array(
            'add'=>array('title'=>'添加','type'=>'dialog','width'=>'500','height'=>'500'),
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

        tpl::assign('data_list',$rows);

        //tpl::assign('arrData',db::fetch_all(db::query('select * from qz_country order by sort asc')));
        if(file_exists(PATH_ROOT.'/templates/template/admin/'.$this->ct.'.'.$this->ac.'.tpl')){
            //var_dump($this->ct.'.'.$this->ac.'.tpl');exit();
            tpl::display($this->ct.'.'.$this->ac.'.tpl');
        }else{
            exit('no tpl file');
        }

    }



    /**
     * 编辑
     */
    public function edit()
    {
        $id=request($this->_dbfield['mainKey'],'') ? request($this->_dbfield['mainKey'],'') : cls_msgbox::show('系统提示','缺少id！',-1);
        if(request('dosubmit',''))
        {
            $info=req::$posts;

            if($info['shorttxt']==''){
                $info['shorttxt'] = strip_tags($info['content']);
                $info['shorttxt'] = mb_substr($info['shorttxt'],0,160,'utf-8');
            }

            //自动验证
            if(isset($this->_submit_validate) && $this->_submit_validate){
                foreach($this->_submit_validate as $field=>$vali){
                    if(!isset($info[$field]) || empty($info[$field])){
                        if(($vali['3'] == 'all' || $vali['3'] == 'update') && $vali['1']=='notempty'){
                            cls_msgbox::show('系统提示',$vali['2']?$vali['2']:$this->_dbfield['allTableField'][$field].'必须!',-1);
                            exit();
                        }
                    }else{
                        //其他验证
                    }
                }
            }
            //db 验证
            if(isset($this->_db_validate) && $this->_db_validate){
                foreach($this->_db_validate as $field=>$vali){
                    if(isset($info[$field]) && !empty($info[$field])){
                        if(($vali['3'] == 'all' || $vali['3'] == 'update') && $vali['1']=='unique'){
                            $arrTempData = array();
                            if(isset($vali['extend']) && $vali['extend']){
                                $arrtempWhere = array();
                                $arrtempWhere[] = '`'.$field.'`="'.$info[$field].'"';
                                foreach($vali['extend'] as $extendField){
                                    if(isset($info[$extendField]))$arrtempWhere[] = '`'.$extendField.'`="'.$info[$extendField].'"';
                                }
                                $strTempwhere = '';
                                if(!empty($arrtempWhere)) {
                                    $strTempwhere = ' where '.implode(' and ', $arrtempWhere);
                                    if(in_array($this->ac,array('edit','batch_update')))$strTempwhere .=' and `'.$this->_dbfield['mainKey'].'`!="'.$info[$this->_dbfield['mainKey']].'"';
                                }
                                if($strTempwhere)$arrTempData = db::get_one('select `'.$this->_dbfield['mainKey'].'` from `'.$this->table.'` '.$strTempwhere.' limit 1');
                            }else{

                                if(in_array($this->ac,array('edit','batch_update'))){
                                    $arrTempData = db::get_one('select `'.$this->_dbfield['mainKey'].'` from `'.$this->table.'` where `'.$field.'`="'.$info[$field].'" and `'.$this->_dbfield['mainKey'].'`!="'.$info[$this->_dbfield['mainKey']].'" limit 1');
                                }else{
                                    $arrTempData = db::get_one('select `'.$this->_dbfield['mainKey'].'` from `'.$this->table.'` where `'.$field.'`="'.$info[$field].'" limit 1');
                                }
                            }

                            if($arrTempData){
                                cls_msgbox::show('系统提示',$vali['2'],-1);
                                exit();
                            }
                        }
                    }
                }
            }
            //auto
            if(isset($this->_auto) && $this->_auto){
                foreach($this->_auto as $field=>$vali){
                    if(!isset($info[$field]) || empty($info[$field])){
                        if(($vali['3'] == 'all' || $vali['3'] == 'update')){
                            if($vali['1']=='value' && isset($vali['2'])){
                                $info[$field] = $vali['2'];
                            }elseif($vali['1']=='function' && isset($vali['2'])){
                                $info[$field] = $vali['2'];
                            }
                        }
                    }
                }
            }


            $data['content'] = str_replace(PHP_EOL,'', $data['content']);
            $data['content'] = str_replace(array("\r\n", "\r", "\n"), "", $data['content']);

            //验证上传文件
            if(isset($this->_uploadFile) && $this->_uploadFile){
                foreach($this->_uploadFile as $field=>$arrItem){
                    if(isset(req::$files[$field]['tmp_name']) && !empty(req::$files[$field]['tmp_name'])){
                        $info[$field] = $this->update_image(req::$files[$field],$arrItem,$field,$info[$this->_dbfield['mainKey']]);
                        /*if($info[$field] && is_numeric($info[$this->_dbfield['mainKey']]) && $info[$this->_dbfield['mainKey']]>0){
                            db::query('update '.$this->table.' set `'.$field.'`="'. $info[$field].'" where `'.$this->_dbfield['mainKey'].'`='.$info[$this->_dbfield['mainKey']].' limit 1');
                        }*/

                    }
                }
            }




            $where_arr[] = "`".$this->_dbfield['mainKey']."`='{$info[$this->_dbfield['mainKey']]}'";



            $result = false;
            if($info && $where_arr)$result=db::update($this->table,$info,$where_arr);
            if($result)
            {
                //是否需要清理缓存
                if(isset($this->_updateCache) && !empty($this->_updateCache)){
                    foreach($this->_updateCache as $arrItem){
                        if(isset($arrItem['prefix']) && isset($arrItem['key']) && !empty($arrItem['key'])){
                            $strCacehKeyTemp = '';
                            foreach ($info as $strField=>$strFieldValue){
                                $strCacehKeyTemp = str_ireplace('{{'.$strField.'}}', $strFieldValue, $arrItem['key']);
                            }
                            if($strCacehKeyTemp){
                                cache::del($arrItem['prefix'], $strCacehKeyTemp);
                                cache::set($arrItem['prefix'], $strCacehKeyTemp,null);
                            }
                        }
                    }
                }

                //***修改结算订单
                if($info['status']=='1'){
                    $oidarr = $info['oidarr'];
                    $oid_arr = explode(',',$oidarr);

                    foreach($oid_arr as $v){
                        $sql = 'select * from `ffsm_orders` where id="'.$v.'"';
                        $row = db::queryone($sql);
                        if($row['jiesuan']=='1'){
                            $sqlx = 'UPDATE `ffsm_orders` SET `jiesuan` = "2" WHERE `id` = "'.$row['id'].'"';
                            db::query($sqlx);
                        }
                    }

                }

                cls_msgbox::show('系统提示','成功修改 id 为:'.$info[$this->_dbfield['mainKey']].'的信息！','?ct='.$this->ct.'&ac='.$this->listPage);
            }
            else
            {
                cls_msgbox::show('系统提示','没有检测到修改的更新信息！',-1);
            }

        }
        else
        {
            $sql = "SELECT * FROM `{$this->table}` WHERE `".$this->_dbfield['mainKey']."`='{$id}' LIMIT 1";
            $data = db::get_one($sql);
            $data['content'] = str_replace(PHP_EOL,'', $data['content']);
            $data['content'] = str_replace(array("\r\n", "\r", "\n"), "", $data['content']);
            tpl::assign('data',$data);



            if(file_exists(PATH_ROOT.'/templates/template/admin/'.$this->ct.'.'.$this->ac.'.tpl')){

                tpl::display($this->ct.'.'.$this->ac.'.tpl');
            }else{
                exit('no tpl file');
            }
        }

    }


    public function add()
    {
        cls_msgbox::show('系统提示','错误操作',-1);
        exit();
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

