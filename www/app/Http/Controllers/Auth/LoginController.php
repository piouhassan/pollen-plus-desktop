<?php


namespace App\Http\Controllers\Auth;


use Akuren\Session\Flash;
use Akuren\Session\Session;
use App\Http\Controllers\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginController extends Controller
{
    
    public function login(ServerRequestInterface $request, ResponseInterface $response)
    {

        if ($request->getMethod() === 'POST') {
            $username = $request->getParsedBody()['username'];
            $password = $request->getParsedBody()['password'];
            $auth = Auth::login($username, $password);
            if ($auth) {
                Flash::success('Vous etes connecter avec succes');
                return redirect('/dashboard');
            }
            Flash::error('Identifient ou Mot de Passe Invalide');

        }
        return $this->view->render($response, 'users/users.login.twig');
    }

    public function logout(ServerRequestInterface $request, ResponseInterface $response)
    {
        (new Session())->delete('auth.id');
        Flash::success('Vous etes deconnecter avec succes');
        redirect('/login');
    }
}