<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    /*Untuk pangaturan halaman home */
    public function index()
    {
        return view('home');
    }

    /*Untuk pangaturan halaman page */
    public function page()
    {
        return view('page');
    }
}
