<?php

namespace App\Http\Controllers\admin\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard() {
        // $data["total_artist"] = $this->artist->getAllArtists()->count();
        return view("admin.dashboard.dashboard");
 }
}
