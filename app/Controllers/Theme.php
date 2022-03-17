<?php

namespace App\Controllers;

class Theme extends BaseController
{
    public function index()
    {
        return view('theme/layout');
    }
}
