<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        $validateFields = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
            'remember' => ['string']
        ]);

        $res = Auth::attempt($validateFields, (isset($validateFields['remember']) ? true : false));

        if (!$res) {
            return redirect('/login')->withErrors(['error' => 'Вы ввели не верный адрес почты или пароль']);
        }

        session()->flash('message','Вы успешно авторизовались');

        return redirect('/');

    }
}
