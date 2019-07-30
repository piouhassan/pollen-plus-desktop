<?php
namespace App\Views\Extensions;

class MonthExtension extends \Twig_Extension
{


    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('month', [$this, 'month'])
        ];
    }

    public function month(): string
    {
       return date('M');
    }
}