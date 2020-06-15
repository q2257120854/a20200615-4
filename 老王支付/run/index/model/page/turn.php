<?php
namespace xh\run\index\model;
use xh\library\url;

class turn{
    //翻页
    public function auto($count, $page, $num)
    {
        if ($count!=1){
            if (strstr(url::get(),"?")){
                //正则解决重复page
                $url = preg_replace("/page=[\s\S]+/", "", url::get());//正则处理当前页面
                //搜索是否重复刷新页面
                $lastUtr = $url[strlen($url)-1]; 
                //判断是否有多重where
                if ($lastUtr != '&' && $lastUtr != '?'){
                    $url = $url . '&';
                }
            }else {
                $url = $url . '?';
            }
            $num = min($count, $num); // 处理显示的页码数大于总页数的情况
            if ($page > $count || $page < 1)
                return; // 处理非法页号的情况
                $end = $page + floor($num / 2) <= $count ? $page + floor($num / 2) : $count; // 计算结束页号
                $start = $end - $num + 1; // 计算开始页号
                if ($start < 1) { // 处理开始页号小于1的情况
                    $end -= $start - 1;
                    $start = 1;
                }
                $topPage = $page-1;//上一页
                $downPage = $page+1;//下一页
                //<li><a href="#">&#8249;</a></li>
                echo "<li class='waves-effect'><a href='{$url}page={$topPage}'><i class='mdi-navigation-chevron-left'></i></a></li>"; //上一页HTML代码
                if ($page == $count || $page>1 && $page<$count){
                    echo "<li class='waves-effect'><a href='{$url}page=1'>Index</a></li>";//首页HTML代码
                }
                for ($i = $start; $i <= $end; $i ++) { // 输出分页条，请自行添加链接样式
                    if ($i == $page){
                        //当前页HTML代码  
                        echo "<li class='active'><a href='#'>{$i}</a></li>";
                    }else{
                        //其他页HTML代码
                        echo "<li class='waves-effect'><a href='{$url}page=$i'>$i</a></li>";
                    }
                }
                if ($page == 1 || $page>1 && $page<$count){
                    //最后一页HTML代码
                    echo "<li class='waves-effect'><a href='{$url}page={$count}'>Last</a></li>";
                }
                //下一页HTML代码
                echo "<li class='waves-effect'><a href='{$url}page={$downPage}'><i class='mdi-navigation-chevron-right'></i></a></li>";
        }
    }
}