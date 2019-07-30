<?php
namespace App\Http\Controllers\PollenPlus;

use Akuren\Crypting\Crypt;
use Akuren\File\File;
use Akuren\Session\Flash;
use App\Http\Controllers\Auth\Auth;
use App\Http\Controllers\Controller;
use App\Models\Users;
use Carbon\Carbon;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class UsersController extends Controller
{



    /**
     * Recuperer la liste de tous les utilisateurs
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
        $users = Users::where(["status"  =>  10])->get(); //Query::table('users')->get();$auth->getUser()->id
        $auth = $request->getAttribute('user');
        return $this->view->render($response, 'users/users.index.twig', compact('users', 'auth'));
    }
    
    /**
     * Permet d'ajouter un utilisateur
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function create(ServerRequestInterface $request, ResponseInterface $response)
    {
        if ($request->getMethod() === 'POST') {
            function isAjax(){
                return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
            }
            $validator = $this->getValidator($request);
            if ($validator->isValid()) {
                $users = new Users();
                $field = $this->getFields($request);
                foreach ($field as $key => $value) {
                    
                    if ($key == 'password') {
                        $users->$key = Crypt::make($field[$key]);
                    } else {
                        $users->$key = $field[$key];
                    }
                    
                }
                $users->save();
                Flash::success('Utilisateur ajouter avec success');
                redirect('/users');
            }
            $errors = $validator->getErrors();
        }
        $user = $request->getParsedBody();
        $auth = $request->getAttribute('user');
        return $this->view->render($response, 'users/users.create.twig', compact('user', 'errors', 'auth'));
    }
    
    
    public function edit(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');
        $user = Users::where(['id' => $id, "status"  =>  10])->first();
        $auth = $request->getAttribute('user');
        return $this->view->render($response, 'users/users.edit.twig', compact('user', 'auth'));
    }
    /**
     * Permet de supprimer un utilisateur par le biais de son id
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     */
    public function delete(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');
        Users::where(['id' => $id])->update(['status' =>  20 ]);
        Flash::success('Utilisateur Supprimer avec success');
        redirect('/users');
    }
    
    /**
     * Permet de voir un utilisateur en particulier
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function show(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');
        $user = Users::find($id);
        $auth = $request->getAttribute('user');
        return $this->view->render($response, 'users/users.show.twig', compact('user', 'auth'));
    }

    public function editProfile(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');
        $user = Users::where(['id' => $id])->first();
        if($request->getMethod() === "POST"){
            $params = $this->getParams($request);
                $params['avatar'] = File::to()->upload($params['avatar'], $user->avatar);
            $name = $params['username'];
            $email = $params['email'];
            $numero = $params['number'];
            $picture = $params['avatar'];
            $data = [
                'username' =>$name,
                'email' =>  $email,
                'phone' => $numero,
                'avatar' => $picture,
                'updated_at' => Carbon::now()
            ];

            Users::where(['id' => $id])->update($data);

            Flash::success('Utilisateur modifié  avec succes');

            redirect("/users/profile/{$id}");


        }
    }
    
    /**
     * Permet de recuperer les champs du formulaire a inserer
     * @param ServerRequestInterface $request
     * @return array
     */
    private function getFields(ServerRequestInterface $request)
    {
        return array_filter($request->getParsedBody(), function ($key) {
            return in_array($key, ['name', 'username', 'email', 'role', 'phone', 'gender', 'password', 'work']);
        }, ARRAY_FILTER_USE_KEY);
    }

    public function editCompletProfile(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');
        $user = Users::where(['id' => $id])->first();
        if($request->getMethod() === "POST"){
            $params = $this->getParams($request);
            $username = $params['username'];
            $name = $params["name"];
            $email = $params['email'];
            $role = $params['role'];
            $work = $params['work'];
            $numero = $params['phone'];
            $data = [
                'name' => $name,
                'username' =>$username,
                'email' =>  $email,
                'phone' => $numero,
                'role' => $role,
                'work' => $work,
                'updated_at' => Carbon::now()
            ];

            Users::where(['id' => $id])->update($data);

            Flash::success('Utilisateur modifié  avec succes');

            redirect("/users");


        }
    }

    
    /**
     * Verifie si les donnees entrer sont valide
     * @param ServerRequestInterface $request
     * @return \Akuren\Validator\Validator
     */
    public function getValidator(ServerRequestInterface $request)
    {
        return parent::getValidator($request)
            ->required('name', 'username', 'email', 'phone', 'role', 'gender', 'work')
            ->notEmpty('name', 'username', 'email', 'phone', 'role', 'gender', 'work')
            ->username('username')
            ->isNumber('phone', 9)
            ->isEmail('email');
    }
    
}