<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class BrandController extends Controller
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

        return view('admin.brands.index', ['brands' =>$brands]);
    }
}
