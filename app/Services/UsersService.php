<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UsersService
{
    private $imagesServices, $statuses = ['success' => 'Онлайн', 'warning' => 'Отошел', 'danger' => 'Не беспокоить'];

    public function __construct(ImagesServices $imagesServices)
    {
        $this->imagesServices = $imagesServices;
    }

    public static function all(bool $sortByDesc = true): array
    {
        return User::all()->sortBy('id', 0, $sortByDesc)->toArray();
    }

    public static function one($id, $redirectPath = false)
    {
        if ($user = User::where('id', $id)->first()) {
            return $user->toArray();
        }

        if ($redirectPath) {
            header("Location:$redirectPath");
            exit();
        }

        return false;
    }

    public static function create($data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => $data['password']
        ]);

        return $user->id;
    }

    public function update($data, $id)
    {
        if (isset($data['media'])) {
            $this->imagesServices->remove($id);

            $filePath = $this->imagesServices->upload($data['media']);
            $data['media'] = $filePath;
        }

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return User::where('id', $id)->update($data);
    }

    public function getCurrentStatusArr($status): array
    {
        $currentStatus = $this->statuses[$status];

        return Arr::prepend(Arr::except($this->statuses, $status), $currentStatus, $status);
    }

    public function checkPermissions($changeId)
    {
        $user = Auth::user();
    }
}
