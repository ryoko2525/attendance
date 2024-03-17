<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index()

    {
        return view('stamp');
    }




      public function show()

    {
        return view('date');
    }
}