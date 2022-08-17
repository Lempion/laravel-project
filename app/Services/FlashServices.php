<?php

namespace App\Services;

class FlashServices
{

    public static function flash($message)
    {
        session()->flash('message', $message);
    }

}
