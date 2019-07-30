<?php
/**
 * Created by PhpStorm.
 * User: Michel Akpabla
 * Date: 20/01/2019
 * Time: 19:58
 */

namespace App\Views\Extensions;


class SlugExtension extends \Twig_Extension
{
    
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('slug', [$this, 'slug'])
        ];
    }
    
    public function slug(string $username)
    {
        $slug = implode('-', explode('.', $username));
        return strtolower($slug);
    }
    
}