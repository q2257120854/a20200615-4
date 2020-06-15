<?php
if( !defined('CORE') ) exit('Request Error!');

class ctl_fxdltxzh extends common{
    // 自动验证设置
    protected $_submit_validate     =   array(
		'type'=>array('','notempty','收款平台必须','all'),
        'zhanghao'=>array('','notempty','收款账号必须','all'),
        'name'=>array('','notempty','收款昵称必须','all'),
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
            'allTableField'=>array('id'=>'编号','uid'=>'用户id','type'=>'收款平台','zhanghao'=>'账号','name'=>'昵称','money'=>'提现金额','status'=>'操作状态','bz'=>'备注','time'=>'添加时间'),
            'addTableField'=>array('type','zhanghao','name','money'),
			
            'editTableField'=>array('type','status','bz'),
           
            'listTableField'=>array('type','money','zhanghao','name','status','time','bz'),
			
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
        if(cls_access::$accctl->uid=='1'){
            $where_arr = array();
        }else{
            $where_arr = array('`uid`="'.cls_access::$accctl->uid.'"');
        }
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


    /**
     * 添加
     */
    public function add()
    {
        if(request('dosubmit',''))
        {
            $info=req::$posts;


            //自动验证
            if(isset($this->_submit_validate) && $this->_submit_validate){
                foreach($this->_submit_validate as $field=>$vali){
                    if(!isset($info[$field]) || empty($info[$field])){
                        if(($vali['3'] == 'all' || $vali['3'] == 'insert') && $vali['1']=='notempty'){
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
                        if(($vali['3'] == 'all' || $vali['3'] == 'insert') && $vali['1']=='unique'){
                            $arrTempData = array();
                            if(isset($vali['extend']) && $vali['extend']){
                                $arrtempWhere = array();
                                $arrtempWhere[] = '`'.$field.'`="'.$info[$field].'"';
                                foreach($vali['extend'] as $extendField){
                                    if(isset($info[$extendField]))$arrtempWhere[] = '`'.$extendField.'`="'.$info[$extendField].'"';
                                }
                                $strTempwhere = '';
                                if(!empty($arrtempWhere)) $strTempwhere = ' where '.implode(' and ', $arrtempWhere);
                                if($strTempwhere)$arrTempData = db::get_one('select `'.$this->_dbfield['mainKey'].'` from `'.$this->table.'` '.$strTempwhere.' limit 1');
                            }else{
                                $arrTempData = db::get_one('select `'.$this->_dbfield['mainKey'].'` from `'.$this->table.'` where `'.$field.'`="'.$info[$field].'" limit 1');
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
                        if(($vali['3'] == 'all' || $vali['3'] == 'insert')){
                            if($vali['1']=='value' && isset($vali['2'])){
                                $info[$field] = $vali['2'];
                            }elseif($vali['1']=='function' && isset($vali['2'])){
                                $info[$field] = $vali['2'];
                            }
                        }
                    }
                }
            }

            $uinfo = cls_access::$accctl->get_userinfos();

            $sqlx = "select * from `ffsm_orders` where cp='".$uinfo['uid']."' and status='1' and jiesuan='0'";
            $rowx = db::querylist($sqlx);

            $count = count($rowx);
            $total = 0;
            $oidarr = '';
            foreach($rowx as $v){
                $oidarr .= $v['id'].',';
                $total = $total+$v['money'];

            }

            $fencheng = '0.'.$uinfo['fencheng'];
            $total = $total*$fencheng;


            if(ceil($info['money'])>ceil($total)){
                cls_msgbox::show('系统提示','提现金额超出可用余额',-1);
                die;
            }


            $info['oidarr'] = $oidarr;
            $insertid=db::ins($this->table,$info);



            if($insertid)
            {
                //验证上传文件
                //req::$files['update_image']['tmp_name']
                if(isset($this->_uploadFile) && $this->_uploadFile){
                    foreach($this->_uploadFile as $field=>$arrItem){
                        if(isset(req::$files[$field]['tmp_name']) && !empty(req::$files[$field]['tmp_name'])){
                            $info[$field] = $this->update_image(req::$files[$field],$arrItem,$field,$insertid);
                            if($info[$field] && is_numeric($insertid) && $insertid>0){
                                db::query('update '.$this->table.' set `'.$field.'`="'. $info[$field].'" where `'.$this->_dbfield['mainKey'].'`='.$insertid.' limit 1');
                            }
                        }
                    }
                }

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

                $sql = 'UPDATE `ffsm_orders` SET `jiesuan` = "1" WHERE cp="'.cls_access::$accctl->uid.'" and `status` = "1" and jiesuan="0"';
                db::query($sql);

                cls_msgbox::show('系统提示', '提现成功!'.$count.'个订单进度提现状态!', '?ct='.$this->ct.'&ac='.$this->listPage);
            }
        }
        else
        {
            $uinfo = cls_access::$accctl->get_userinfos();
            //总金额
            $sqlx = "select * from `ffsm_orders` where cp='".$uinfo['uid']."' and status='1' and jiesuan='0'";
            $rowx = db::querylist($sqlx);
            $total = 0;
            foreach($rowx as $v){
                $total = $total+$v['money'];

            }
            $fencheng = '0.'.$uinfo['fencheng'];

            $total = $total*$fencheng;


            tpl::assign('total',$total);

            //addFieldAuto
            if(isset($this->_addFieldAuto) && $this->_addFieldAuto){
                $arrAddFieldAuto = array();
                foreach($this->_addFieldAuto as $field=>$vali){
                    if(req::$forms[$field]){
                        //tpl::assign($field,req::$forms[$field]);
                        $arrAddFieldAuto[$field] = req::$forms[$field];
                    }
                }

                tpl::assign('arrAddFieldAuto',$arrAddFieldAuto);
            }

        }

        //tpl::assign('arrData',db::fetch_all(db::query('select * from qz_country order by sort asc')));
        if(file_exists(PATH_ROOT.'/templates/template/admin/'.$this->ct.'.'.$this->ac.'.tpl')){
            tpl::display($this->ct.'.'.$this->ac.'.tpl');
        }else{
            exit('no tpl file');
        }
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

