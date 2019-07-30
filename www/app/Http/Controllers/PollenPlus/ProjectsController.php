<?php

namespace App\Http\Controllers\PollenPlus;

use Akuren\Query\Query;
use Akuren\Session\Flash;
use Akuren\Validator\Validator;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Projects;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProjectsController extends Controller
{
    /**
     * Afficher la liste des projets
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
        $projects = Projects::where(["status"  =>  10])->get();
        //$users = Users::where('id', explode($projects->members));
        //var_dump($projects);
        //die;
        $auth = $request->getAttribute('user');
        return $this->view->render($response, 'projects/projects.index.twig', compact('projects', 'auth'));
    }
    
    /**
     * Ajouter un nouveau projet
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function create(ServerRequestInterface $request, ResponseInterface $response)
    {
        if ($request->getMethod() === 'POST') {
            $validator = $this->getValidator($request);
            if ($validator->isValid()) {
                $fields = $this->getFields($request);
                $usersId = $request->getParsedBody()['members'];
                $project = new Projects();
                foreach ($fields as $key => $value) {
                    $project->$key = $fields[$key];
                }

                $project->save();
                $project->user()->sync($usersId, false);
                Flash::success('Le projet a été ajouter');
                redirect('/projects');
            }
            $errors = $validator->getErrors();
        }
        $customers = Customers::where(["status"  =>  10])->get();
        $users = Query::table('users')->get();
        $project = $request->getParsedBody();
        $auth = $request->getAttribute('user');
        return $this->view->render($response, 'projects/projects.create.twig', compact('customers', 'users', 'errors', 'project', 'auth'));
    }
    
    /**
     * Voir un projet en particulier
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function show(ServerRequestInterface $request, ResponseInterface $response)
    {
        /*$project = Query::table('projects')->select('projects.id', 'projects.name', 'projects.type', 'projects.description')
            ->join('customers')
            ->on('projects.customer_id = customers.id')
            ->where("projects.id = {$request->getAttribute('id')}")
            ->get(true);*/
        $project = Projects::with('customer')->find($request->getAttribute('id'));
        $auth = $request->getAttribute('user');
        return $this->view->render($response, 'projects/projects.show.twig', compact('project', 'auth'));
    }
    
    /**
     * Suppression de projets
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     */
    public function delete(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');
        Projects::where(['id' => $id])->update(['status' =>  20 ]);
        Flash::success('Projet Supprimer avec success');
        redirect('/projects');
    }

    public function update(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');
        $slug = $request->getAttribute('slug');
        if ($slug === 'start') {
            $start = Projects::where('id', $id)->update(['start' => true]);
            if ($start) {
                Flash::success('Le projet a ete demarer avec success');
                redirect("/projects/{$id}");
            }
        }
        if ($slug === 'pause') {
            $start = Projects::where('id', $id)->update(['start' => false]);
            if ($start) {
                Flash::warning('Le projet a ete mis en pause');
                redirect("/projects/{$id}");
            }
        }
    }
    
    /**
     * Recuperer les champs
     * @param ServerRequestInterface $request
     * @return array
     */
    private function getFields(ServerRequestInterface $request)
    {
        return array_filter($request->getParsedBody(), function ($key) {
            return in_array($key, ['name', 'type', 'customer_id', 'budget', 'started_at', 'ended_at', 'description','month']);
        }, ARRAY_FILTER_USE_KEY);
    }
    
    /**
     * Verifier si les donnees sont valide
     * @param ServerRequestInterface $request
     * @return Validator
     */
    public function getValidator(ServerRequestInterface $request)
    {
        return parent::getValidator($request)
            ->required('name', 'type', 'customer_id', 'budget', 'started_at', 'ended_at', 'description', 'members')
            ->notEmpty('name', 'type', 'customer_id', 'budget', 'started_at', 'ended_at', 'description', 'members')
            ->dateTime('started_at')
            ->dateTime('ended_at');
    }
}