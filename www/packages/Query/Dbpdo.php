<?php


namespace Akuren\Query;


use AkConfig\App;
use PDO;

class Dbpdo
{
    private $pdo;

    /**
     * @return PDO
     */
    protected function getPDO()
    {
        if ($this->pdo === null){
            try{
                $pdo = new PDO("mysql:host=".App::DB_HOST.";dbname=".App::DB_NAME, App::DB_USER, App::DB_PASS);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo = $pdo;

            }catch (PDOException $e) {
                die("Some error occured When connect to database" . $e->getMessage());
            }
        }
        return $this->pdo;
    }

    public function Myquery($statement, $class_name = null, $one = false)
    {
        $req = $this->getPDO()->query($statement);
        if (
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
        ){
            return $req;
        }

        if ($class_name === null){
            $req->setFetchMode(PDO::FETCH_OBJ);

        }else{
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }

        if($one){
            $datas = $req->fetch();

        }else{
            $datas = $req->fetchAll();

        }
        return $datas;
    }

    /**
     * @param $statement
     * @param $attributes
     * @param $class_name
     * @param bool $one
     * @return array|mixed
     */
    public function prepare($statement, $attributes = null, $class_name, $one = false){
        $req= $this->getPDO()->prepare($statement);

        $res  =  $req->execute($attributes);
        if (
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
        ){
            return $res;
        }

        if ($class_name === null){
            $req->setFetchMode(PDO::FETCH_OBJ);

        }else{
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }

        if($one){
            $datas = $req->fetch();

        }else{
            $datas = $req->fetchAll();

        }
        return $datas;
    }



}