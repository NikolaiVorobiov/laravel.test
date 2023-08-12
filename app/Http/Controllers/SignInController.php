<?php

namespace App\Http\Controllers;

//session_start();

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignInController extends Controller
{
    public function entrance(Request $request)
    {
        $info = 'Correct login';
        if ($request->has('email') and $request->has('password')) {

            $email = $request->email;
            $password = $request->password;

            $users = User::all();

            foreach ($users as $user) {
                if ($email == $user->email && Hash::check($password, $user->password)) {

//                    $_SESSION['admin'] = true;

                    $request->session()->put('admin', 'true');
                    break;
                }
            }
        }
//        if (isset($_SESSION['admin']) && $_SESSION['admin']) {

        if ($request->session()->get('admin') !== null && $request->session()->get('admin')) {
            return view('admin');
        } else {
            $info = 'Incorrect login or password';
        }
        return view('sign-in', ['info' => $info]);
    }
}
