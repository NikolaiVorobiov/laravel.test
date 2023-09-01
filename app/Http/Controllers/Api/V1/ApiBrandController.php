<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ApiBrandController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $brands = [];
        foreach ($products as $product) {
            if (!in_array($product->brand, $brands)) {
                $brands[] = $product->brand;
            }
        }

        return response()->json(['brands' =>$brands]);
    }
}
