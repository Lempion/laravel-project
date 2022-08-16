<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class RegisterController extends Controller
{
    public function page()
    {
        return view('register');
    }

    public function save(Request $request)
    {
        $validateFields = $request->validate([
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required', 'min:4', 'max:20']
        ]);

        $user = User::create([
            'email' => $validateFields['email'],
            'password' => Hash::make($validateFields['password'])
        ]);

        if ($user) {
            session()->flash('message', 'Вы успешно зарегистрировались');

            return redirect('/login');
        }

        return redirect('/register')->withErrors(['error' => 'Ошибка создания пользователя']);
    }
}
