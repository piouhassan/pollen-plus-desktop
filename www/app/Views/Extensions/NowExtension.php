<?php
namespace App\Views\Extensions;

class NowExtension extends \Twig_Extension
{


    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('now', [$this, 'now'])
        ];
    }

    public function now(): string
    {
       return date('d/M/Y');
    }
}