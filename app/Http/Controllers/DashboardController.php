<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // return view('daushboard.saleh');
        return view('dashboard.layout');
    }
}
