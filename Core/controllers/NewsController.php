<?php

namespace Core;

class NewsController extends Controller
{
    //Страница со списком всех новостей
    public function actionIndex():void
    {
        $notes = DB::getAllAnnounces();
        $limit = 5;
        $pages = count($notes);
        $arr = Model::pagination($limit, $pages);
        extract($arr);
        $messageListCut = array_slice($notes, $page, $num);
        $this->view->render('Все новости', ['notes' => $messageListCut, 'pageCount' => $pageCount, 'nav' => $nav]);
    }

    //Страница одной новости
    public function actionView($id):void
    {
        $note = DB::getById($id);
        if (!$note) {
            http_response_code(404);
            exit();
        }
        $this->view->render('Одна новость', ['note' => $note]);
    }

}