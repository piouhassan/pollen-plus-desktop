<?php
/**
 * Created by PhpStorm.
 * UserInterface: Tanza Studio
 * Date: 11/11/2018
 * Time: 14:23
 */

namespace App\Views\Extensions;


use League\Route\RouteCollection;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class RouteLinkExtension extends AbstractExtension
{
protected  $route;

    public function __construct(RouteCollection $route)
    {
        $this->route = $route;
    }

    public function getFunctions()
    {
    return [
       new  TwigFunction('link', [$this , 'link']),
    ];
   }

    public function link($routeName)
    {
      return  $this->route->getNamedRoute($routeName)->getPath();
   }

}