<?php

namespace App\Http\Controllers\user\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function artistDashboard() {
        return view('user.dashboard.dashboard');
    }

    public function asset() {
        return view('user.working');
    }
}
