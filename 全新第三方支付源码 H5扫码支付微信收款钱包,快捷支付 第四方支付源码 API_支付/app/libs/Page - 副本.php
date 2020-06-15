<?php

namespace WY\app\libs;

if (!defined('WY_ROOT')) {
    exit;
}
class Page
{
    public $page = 1;
    public $pagesize = 0;
    public $totalsize = 0;
    public $buchang = 5;
    public $pagelimit = 5;
    public $pageinfo = '条记录';
    public $url = '/';
    function put($data)
    {
        if (!$data) {
            return false;
        }
        foreach ($data as $key => $val) {
            $this->{$key} = $val;
        }
        $totalpage = ceil($this->totalsize / $this->pagesize);
        $totalpage = $totalpage ? $totalpage : 1;
        $this->page = $this->page > $totalpage ? $totalpage : $this->page;
        $nextpage = $this->page - 1;
        $prev = $this->page > 1 ? '<a href="' . $this->url . $nextpage . '">上一页</a>' : '';
        $nextpage = $this->page + 1;
        $next = $this->page < $totalpage ? '<a href="' . $this->url . $nextpage . '">下一页</a>' : '';
        if ($totalpage <= $this->pagelimit) {
            $list = '';
            for ($i = 1; $i <= $totalpage; $i++) {
                $current = $this->page == $i ? ' class="wy_page_current" ' : '';
                $list .= '<a href="' . $this->url . $i . '"' . $current . '>第' . $i . '页</a>';
            }
            $list = $prev . $list . $next;
        }
        if ($totalpage > $this->pagelimit) {
            $list = '';
            $i = 1;
            $plimit = 5;
            $firstpage = '';
            if ($this->page > $this->buchang) {
                $i = $this->page - $this->buchang + 1;
                $plimit = $this->page + $this->buchang;
                $firstpage = '<a href="' . $this->url . '1">1</a><a style="border:0;background:none">...</a>';
            }
            $lastpage = '<a style="border:0;background:none">...</a><a href="' . $this->url . $totalpage . '">' . $totalpage . '</a>';
            if ($totalpage - $this->page < $this->buchang) {
                $plimit = $totalpage + 1;
                $lastpage = '';
            }
            for ($i; $i < $plimit; $i++) {
                $current = $this->page == $i ? ' class="wy_page_current" ' : '';
                $list .= '<a href="' . $this->url . $i . '"' . $current . '>' . $i . '</a>';
            }
            $list = $prev . $firstpage . $list . $lastpage . $next;
        }
        $css = '<style>#wypage{font-size: 12px;}#wypage a{float:left;display:inline-block;border:1px solid #ddd;padding:4px  4px;margin-left:4px;margin-top:4px;text-decoration:none;color:#333;background-color:#fff;border-radius:2px;}#wypage a:hover{background-color:#ddd;}#wypage a.wy_page_current{background-color:#ddd;}</style>';
        return $css . '<div id="wypage">&nbsp;&nbsp;<a>每页' . $this->pagesize . '条，共' . $this->totalsize . $this->pageinfo . '</a><br><br><ul class="pagination">' . $list . '</ul></div>';
    }
}
?>