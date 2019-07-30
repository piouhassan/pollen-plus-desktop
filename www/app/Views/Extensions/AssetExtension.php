<?php


namespace App\Views\Extensions;


class AssetExtension extends  \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('asset', [$this , 'asset'], ['is_safe' => ['html']])
        ];
    }


    public function asset($value)
    {
        return  '/../../'.$value;
    }

}