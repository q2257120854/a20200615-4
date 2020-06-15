<?php
namespace xh\unity;
use xh\library\mysql;

//自动识别数据，并返回分页数据
class page{
    
    /**
     * @param unknown $table 要查询的表
     * @param unknown $page 当前页码
     * @param unknown $allPage 每页显示数量
     * @param unknown $where 加入判断条件
     * @param unknown $ap 字段隔离
     * @param string $order_by 排序字段
     * @param string $order_rank 排序方式
     * @return unknown|array
     */
    static public function conduct($table,$page,$allPage,$where=null,$ap=null,$order_by='id',$order_rank='desc'){
        $mysql = new mysql();
        $whereEx = null;
        //加入判断条件
        if (!empty($where)) $whereEx = 'where ' . $where;
        //计算全部记录数量
        $dataAllnum = $mysql->select("select count(id) as NUM from ". DB_PREFIX ."{$table} {$whereEx}")[0]['NUM'];
        //计算总页数
        $pageAll = ceil($dataAllnum / $allPage);
        //假设当前页面大于总页数
        if ($pageAll <= $page) $page = $pageAll;
        //假设当前页面小于1
        if ($page <= 1) $page = 1;
        //计算当前页码
        $current = ($page-1) * $allPage;
        $result = $mysql->query($table,$where,$ap,$order_by,$order_rank,"{$current},{$allPage}");
        return [
            'result'=>$result,
            'info'=>[
                'page'=>$page,
                'count'=>$dataAllnum,
                'pageAll'=>$pageAll,
                'pageResult'=>count($result)
            ]];
    }
    
}