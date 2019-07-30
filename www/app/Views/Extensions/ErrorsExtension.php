<?php
namespace App\Views\Extensions;

class ErrorsExtension extends \Twig_Extension
{
    
    
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('error', [$this, 'error'], [
                'is_safe' => ['html'],
                'needs_context' => true
            ])
        ];
    }
    
    public function error(array $context, string $key)
    {
        $error = "Ce champ est valide";
        if (isset($context['errors']) && !empty($context['errors'])) {
            if (array_key_exists($key, $context['errors'])) {
                $error = $context['errors'][$key] ?? false;
                return "<div class=\"valid-feedback\" style=\"color: red;\">{$error}</div>";
            }
            return "<div class=\"valid-feedback\" style=\"color: #28a745;\">{$error}</div>";
        }
        
        return false;
    }
}