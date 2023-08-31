<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->get('afterEdit')) {

            $currentPage = $request->session()->get('currentPage') ?? 1;
            $products = Product::paginate(5, ['*'], 'page', $currentPage);
            $request->session()->forget('afterEdit');

        } else {
            $products = Product::paginate(5);
            $currentPage = $products->currentPage();
            $request->session()->put('currentPage', $currentPage);
        }

        return view('admin.products.index', ['products' =>$products]);
    }

    public function create()
    {
        return view('admin.products.create-edit');
    }

    public function store(Request $request)
    {
        $this->_validate($request);
        $product = new Product();
        $this->_fill($request, $product);

        return redirect()->route('admin.products.create')->with('info', 'Saved');
    }

    public function edit($productId)
    {
        $product = Product::find($productId);

        return view('admin.products.create-edit', ['product' => $product]);
    }

    public function update(Request $request)
    {
        $this->_validate($request);
        $product = Product::find($request->id);
        $this->_fill($request, $product);
        $request->session()->put('afterEdit', true);

        return redirect()->route('admin.products.index')->with('info', 'Saved');
    }


    public function destroy(Request $request, $productId)
    {
        Product::destroy($productId);

        return redirect()->back()->withInput();
    }

    private function _validate(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'brand' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required',
            'currency' => 'required'
        ], [
            'name.required' => 'Enter product name',
            'name.max' => 'Title must be no more than :max characters',
            'brand.required' => 'Enter brand name',
            'price.required' => 'Enter price',
            'currency.required' => 'Enter currency'
        ]);
    }

    private function _fill(Request $request, $product)
    {
        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->price = $request->price;
        $product->currency = $request->currency;
        $product->status = $request->input('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/products', 'public'); // сохранение изображения
            $product->image = $imagePath;
        }
        $product->save();
    }
}
