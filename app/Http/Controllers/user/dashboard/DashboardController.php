<?php

namespace App\Http\Controllers\user\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\core\artist\ArtistInterface;
use App\Models\News;
use App\Models\Wallet;
use App\Models\Asset;

class DashboardController extends Controller
{
    public $artistInterface;
    public function __construct(ArtistInterface $artistInterface)
    {
        $this->artistInterface = $artistInterface;        
    }
    public function artistDashboard() {
        $data['dashboard'] = $this->artistInterface->Dashboard(auth()->user()->id);
        $data['news'] = News::where('status',1)->orderBy('news_date', 'desc')->get();

        $data['asset'] = Asset::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->take(5)->get();
        $wallet = Wallet::where('year', date('Y'))->where('userId', auth()->user()->id)->where('type','E')->orderBy('month', 'asc')->get();
        $finalArray = array();
        foreach ($wallet as $key => $value) {
            $tempArray = array(
                array_push($finalArray, $value->earning)
            );
        }
        $data['BarChartdata'] = json_encode($finalArray);
        return view('user.dashboard.dashboard', $data);
    }

    public function asset() {
        return view('user.working');
    }

    public function newsDetails($news) {
        $news = News::find($news);
        return view("user.news.views", compact('news'));
    }

    public function Dashboardbarchart($year) {
        $wallet = Wallet::where('year', $year)->where('userId', auth()->user()->id)->where('type','E')->orderBy('month', 'asc')->get();
        $finalArray = array();
        foreach ($wallet as $key => $value) {
            array(
                array_push($finalArray, $value->earning)
            );
        }
        return $finalArray;
    }
}
