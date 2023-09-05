<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('home.products');
    }

    public function loginForm(Request $request)
    {
            return view('sign-in', ['info' => '']);
    }

    public function loginSave(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Введите ваш email адрес',
            'password.required' => 'Введите пароль',
        ]);


        $user = User::query()->where([
            ['email', '=', $request->email],
        ])->first();

        if (Hash::check($request->password, $user->password)) {
            $request->session()->put('admin', 'true');
            return redirect()->route('admin');

        } else {
            return view('sign-in', ['info' => 'Incorrect data, try again']);
        }
    }

    public function registerForm(Request $request)
    {
            return view('sign-up');
    }

    public function registerSave(Request $request)
    {
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

            $request->session()->put('admin', true);

            $hashPassword = Hash::make($validated['password']);

            $user = new User;

            $user->email = $validated['email'];
            $user->password = $hashPassword;
            $user->first_name = $validated['first_name'];
            $user->last_name = $validated['last_name'];
            $user->save();

            return view('admin.admin');
    }
}
