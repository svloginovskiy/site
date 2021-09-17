<?php


namespace app\Utility;


class Paginator
{
    public function __construct()
    {
    }

    public function help($postsCount, $postsPerPage, $pageNum, &$vars)
    {
        $lastPageNum = intdiv($postsCount, $postsPerPage) + ($postsCount % $postsPerPage == 0 ? 0 : 1);
        $vars['last'] = $lastPageNum;


        if ($pageNum == 1) {
            $vars['prev'] = 1;
            $vars['current'] = 2;
            $vars['next'] = 3;
            $vars['prevActive'] = true;
        } elseif ($pageNum == $lastPageNum) {
            $vars['prev'] = $pageNum - 2;
            $vars['current'] = $pageNum - 1;
            $vars['next'] = $pageNum;
            $vars['nextActive'] = true;
        } else {
            $vars['prev'] = $pageNum - 1;
            $vars['current'] = $pageNum;
            $vars['next'] = $pageNum + 1;
            $vars['curActive'] = true;
        }
    }
}