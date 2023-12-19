<?php

namespace App\Http\Controllers\admin\dashboard;

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
    public function dashboard() {
        // $data["total_artist"] = $this->artist->getAllArtists()->count();
        $dashboard = $this->artistInterface->Dashboard();
        return view("admin.dashboard.dashboard", compact('dashboard'));
 }
}
