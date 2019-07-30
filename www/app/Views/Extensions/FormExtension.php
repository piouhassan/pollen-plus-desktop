<?php
namespace App\Views\Extensions;

use App\Blog\Entity\PostEntity;

/**
 * Class FormExtention
 * @package Framework\Twig
 */
class FormExtension extends \Twig_Extension
{
    /**
     * @return array|\Twig_Function[]
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('field', [$this, 'field'], [
                'is_safe' => ['html'],
                'needs_context' => true
            ])
        ];
    }
    
    /**
     * @param array $context
     * @param string $label
     * @param string $key
     * @param string $value
     * @param array $options
     * @return string
     */
    public function field(array $context, string $label, string $key, $value, array $options = []): string
    {
        $value = $this->convertValue($value);
        $errorHTML = $this->getErrorHTML($context, $key);
        $class = $this->getClass($options);
        if (!isset($options['type'])) {
            $input = $this->input($key, $value, $class);
        }
        if (isset($options['type']) && $options['type'] === 'textarea') {
            $input = $this->textArea($key, $value);
        }
        return "<div class='form-group'>
                    <label for=\"{$key}\">{$label}</label>
                    {$input}
                    {$errorHTML}
                </div>";
    }
    
    /**
     * @param string $key
     * @param string $value
     * @return string
     */
    private function textArea(string $key, $value): string
    {
        return "<textarea class='form-control' id=\"{$key}\" name=\"{$key}\">{$value}</textarea>";
    }
    
    /**
     * @param string $key
     * @param string $value
     * @param string $class
     * @return string
     */
    private function input(string $key, $value, string $class): string
    {
        return "<input type='text' class='{$class}' id=\"{$key}\" name=\"{$key}\" value=\"{$value}\">";
    }
    
    private function getErrorHTML(array $context, string $key): string
    {
        $error = $context['errors'][$key] ?? false;
        if ($error) {
            return "<small style='color: red;' class=\"form-group\">{$error}</small>";
        }
        return false;
    }
    private function convertValue($value): string
    {
        if ($value instanceof \DateTime) {
            return $value->format('Y-m-d H:i:s');
        }
        return (string)$value;
    }
    private function getClass(array $options = [])
    {
        if (isset($options['class'])) {
            return "form-control {$options['class']}";
        }
        return "form-control";
    }
}