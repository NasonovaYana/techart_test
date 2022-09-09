<?php


namespace Core;


class Model
{
    //Организация постраничной навигации
    public static function pagination($limit, $pages)
    {
        $pageCount = ceil($pages / $limit);
        if (isset($_GET['page'])) {
            $nav = $_GET['page'];
        } else {
            $nav = 0;
        }
        if ($nav > $pageCount) {
            http_response_code(404);
            exit();
        }
        $nav = intval($nav);
        if (!isset($_GET['page'])) {
            $page = 0;
        } else {
            $page = $_GET['page'] * $limit - $limit;
        }
        $num = $limit;
        if ($nav == 0) {
            $nav = 1;
        }
        return ['num' => $num, 'page' => $page, 'nav' => $nav, 'pageCount' => $pageCount];
    }
}