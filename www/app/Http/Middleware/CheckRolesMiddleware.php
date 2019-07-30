<?php

namespace App\Http\Middleware;

use Akuren\Auth\AuthInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CheckRolesMiddleware implements MiddlewareInterface
{
    /**
     * @var AuthInterface
     */
    private $auth;
    
    public function __construct(AuthInterface $auth)
    {
        
        $this->auth = $auth;
    }
    
    /**
     * Process an incoming server request and return a response, optionally delegating
     * response creation to a handler.
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $uri = $request->getUri()->getPath();
        $routeGroup = explode('/', $uri);
        $auth = $request->getAttribute('user');
        if ($auth->role === 'user' && in_array('users', $routeGroup)) {
            redirect('/dashboard');
        }
        
        return $handler->handle($request);
    }
}