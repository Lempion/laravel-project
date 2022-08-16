<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function main()
    {
        return view('main');
    }

    public function edit($id)
    {
        return view('edit');
    }

    public function security($id)
    {
        return view('security');
    }

    public function status($id)
    {
        return view('status');
    }

    public function media($id)
    {
        return view('media');
    }

    public function delete($id)
    {
        return view('delete');
    }

    public function create()
    {
        return view('create');
    }

    public function show($id)
    {
        return view('show');
    }


}
