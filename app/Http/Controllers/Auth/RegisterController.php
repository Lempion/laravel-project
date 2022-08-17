<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FlashServices;
use App\Services\UsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $user = UsersService::create($validateFields);

        if ($user) {
            FlashServices::flash('Вы успешно зарегистрировались');

            return redirect('/login');
        }

        return redirect('/register')->withErrors(['error' => 'Ошибка создания пользователя']);
    }
}
