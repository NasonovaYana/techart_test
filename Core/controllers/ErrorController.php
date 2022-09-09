<?php


namespace Core;


class ErrorController extends Controller
{
    //Вызов собственной страницы ошибки 404
    public function actionNotFound():void
    {
        $this->view->render('404');
    }
}