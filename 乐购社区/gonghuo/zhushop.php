<?

  
include('../system/inc.php');
include('./admin_config.php');
include('./check.php');
 
//主站查询
		$result1 = mysql_query('select * from '.flag.'zhuzhan_domain where name = "'.$_GET['url'].'" ');
			 if ($row = mysql_fetch_array($result1))
			 {$zhuzhanid=$row['zid'];$zhuzhanname=$row['name']; }
			 else
			 {$zhuzhanid=0;$zhuzhanname='不存在'; }



 ?>
 <input name="zid" type="hidden" value="<?=$zhuzhanid?>">
      
       <div class="form-group" >
                                      <label class="col-lg-3 control-label">主站名称</label>
                                        <div class="col-lg-8">
                                                                        <input type="text" name=""   id=""    readonly value="<?=$zhuzhanname?>(<?=$zhuzhanid?>)" class="form-control">
 
                                        </div>
                                </div>
             
             
             
              <div class="form-group" >
                                      <label class="col-lg-3 control-label">选择商品</label>
                                        <div class="col-lg-8">
                                            <select class="form-control" v-model="apiType"   id="sid"  name="sid">
                                                <option    value="">请选择对接商品</option>
										      <?php
					 
						$result = mysql_query('select * from  '.flag.'shop where zt = 1  and zid = '.$zhuzhanid.' order by sorder desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                                                <option    value="<?=$row['ID']?>"><?=$row['name']?></option>
                                                <? }?>
                                           
                                             </select>
                                        </div>
                                </div>
             
             
                 <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">加价模板</label>
                                        <div class="col-lg-8">
                                            <select class="form-control" v-model="apiType"  ID="s_pid" name="s_pid">
                                                <option    value="">请选择加价模板</option>
                                            <?php
					 
						$result = mysql_query('select * from '.flag.'price where zid = '.$zhu_id.'  and fid = 0 order by ID desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                                                <option    value="<?=$row['ID']?>"><?=$row['p_name']?></option>
                                                <? }?>
                                             </select>
                                        </div>
                                </div>
             
             
             
             
             
             
                                        <div class="form-group" v-if="apiKind==='95'">
                                      <label class="col-lg-3 control-label">商品分类</label>
                                        <div class="col-lg-8">
                                            <select class="form-control"  id="s_cid" v-model="apiType"  name="s_cid">
                                                <option    value="">请选择分类</option>
                                            <?php
					 
						$result = mysql_query('select * from  '.flag.'shop_channel where zt = 1  and zid = '.$zhu_id.' order by corder desc ,ID desc');
						while($row = mysql_fetch_array($result)){
						?>
						
                                                <option    value="<?=$row['ID']?>"><?=$row['name']?></option>
                                                <? }?>
                                             </select>
                                        </div>
                                </div>
                                
 
   
                                
                         
                                        <div class="form-group">
                                  <label class="col-lg-3 control-label">商品价格</label>
                                    <div class="col-lg-8">
                             <input type="text" name="s_price"   id="s_price" placeholder="请输入商品价格" value="" class="form-control">

                                    </div>
                                </div>
                                
                                  <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=get_fenzhan_banben_name(1)?>价格</label>
                                    <div class="col-lg-8">
                             <input type="text" name="s_fprice1"   id="s_fprice1" placeholder="请输入<?=get_fenzhan_banben_name(1)?>的拿货价格" value="" class="form-control">

                                    </div>
                                </div>
                                
                                
                                  <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=get_fenzhan_banben_name(2)?>价格</label>
                                    <div class="col-lg-8">
                             <input type="text" name="s_fprice2"   id="s_fprice2" placeholder="请输入<?=get_fenzhan_banben_name(2)?>的拿货价格" value="" class="form-control">

                                    </div>
                                </div>
                                
                                  <div class="form-group">
                                  <label class="col-lg-3 control-label"><?=get_fenzhan_banben_name(3)?>价格</label>
                                    <div class="col-lg-8">
                             <input type="text" name="s_fprice3" id="s_fprice3" placeholder="请输入<?=get_fenzhan_banben_name(3)?>的拿货价格" value="" class="form-control">

                                    </div>
                                </div>
                                
                                
                                  
                                   
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">商品排序</label>
                                    <div class="col-lg-8">
                             <input name="s_order"  type="text" class="form-control" id="s_order" placeholder="请输入分类排序" value="0">

                                    </div>
                                </div>
        
 