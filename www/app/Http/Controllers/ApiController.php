<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


class ApiController extends Controller
{


    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
            $users = Users::all();

        return  $this->view->Json(compact('users'));
    }
}