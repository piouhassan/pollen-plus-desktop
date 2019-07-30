<?php
/**
 * Created by PhpStorm.
 * User: Stephane
 * Date: 21/05/2019
 * Time: 23:28
 */

namespace Akuren\Sync;


use AkConfig\App;
use Akuren\Query\Query;
use PDO;

class SyncDatabases
{


    public static function  Database($host,$dbname,$user,$password)
    {
        try {
            $DB = new PDO("mysql:host=".$host.";dbname=".$dbname."", $user, $password);
            return $DB;
        } catch (Exception $e) {
           return false;
        }
    }


    public static function TableAll()
    {
        $DB = SyncDatabases::Database(App::DB_HOST,App::DB_NAME,App::DB_USER,App::DB_PASS);
        $query = $DB->prepare('show tables');
        $query->execute();
        $tables = $query->fetchAll(PDO::FETCH_ASSOC);
        return $tables;
    }


    public static function sendSync($host, $dbname ,$table , $user , $password)
    {
        $content = Query::table($table)->get();
        $DB = SyncDatabases::Database(App::DB_HOST,App::DB_NAME,App::DB_USER,App::DB_PASS);
        $sql = $DB->prepare("SHOW COLUMNS FROM  $table ");
        $sql->execute();
        $tables = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $tables;
    }

}