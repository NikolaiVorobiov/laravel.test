<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function productFormShow(Request $request)
    {
        return view('admin', ['info' => '']);
    }

    public function productFormSave(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:products|max:255',
            'brand' => 'required',
            'price' => 'required',
            'currency' => 'required'
        ], [
            'name.required' => 'Введите название продукта',
            'name.unique' => 'Такое название уже существует',
            'name.max' => 'Название должно быть не более :max символов',
            'brand.required' => 'Введите название бренда',
            'price.required' => 'Введите цену',
            'currency.required' => 'Введите валюту'
        ]);

        $product = new Product();

        $product->name = $validated['name'];
        $product->brand = $validated['brand'];
        $product->price = $validated['price'];
        $product->currency = $validated['currency'];
        $product->status = $request->input('status') ? 1 : 0;
        $product->save();
        $info = 'Сохранено';

        return view('admin', ['info' => $info]);
    }
}
