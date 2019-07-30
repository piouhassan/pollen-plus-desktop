<?php
namespace App\Http\Controllers\PollenPlus;

use AkConfig\App;
use Akuren\Mysql\Dumps;
use Akuren\Query\Query;
use Akuren\Session\Flash;
use Akuren\Sync\SyncDatabases;
use Apfelbox\FileDownload\FileDownload;
use App\Http\Controllers\Controller;
use App\Models\Databases;
use Carbon\Carbon;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


class DatabaseController extends Controller
{

    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
            $auth = $request->getAttribute('user');
            $database = Databases::all();
          $tables = SyncDatabases::TableAll();

          $content = SyncDatabases::sendSync('localhost','pollen_plus','invoices','root', '');
        return $this->view->render($response,'database/database.dump.twig',compact('auth','database','tables', 'content'));
    }


    public function  make(ServerRequestInterface $request, ResponseInterface $response)
    {
        $date = date('d-m-Y');
        $filename = "data".$date;
         Dumps::data("pollen_plus")->filename($filename)->dump();
        $data = [
           'fichier' => $filename,
            'created_at' => Carbon::now()
        ];

        $database = Databases::where(['fichier' => $filename])->count();

        if ($database > 0){
            Flash::error('base de donnée deja existant');
            redirect('/database/dump/list');
        }else{
            Databases::create($data);
            Flash::success('base de donnée sauvegarder avec succes');
            redirect('/database/dump/list');
        }


    }


    public function delete(ServerRequestInterface $request,ResponseInterface $response)
    {
               $id = $request->getAttribute('id');
                $content =  Databases::where(['id' => $id])->first();
               $dirname =   $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."dumps".DIRECTORY_SEPARATOR;
                 Databases::where(['id' => $id])->delete();
                $del = unlink($dirname.$content['fichier']);
                if ($del){
                    echo'Fichier de Base de Donnée SQL supprimer';
                    die;
                }
                else{
                    "Le Fichier de Base de Donnée SQL n'a pas pu etre supprimer";
                    die;
                }


        }


    public function download(ServerRequestInterface $request, ResponseInterface $response)
        {
            $id = $request->getAttribute('id');

            $data = Databases::where(['id' => $id])->first();

            $file = $data['fichier'].".sql";
            $dirname =   $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."dumps".DIRECTORY_SEPARATOR;
            $fileDownload = FileDownload::createFromFilePath($dirname.$file);
            $fileDownload->sendDownload($file);
    die;

        }



    public function databaseSync(ServerRequestInterface $request, ResponseInterface $response)
    {
    $params = $request->getQueryParams();
    $processus = $params['processus'];
    $database = $params['database'];
    $table = $params['table'];
    $host = $params['host'];
    $user = $params['user'];
    $password = $params['password'];

    if ($processus == 1){
        $content = Query::table($table)->get();

    }
    if ($processus == 2){
        #receive

    }


    }


}