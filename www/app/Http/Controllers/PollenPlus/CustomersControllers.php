<?php

namespace App\Http\Controllers\PollenPlus;

use Akuren\Query\Query;
use Akuren\Session\Flash;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CustomersControllers extends Controller
{
    /**
     * Afficher la liste des clients
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
        $customers =Customers::where(["status"  =>  10])->get();
        $auth = $request->getAttribute('user');
        return $this->view->render($response, '/customers/customers.index.twig', compact('customers', 'auth'));
    }
    
    /**
     * Ajouter un nouveau client
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
                $customers = new Customers();
                foreach ($fields as $key => $value) {
                    $customers->$key = $fields[$key];
                }
                $customers->save();
                Flash::success('Client ajouter');
                redirect('/customers');
            }
            $errors = $validator->getErrors();
        }
        $customers = $request->getParsedBody();
        $auth = $request->getAttribute('user');
        return $this->view->render($response, '/customers/customers.create.twig', compact('customers', 'errors', 'auth'));
    }
    
    public function delete(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');
        Customers::where(['id' => $id])->update(['status' =>  20 ]);
        Flash::success('Client Supprimer avec success');
        redirect('/customers');
    }
    
    private function getFields(ServerRequestInterface $request)
    {
        return array_filter($request->getParsedBody(), function ($key) {
            return in_array($key, ['structure', 'name', 'email', 'phone', 'city', 'country', 'address', 'siteweb']);
        }, ARRAY_FILTER_USE_KEY);
        
    }
    
    /**
     * Verifier la validiter des entrees
     * @param ServerRequestInterface $request
     * @return \Akuren\Validator\Validator
     */
    public function getValidator(ServerRequestInterface $request)
    {
        return parent::getValidator($request)
            ->required('structure', 'name', 'email', 'phone', 'city', 'country', 'address', 'siteweb')
            ->notEmpty('structure', 'name', 'email', 'phone', 'city', 'country', 'address')
            ->isNumber('phone', 8)
            ->isEmail('email');
    }
}