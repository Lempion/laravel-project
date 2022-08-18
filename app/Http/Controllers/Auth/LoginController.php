<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FlashServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function page()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $authFields = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        $remember = $request->validate([
            'remember' => ['string']
        ]);

        $res = Auth::attempt($authFields, isset($remember));

        if (!$res) {
            return redirect('/login')->withErrors(['error' => 'Вы ввели не верный адрес почты или пароль']);
        }

        FlashServices::flash('Вы успешно авторизовались');

        return redirect('/');

    }
}
