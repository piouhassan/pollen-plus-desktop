<?php


namespace App\Views\Extensions;


class StatusExtension extends \Twig_Extension
{
    
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('status', [$this, 'status'],[
                'is_safe' => ['html']
            ])
        ];
    }
    
    public function status(string $started_at, string $ended_at)
    {
        $status = '';
        $now = new \DateTime('now');
        $start = new \DateTime($started_at);
        $end = new \DateTime($ended_at);


        $e =  $end->getTimestamp();
        $d = $start->getTimestamp();
        $n = $now->getTimestamp();

        $before =( ($d - $n) / 3600) / 24;

        $after =( ($e - $d) /3600) / 24;

        if ($start  > $now) {
            $status = 'Debut dans '.round($before).' Jours';
        }else{
            $status = 'Reste '.round($after).' Jours';
        }
        return "<button type=\"button\" class=\"btn btn-success btn-xs\">{$status}</button>";
    }
    
}