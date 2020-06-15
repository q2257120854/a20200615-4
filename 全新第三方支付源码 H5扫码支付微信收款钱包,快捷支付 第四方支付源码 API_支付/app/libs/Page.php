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
    public $buchang = 3;
    public $pagelimit = 6;
    public $pageinfo = '条';
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
        $prev = $this->page > 1 ? '<li class="pagination__item"><a class="pagination__number" href="' . $this->url . $nextpage . '">上页</a></li>' : '';
        $nextpage = $this->page + 1;
        $next = $this->page < $totalpage ? '<li class="pagination__item"><a class="pagination__number"  href="' . $this->url . $nextpage . '">下页</a></li>' : '';
        if ($totalpage <= $this->pagelimit) {
            $list = '';
            for ($i = 1; $i <= $totalpage; $i++) {
                $current = $this->page == $i ? ' class="wy_page_current1" ' : '';
                $list .= '<li class="pagination__item"><a  href="' . $this->url . $i . '"' . $current . '>第' . $i . '页</a></li>';
            }
            $list = $prev . $list . $next;
        }
        if ($totalpage > $this->pagelimit) {
            $list = '';
            $i = 1;
            $plimit = 6;
            $firstpage = '';
            if ($this->page > $this->buchang) {
                $i = $this->page - $this->buchang + 1;
                $plimit = $this->page + $this->buchang;
                $firstpage = '<li class="pagination__item"><a class="pagination__number" href="' . $this->url . '1">1</a></li><li class="pagination__item"><a class="pagination__number">...</a></li>';
            }
            $lastpage = '<li class="pagination__item"><a class="pagination__number">...</a></li><li class="pagination__item"><a class="pagination__number" href="' . $this->url . $totalpage . '">' . $totalpage . '</a></li>';
            if ($totalpage - $this->page < $this->buchang) {
                $plimit = $totalpage + 1;
                $lastpage = '';
            }
            for ($i; $i < $plimit; $i++) {
                $current = $this->page == $i ? ' class="wy_page_current1" ' : '';
                $list .= '<li class="pagination__item"><a href="' . $this->url . $i . '"' . $current . '>' . $i . '</li>';
            }
            $list = $prev . $firstpage . $list . $lastpage . $next;
        }
        $css = '<style>.pagination__item a.wy_page_current1{background-color: #eee;border: 1px solid #ddd;}</style>';
        return $css . '<div class="demo"><ul class="pagination pagination_type1 pagination_type5"><li class="pagination__item"><a class="pagination__number">记录' . $this->totalsize . $this->pageinfo . '</a></li>' . $list . '</ul></div>';
    }
}
?>