<?php
namespace App\Http\Controllers\PollenPlus;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductsController extends Controller
{
    
    
    public function create(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');
        $fields = $this->getFields($request);
        $products = new Products();

        foreach ($fields as $key => $value) {
            $products->$key = $fields[$key];
        }
        $products->save();
        redirect("/invoices/{$id}");
    }


    
    private function getFields(ServerRequestInterface $request):array
    {
        $fields =  array_filter($request->getParsedBody(), function ($key) {
            return in_array($key, ['name', 'description', 'price', 'quantity']);
        }, ARRAY_FILTER_USE_KEY);
        return array_merge($fields, [
            'invoices_id' => $request->getAttribute('id')
        ]);
    }
}