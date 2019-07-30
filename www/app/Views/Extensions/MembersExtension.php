<?php
namespace App\Views\Extensions;

use Akuren\Query\Query;
use App\Models\Users;

class MembersExtension extends \Twig_Extension
{
    
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('members', [$this, 'members'], [
                'is_safe' => ['html'],
                'needs_context' => true
            ])
        ];
    }
    
    
    public function members(array $context)
    {
        var_dump($context);
        die;
    }
}