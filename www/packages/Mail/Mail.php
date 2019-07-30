<?php


namespace Akuren\Mail;


use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Mail
{
    
    
    /**
     * @return Swift_SmtpTransport
     */
    public function transport()
    {
        $transport = (new Swift_SmtpTransport('localhost', 1026));
        return $transport;
    }
    
    
    /**
     * @param $subjet
     * @param $toMail
     * @param $message
     * @return int
     */
    public function message($subjet, $toMail, $message)
    {
        $mailer = new Swift_Mailer($this->transport());
        
        $messages = (new Swift_Message($subjet))
            ->setFrom(["pollenplus@contact.fr" => 'Pollen Plus'])
            ->setTo([$toMail])
            ->setBody($message);
        
        return $mailer->send($messages);
    }
    
    
}