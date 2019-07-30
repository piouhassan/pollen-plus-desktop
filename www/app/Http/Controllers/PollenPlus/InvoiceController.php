<?php


namespace App\Http\Controllers\PollenPlus;


use Akuren\Session\Flash;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Invoices;
use App\Models\Products;
use Dompdf\Dompdf;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Spipu\Html2Pdf\Html2Pdf;


class InvoiceController extends Controller
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
        $auth = $request->getAttribute('user');
        $invoices = Invoices::get();
        return $this->view->render($response, 'invoices/invoices.index.twig', compact('auth', 'invoices'));
    }
    
    public function show(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');
        $invoice = Invoices::where(['id' => $id])->first();
        $auth = $request->getAttribute('user');
        $invoiceId = $invoice['id'] * 102565363;
        $products_sum = Products::where(['invoices_id' => $invoice['id']])->get();
        $subtotal = 0;
        foreach ($products_sum as  $product ) {
            $subtotal += $product->price * $product->quantity;
        }


         $tax = ($subtotal * $invoice->tax) / 100;
        $total = $subtotal + $tax;
        return $this->view->render($response, 'invoices/invoices.show.twig', compact('invoice', 'auth','invoiceId','subtotal','tax','total'));
    }
    
    /**
     * Ajouter une nouvelle facture
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function create(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $auth = $request->getAttribute('user');
        $customers = Customers::all();
        if ($request->getMethod() === 'POST') {
            $invoice = new Invoices();
            $fields = $this->getFields($request);
            foreach ($fields as $key => $value) {
                $invoice->$key = $fields[$key];
            }
            $invoice->save();
            Flash::success('Facture ajouter avec succes');
        }
        return $this->view->render($response, 'invoices/invoices.create.twig', compact('auth', 'customers'));
    }


    public function  templatepage(ServerRequestInterface $request, ResponseInterface $response)
    {
        $auth = $request->getAttribute('user');
        $id = $request->getAttribute('id');
        return $this->view->render($response, 'invoices/invoices.template.twig', compact('auth','id'));
    }



    public function  opengellar(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');

        $inv = Invoices::where(['id' => $id])->first();
        $customer = Customers::where(['id' => $inv['customers_id']])->first();
        $products = Products::where(['invoices_id' => $id])->get();
        $subtotal = 0;
        foreach ($products as  $product ) {
            $subtotal += $product->price * $product->quantity;
        }
        $tax = ($subtotal * $inv->tax) / 100;
        $total = $subtotal + $tax;

     $this->view->viewSimple('invoices/Template/default', compact('inv','customer','products','subtotal','tax','total'));
die;
    }


    public function  dentellar(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');

        $inv = Invoices::where(['id' => $id])->first();
        $customer = Customers::where(['id' => $inv['customers_id']])->first();
        $products = Products::where(['invoices_id' => $id])->get();
        $subtotal = 0;
        foreach ($products as  $product ) {
            $subtotal += $product->price * $product->quantity;
        }
        $tax = ($subtotal * $inv->tax) / 100;
        $total = $subtotal + $tax;

        $this->view->viewSimple('invoices/Template/light', compact('inv','customer','products','subtotal','tax','total'));
        die;
    }


    public function  amenellar(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');

        $inv = Invoices::where(['id' => $id])->first();
        $customer = Customers::where(['id' => $inv['customers_id']])->first();
        $products = Products::where(['invoices_id' => $id])->get();
        $subtotal = 0;
        foreach ($products as  $product ) {
            $subtotal += $product->price * $product->quantity;
        }
        $tax = ($subtotal * $inv->tax) / 100;
        $total = $subtotal + $tax;

        $this->view->viewSimple('invoices/Template/dark', compact('inv','customer','products','subtotal','tax','total'));
        die;
    }


    /**
     * Recuperer les champs
     * @param ServerRequestInterface $request
     * @return array
     */
    private function getFields(ServerRequestInterface $request)
    {
        return array_filter($request->getParsedBody(), function ($key) {
            return in_array($key, ['users_id', 'customers_id', 'tax', 'account', 'payment_method']);
        }, ARRAY_FILTER_USE_KEY);
    }



}