<?php

namespace App\Http\Controllers;

session_start();

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function exit1()
    {
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }
        return redirect()->route('sign-in');
    }
}
