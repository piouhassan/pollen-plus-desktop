<?php
namespace App\Views\Extensions;

use Akuren\Session\Session;

class AuthExtension extends \Twig_Extension
{
    
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('auth', [$this, 'auth'])
        ];
    }
    
    public function auth(string $key)
    {
        return (new Session())->get('auth.user')[$key];
    }
}