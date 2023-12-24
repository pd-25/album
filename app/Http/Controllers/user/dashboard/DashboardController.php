<?php

namespace App\Http\Controllers\user\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\core\artist\ArtistInterface;

class DashboardController extends Controller
{
    public $artistInterface;
    public function __construct(ArtistInterface $artistInterface)
    {
        $this->artistInterface = $artistInterface;        
    }
    public function artistDashboard() {
        $dashboard = $this->artistInterface->Dashboard(auth()->user()->id);
        return view('user.dashboard.dashboard', compact('dashboard'));
    }

    public function asset() {
        return view('user.working');
    }
}
