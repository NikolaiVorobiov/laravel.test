<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::paginate(6);

        $countOrder = 0;
        if (($request->session()->get('orders')) ){
            $countOrder = count($request->session()->get('orders'));
        }

        return view('home', [
            'products' => $products,
            'cart' => $request->session()->has('cart'),
            'countOrder' => $countOrder
        ]);
    }

    public function addToCart(Request $request, $productId)
    {
        $product = Product::find($productId);
        $order = ['productId' => $productId, 'price' => $product->price];

        if ($request->session()->has('orders')) {;
            $orders = $request->session()->get('orders');
        } else {
            $orders = [];
            $request->session()->put('cart', true);
        }

        $orders[] = $order;
        $request->session()->put('orders', $orders);

        return redirect()->back()->withInput();
    }

    public function showCart(Request $request)
    {
        $orders = $request->session()->get('orders');

        dump(count($orders));

        if (count($orders) == 0) {
            return redirect()->route('home.products');
        }

        $ids = [];
        $totalPrice = 0;
        foreach ($orders as $order) {
            $ids[] = $order['productId'];
            $totalPrice += $order['price'];
        };

        $orderedProducts = Product::query()->find($ids);


        return view('cart', [
            'orderedProducts' => $orderedProducts,
            'totalPrice' => $totalPrice,
            'orders' => $orders,
        ]);
    }

    public function clearCart(Request $request)
    {
        $request->session()->forget('orders');
        $request->session()->forget('cart');

        return redirect()->route('home.products');
    }

    public function destroy(Request $request, $productId)
    {
        $orders = $request->session()->get('orders');
        foreach ($orders as $key => $order) {
           if ($order['productId'] == $productId) {
               unset($orders[$key]);
           }
        }
        $request->session()->put('orders', $orders);
        return redirect()->route('home.products.show.cart');
    }
}
