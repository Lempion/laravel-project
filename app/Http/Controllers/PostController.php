<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\FlashServices;
use App\Services\UsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PostController extends Controller
{
    private $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function main()
    {
        return view('main', ['posts' => UsersService::all(), 'user' => UsersService::thisUser(), 'admin' => UsersService::thisUserAdmin()]);
    }

    public function edit($id)
    {
        if ($redirect = UsersService::userDontHavePermissionForChange($id)) {
            return $redirect;
        }

        $user = UsersService::one($id, route('main'));
        return view('edit', ['user' => $user]);
    }

    public function editData(Request $request, $id)
    {
        if ($redirect = UsersService::userDontHavePermissionForChange($id)) {
            return $redirect;
        }

        $validateFields = $request->validate([
            "name" => ['string', 'min:4', 'max:25'],
            "company" => ['string', 'min:4', 'max:50'],
            "phone" => ['string', 'min:4', 'max:25'],
            "address" => ['string', 'min:4', 'max:50'],
        ]);

        $this->usersService->update($validateFields, $id);

        FlashServices::flash('Пользователь успешно обновлен');

        return redirect(route('main'));
    }

    public function security($id)
    {
        if ($redirect = UsersService::userDontHavePermissionForChange($id)) {
            return $redirect;
        }

        $user = UsersService::one($id, route('main'));
        return view('security', ['user' => $user]);
    }

    public function editSecurity(Request $request, $id)
    {
        if ($redirect = UsersService::userDontHavePermissionForChange($id)) {
            return $redirect;
        }

        if ($request->password !== null) {
            $rules['password'] = ['nullable', 'min:4', 'max:20', 'confirmed'];
        }

        if ($request->email !== $request->oldEmail) {
            $rules['email'] = ['unique:users', 'email'];
        }

        if (isset($rules)) {
            $validateFields = $request->validate($rules);

            $this->usersService->update($validateFields, $id);

            FlashServices::flash('Данные успешно обновлены');

            return redirect(route('main'));
        }

        return redirect(route('security', $id))->withErrors(['error' => 'Данные не были изменены']);
    }

    public function status($id)
    {
        if ($redirect = UsersService::userDontHavePermissionForChange($id)) {
            return $redirect;
        }

        $user = UsersService::one($id, route('main'));

        $arrStatuses = $this->usersService->getCurrentStatusArr($user['status']);

        return view('status', ['user' => $user, 'statuses' => $arrStatuses]);
    }

    public function editStatus(Request $request, $id)
    {
        if ($redirect = UsersService::userDontHavePermissionForChange($id)) {
            return $redirect;
        }

        $validateField = $request->validate(['status' => ['string']]);

        $this->usersService->update($validateField, $id);

        FlashServices::flash('Статус успешно обновлен');

        return redirect(route('main'));
    }

    public function media($id)
    {
        if ($redirect = UsersService::userDontHavePermissionForChange($id)) {
            return $redirect;
        }

        $user = UsersService::one($id, route('main'));
        return view('media', ['user' => $user]);
    }

    public function editMedia(Request $request, $id)
    {
        if ($redirect = UsersService::userDontHavePermissionForChange($id)) {
            return $redirect;
        }

        $validateImage = $request->validate(["media" => ['required', 'image']]);

        $this->usersService->update($validateImage, $id);

        FlashServices::flash('Аватар успешно обновлен');

        return redirect(route('main'));
    }

    public function delete($id)
    {
        if ($redirect = UsersService::userDontHavePermissionForChange($id)) {
            return $redirect;
        }

        $this->usersService->delete($id);

        FlashServices::flash('Пользователь успешно удалён');

        return redirect(route('main'));
    }

    public function create()
    {
        return view('create');
    }

    public function addUser(Request $request)
    {

        $validateFields = $request->validate([
            "email" => ['required', 'unique:users', 'email'],
            "password" => ['required', 'min:4', 'max:20'],
            "name" => ['string', 'min:4', 'max:25'],
            "company" => ['string', 'min:4', 'max:50'],
            "phone" => ['string', 'min:4', 'max:25'],
            "address" => ['string', 'min:4', 'max:50'],
            "status" => ['string', 'min:4', 'max:15'],
            "media" => ['image'],
            "vk" => ['string', 'min:3', 'max:25'],
            "tg" => ['string', 'min:3', 'max:25'],
            "inst" => ['string', 'min:3', 'max:25'],
        ]);

        $userId = $this->usersService->create($validateFields);

        $validateFields = Arr::except($validateFields, ['email', 'password']);

        $this->usersService->update($validateFields, $userId);

        FlashServices::flash('Пользователь успешно создан');

        return redirect(route('main'));
    }

    public function show($id)
    {
        $user = UsersService::one($id, route('main'));
        return view('show', ['user' => $user]);
    }
}
