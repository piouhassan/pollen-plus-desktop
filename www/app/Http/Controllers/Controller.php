<?php


namespace App\Http\Controllers;


use Akuren\Validator\Validator;
use App\Views\View;
use Psr\Http\Message\ServerRequestInterface;


abstract class Controller
{
    protected $view;


    public function __construct()
    {
        $view = new View();

        $this->view = $view;
    }

    /**
     * @param ServerRequestInterface $request
     * @return array
     */
    public function getParams(ServerRequestInterface $request) : array
    {
        $params = array_merge( $request->getParsedBody(), $request->getUploadedFiles());
        return $params;
    }

    /**
     * @param ServerRequestInterface $request
     * @return Validator
     */
    public function getValidator(ServerRequestInterface $request)
    {
        return new Validator($request->getParsedBody());
    }



    /**public function redirect(ResponseInterface $response , string $path, array $params = []) : ResponseInterface{
        $redirectUri = $this->view->render($response, $path,$params);
        return (new Response())->withStatus(301)->withHeader('location', $redirectUri);
    }
**/

}