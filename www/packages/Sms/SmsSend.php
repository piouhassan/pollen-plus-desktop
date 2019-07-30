<?php
/**
 * Created by PhpStorm.
 * User: Stephane
 * Date: 20/04/2019
 * Time: 10:01
 */

namespace Akuren\Sms;


class SmsSend
{
    private $sender;
    private $message;
    private  $receiver;
    private  $returnLink;
    protected $access_token =  "wFZyEerY3Dk-Mki5msSFB21Kief0MH4F";


    public function sender(string  $sender)
    {
         $this->sender = $sender;
         return $this;
    }

    public function message(string  $message)
    {
        $this->message = urlencode($message);
        return $this;
    }

    public function receiver(string $receiver)
    {
        $this->receiver = $receiver;
        return $this;
    }

    public function returnLink(string $link)
    {
        $this->returnLink = $link;
        return $this;
    }

    public function send() {
        set_time_limit(0);
        $url = "http://www.wassasms.com/wassasms/api/web/v3/sends?access-token=".$this->access_token."&sender=".$this->sender."&receiver=".$this->receiver."&text=".$this->message."&dlr_url=".$this->returnLink;
        // $url = "http://".$_SERVER["HTTP_HOST"].Yii::$app->request->baseUrl."/api/web/v3/sends?access-token=O1Yk--5TCb-792TKyOTBG5RVJTlrNIML";
        $curl = curl_init();
        //trim($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $return = curl_exec($curl);
        $retour = trim($return);

        if ($retour) {
            return true;
        }
    }

}