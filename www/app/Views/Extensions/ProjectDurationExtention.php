<?php
namespace App\Views\Extensions;

class ProjectDurationExtention extends \Twig_Extension
{
    
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('project_duration', [$this, 'projectDuration'], [
                'is_safe' => ['html']
            ])
        ];
    }
    
    public function projectDuration(string $started_at, string $ended_at)
    {
        $start = new \DateTime($started_at);
        $end = new \DateTime($ended_at);
        $interval = $start->diff($end);
        return $interval->days;
        
    }
}