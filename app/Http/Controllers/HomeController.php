<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Order;
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

        $info = $request->session()->get('info') ?? '';
        $request->session()->forget('info');

        return view('home', [
            'products' => $products,
            'cart' => $request->session()->has('cart'),
            'countOrder' => $countOrder,
            'info' => $info
        ]);
    }


    public function addToCart(Request $request, $productId)
    {
        $product = Product::find($productId);
        $order = ['productId' => $productId, 'price' => $product->price];

        if ($request->session()->has('orders')) {
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

        if (!isset($orders) || count($orders) == 0) {
            return redirect()->route('home.products');
        }

        $ids = [];
        $totalPrice = 0;
        foreach ($orders as $order) {
            $ids[] = $order['productId'];
            $totalPrice += $order['price'];
        };
        $request->session()->put('totalPrice', $totalPrice);

        $countOfIds = array_count_values($ids);

        $updatedOrders = [];
        foreach ($countOfIds as $id => $quantity) {
            $price = 0;
            foreach ($orders as $order) {
                if ($order['productId'] == $id) {
                    $price = $order['price'];
                }
            }

            $updatedOrders[] = ['productId' => $id, 'price' => $price ,'quantity' => $quantity];
        }

        $orderedProducts = Product::query()->find($ids);

        return view('cart', [
            'orderedProducts' => $orderedProducts,
            'totalPrice' => $totalPrice,
            'orders' => $updatedOrders,
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


    public function emailForm()
    {
        return view('email');
    }

    public function emailSave(Request $request)
    {
        $request->session()->put('currentUserEmail', $request->email);

        return redirect()->route('home.products.pay');
    }


    public function pay(Request $request)
    {
        $totalPrice = $request->session()->get('totalPrice');
        $currentUserEmail = $request->session()->get('currentUserEmail');
        $orderedProducts = $request->session()->get('orders');

        if (!$currentUserEmail) {
            return redirect()->route('email.form');
        }

        $orderToPay = [
                'email' => $currentUserEmail,
                'totalPrice' => $totalPrice,
                'currency' => Currency::NAME_GRIVNA,
                'products' =>$orderedProducts
        ];

        Order::create($orderToPay);

        $request->session()->forget('totalPrice');
        $request->session()->forget('orders');

                                        //TODO Send mail


        return redirect()->route('send.mail', ['currentUserEmail' => $currentUserEmail]);

    }
}
