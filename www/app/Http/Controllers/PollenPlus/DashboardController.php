<?php
namespace App\Http\Controllers\PollenPlus;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Invoices;
use App\Models\Projects;
use App\Models\Users;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DashboardController extends Controller
{
    
    public function dashboard(ServerRequestInterface $request, ResponseInterface $response)
    {

        $janvier = Projects::where(['status' => 10])->Where(['month' => "Jan"])->count();
        $fevrier = Projects::where(['status' => 10])->Where(['month' => "Feb"])->count();
        $mars = Projects::where(['status' => 10])->Where(['month' => "Mar"])->count();
        $avril = Projects::where(['status' => 10])->Where(['month' => "Apr"])->count();
        $mai = Projects::where(['status' => 10])->Where(['month' => "May"])->count();
        $jiun = Projects::where(['status' => 10])->Where(['month' => "Jun"])->count();
        $juillet = Projects::where(['status' => 10])->Where(['month' => "Jul"])->count();
        $aout = Projects::where(['status' => 10])->Where(['month' => "Aug"])->count();
        $septembre= Projects::where(['status' => 10])->Where(['month' => "Sep"])->count();
        $octobre = Projects::where(['status' => 10])->Where(['month' => "Oct"])->count();
        $novembre = Projects::where(['status' => 10])->Where(['month' => "Nov"])->count();
        $decembre = Projects::where(['status' => 10])->Where(['month' => "Dec"])->count();

$data = [$janvier,$fevrier,$mars,$avril,$mai,$jiun,$juillet,$aout,$septembre,$octobre,$novembre,$decembre];

$data = implode($data,',');
        $users = Users::where(['status' => 10])->count();
        $projects = Projects::where(['status' => 10])->count();
        $customers = Customers::where(['status' => 10])->count();
        $invoice = Invoices::all()->count();
        $auth = $request->getAttribute('user');
        return $this->view->render($response, '/index.twig', compact('users', 'projects', 'customers', 'auth','invoice','data'));
    }
}