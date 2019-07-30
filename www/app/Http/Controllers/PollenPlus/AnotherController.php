<?php
/**
 * Created by PhpStorm.
 * User: Stephane
 * Date: 14/04/2019
 * Time: 21:19
 */

namespace App\Http\Controllers\PollenPlus;


use Akuren\Session\Flash;
use Akuren\Sms\SmsSend;
use Akuren\Whois\Domain;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Projects;
use App\Models\Users;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AnotherController extends Controller
{


    public function recovery(ServerRequestInterface $request, ResponseInterface $response)
    {
        $auth = $request->getAttribute('user');
        $customers = Customers::where(['status' => 20])->get();
        $projects = Projects::where(['status' => 20])->get();
        $users = Users::where(['status' => 20])->get();
        return $this->view->render($response,'recovery/data.twig',compact('auth','customers','projects','users'));
    }


    public function notification(ServerRequestInterface $request, ResponseInterface $response)
    {
        $auth = $request->getAttribute('user');
        $customers = Customers::where(['status' => 10])->get();
        return $this->view->render($response,'recovery/notification.twig',compact('auth','customers'));
    }

    public function domain(ServerRequestInterface $request, ResponseInterface $response)
    {
        $auth = $request->getAttribute('user');
        return $this->view->render($response,'recovery/domain.twig',compact('auth'));
    }


    public function domainask(ServerRequestInterface $request, ResponseInterface $response)
    {
        $result = "";

            $params = $request->getQueryParams();
            $domain = $params['whois'];
            $domain = trim($domain);
            if(substr(strtolower($domain), 0, 7) == "http://") $domain = substr($domain, 7);
            if(substr(strtolower($domain), 0, 4) == "www.") $domain = substr($domain, 4);

            $whois = new Domain();

            if($whois->ValidateIP($domain)) {
                $result = $this->LookupIP($domain);
                echo $result;
            }
            elseif($whois->ValidateDomain($domain)) {
                $result = $whois->LookupDomain($domain);
                echo $result;
                die;
            }
            if ($result != ""){
                echo $result;
                die;
            }
die;
    }


    public function customerrecover(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');
        Customers::where(['id' => $id])->update(['status' =>  10 ]);
        Flash::success('Client recuperer avec success');
        redirect('/recovery/data');
    }
    public function projetrecover(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');
        Projects::where(['id' => $id])->update(['status' =>  10 ]);
        Flash::success('Projet recuperer avec success');
        redirect('/recovery/data');

    }

    public function userrecover(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');
        Users::where(['id' => $id])->update(['status' =>  10 ]);
        Flash::success('Utilisateur recuperer avec success');
        redirect('/recovery/data');
    }



    public function customerdelete(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');
        Customers::where(['id' => $id])->delete();
        Flash::error('Client supprimer definitivement  avec success');
        redirect('/recovery/data');
    }
    public function projetdelete(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');
        Projects::where(['id' => $id])->delete();
        Flash::error('Projet supprimer definitivement  avec success');
        redirect('/recovery/data');

    }

    public function userdelete(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');
        Users::where(['id' => $id])->delete();
        Flash::error('Utilisateur supprimer definitivement  avec success');
        redirect('/recovery/data');
    }


    public function notificationsend(ServerRequestInterface $request, ResponseInterface $response)
    {
           if ($request->getMethod() == 'POST'){

               $params = $this->getParams($request);

               if (!empty($params['destinataire'])  &&   empty($params['destinataire1'])  ){
                   $sms = new SmsSend();
                   $send =  $sms->receiver($params['destinataire'])->sender($params['emitter'])->message($params['message'])->returnLink($params['url'])->send();
                   if ($send){
                       Flash::success('Message envoyer avec Succes');
                       redirect('/notification/push');
                   }else{
                       Flash::error("Une erreur s'est produite ");
                       redirect('/notification/push');
                   }

               }
               if (!empty($params['destinataire'])  &&   !empty($params['destinataire1'])  ){
                   Flash::error("Ne choisir qu'un seul destinataire");
                   redirect('/notification/push');
               }


               if (!empty($params['destinataire1'])  &&  empty($params['destinataire'])){
                   $sms = new SmsSend();
                   $send =  $sms->receiver($params['destinataire1'])->sender($params['emitter'])->message($params['message'])->returnLink($params['url'])->send();
                   if ($send){
                       Flash::success('Message envoyer avec Succes');
                       redirect('/notification/push');
                   }
                   else{
                       Flash::error("Une erreur s'est produite ");
                       redirect('/notification/push');
                   }
               }

           }
    }


}

