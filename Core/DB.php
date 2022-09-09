<?php


namespace Core;

use \PDO;

class DB
{
    public static function getConnection()
    {
        $params = include('db_params.php');
        return new PDO("mysql:host=mariadb;dbname={$params['dbname']}", $params['user'], $params['password']);
    }

    //получение новостей для страницы с анонсами
    public static function getAllAnnounces()
    {
        $db = DB::getConnection();
        $result = $db->query('SELECT id, idate, title, announce FROM techart.news ORDER BY idate DESC');
        $i = 0;
        while ($row = $result->fetch()) {
            $messages[$i]['id'] = $row['id'];
            $messages[$i]['idate'] = $row['idate'];
            $messages[$i]['title'] = $row['title'];
            $messages[$i]['announce'] = $row['announce'];
            $i++;
        }
        for ($j = 0; $j < $i; $j++) {
            $messages[$j]['idate'] = gmdate("d.m.Y", $messages[$j]['idate']);
        }
        return $messages;
    }

    //получение одной по id

    /**
     * @param integer $id
     */
    public static function getById($id)
    {
        $db = DB::getConnection();
        $sth = $db->prepare("SELECT * FROM techart.news WHERE id = :id");
        $sth->execute(array('id' => $id));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    //подсчёт всех записей
    public static function countMessages(): int
    {
        $db = DB::getConnection();
        $arr = DB::getAllAnnounces();
        $number = count($arr);
        //echo 'Записей'.$number;
        return $number;
    }
}