<?php
namespace App\Views\Extensions;

class PasswordExtension extends \Twig_Extension
{
    
    
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('password_generated', [$this, 'passwordGenerated'])
        ];
    }
    
    public function passwordGenerated(): string
    {
        return uniqid();
    }
}