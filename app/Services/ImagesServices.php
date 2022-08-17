<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ImagesServices
{

    public function remove($id)
    {
        $userAvatar = User::where('id', $id)->select('media')->first();

        if ($userAvatar) {
            Storage::delete($userAvatar->media);
        }
    }

    public function upload($file)
    {
       return $file->store('img/avatars');
    }

}
