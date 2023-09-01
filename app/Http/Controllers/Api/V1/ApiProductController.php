<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ApiProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);

        return response()->json(['products' => $products]);
    }
}
