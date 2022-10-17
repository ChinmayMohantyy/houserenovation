<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewTestController extends Controller
{
    public function home()
    {
        return view('admin.dashboard.index');
    }
    public function homeWarehouse()
    {
        return view('housecaptain.dashboard.index');
    }

    public function homeHousecaptain()
    {
        return view('housecaptain.dashboard.index');
    }
}
