<?php

namespace App\Wire\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('wire.views.dashboard');
    }
}
