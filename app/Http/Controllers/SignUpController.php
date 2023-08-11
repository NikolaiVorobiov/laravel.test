<?php

namespace App\Http\Controllers;

session_start();

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function form(Request $request)
    {
        $info = '';

        if (isset($_SESSION['admin']) && $_SESSION['admin']) {
            return view('admin');
        }
//
//        $users = User::all();
//        $emails = [];
//        foreach ($users as $user) {
//            $emails[] = $user->email;
//        }


        if ($request->has('email') and $request->has('password') and $request->has('first_name') and $request->has('last_name')) {

            $validated = $request->validate([
                'email' => 'required|unique:users|max:255',
                'password' => 'required|min:10',
                'first_name' => 'required',
                'last_name' => 'required',
            ], [
                'email.required' => 'Введите ваш email адрес',
                'email.unique' => 'Такой email уже существует',
                'password.required' => 'Введите пароль',
                'password.min' => 'Пароль должен быть длиной не менее :min символов',
                'first_name.required' => 'Введите ваше имя',
                'last_name.required' => 'Введите вашу фамилию',
            ]);

            $_SESSION['admin'] = true;
            dump($_SESSION);
//            dump($validated);


//            if (in_array($request->input('email'), $emails)) {
//                $info = 'Such email already exists, try again!';
//            } else {
//                $user = new User;
//                $user->email = $request->input('email');
//                $user->password = $request->input('password');
//                $user->first_name = $request->input('first_name');
//                $user->last_name = $request->input('last_name');
//                $user->save();
//            }

            $hashPassword = Hash::make($validated['password']);

            $user = new User;
            $user->email = $validated['email'];
            $user->password = $hashPassword;
            $user->first_name = $validated['first_name'];
            $user->last_name = $validated['last_name'];
            $user->save();

            return view('admin');
        } else {
            return view('sign-up', ['info' => $info]);
        }

    }
}
