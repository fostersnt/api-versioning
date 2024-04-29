<?php

namespace App\Http\Controllers\API\V_1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Helpers\General;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function getProduct($product_id)
    {
        $product = Product::query()->find($product_id);
        return General::api_success_response($product, 'successful');
    }

    public function getProducts()
    {
        $products = Product::query()->get();
        return General::api_success_response($products, 'successful');
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function delete($product_id)
    {
     try {
        $product = Product::query()->find($product_id);
        if ($product) {
            $product->delete();
            return General::api_success_response($product, 'successful');
        } else {
            return General::api_failure_response(null, 'Unknown product Id');
        }
     } catch (\Throwable $th) {
        return General::api_failure_response(null, 'failed to delete product');
    }
    }
}
