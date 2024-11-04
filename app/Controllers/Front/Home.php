<?php

namespace App\Controllers\Front;

class Home extends FrontController
{
    public function index(): string
    {
        

        return view('welcome_message');
    }

    public function front(): string
    {
        return 'front';
    }

    public function admin(): string
    {
        return 'admin';
    }
}
