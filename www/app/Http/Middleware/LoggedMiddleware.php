<?php


namespace App\Http\Middleware;


use Akuren\Auth\AuthInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoggedMiddleware implements MiddlewareInterface
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
        $user = $this->auth->getUser();
        $path = trim($request->getUri()->getPath(), '/');
        if (is_null($user) && $path != 'login') {
            \redirect('/login');
        }
        return $handler->handle($request->withAttribute('user', $user));
    }
}