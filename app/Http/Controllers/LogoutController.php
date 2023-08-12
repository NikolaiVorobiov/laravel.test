<?php

namespace App\Http\Controllers;

//session_start();

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function exit1(Request $request)
    {
//        if (isset($_SESSION['admin'])) {

        if ($request->session()->get('admin') !== null) {

//            unset($_SESSION['admin']);

            $request->session()->forget('admin');
        }
        return redirect()->route('home');
    }
}
