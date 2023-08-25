<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show()
    {
        $products = Product::paginate(5);
        return view('products', ['products' =>$products]);
    }
}
