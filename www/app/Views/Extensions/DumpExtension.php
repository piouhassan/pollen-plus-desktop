<?php


namespace App\Views\Extensions;


class DumpExtension extends  \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('dump', [$this , 'dump'], ['is_safe' => ['html']])
        ];
    }


    public function dump($value)
    {
        var_dump($value);
    }

}