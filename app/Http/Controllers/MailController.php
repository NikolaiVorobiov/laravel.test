<?php

namespace App\Http\Controllers;

use App\Mail\MyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
//use Mail;

class MailController extends Controller
{
    public function index(Request $request, $currentUserEmail)
    {
        $mailData = [
            'title' => 'Mail from Laravel',
            'body' => 'You ordered products'
        ];

        Mail::to($currentUserEmail)->send(new MyMail($mailData));
        $request->session()->put('info', 'Ordered');
//        dd("Email is sent successfully.");
        return redirect()->route('home.products');
    }
}
