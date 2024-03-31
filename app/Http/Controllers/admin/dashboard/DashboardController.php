<?php

namespace App\Http\Controllers\admin\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\core\artist\ArtistInterface;
use App\Models\News;
use App\Models\Wallet;
use App\Models\Asset;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public $artistInterface;
    public function __construct(ArtistInterface $artistInterface)
    {
        $this->artistInterface = $artistInterface;        
    }
    public function dashboard() {
        $data['asset'] = Asset::orderBy('id', 'desc')->take(10)->get();
        // $data["total_artist"] = $this->artist->getAllArtists()->count();
        $wallet = DB::table('wallets')->select('year', DB::raw('sum(adjust_earning) as withdrawal'))->where('type','D')->groupBy('year')->get();
        $walletEarning = DB::table('wallets')->select('year', DB::raw('sum(earning) as earning'))->where('type','E')->groupBy('year')->get();
        // dd($walletEarning);
        $YearArray = array();
        $AmmountArray = array();
        $YearArrayEarning = array();
        $AmmountArrayEarning = array();

        foreach ($wallet as $key => $value) {
            $tempArray = array(
                array_push($YearArray, $value->year),
                array_push($AmmountArray, (int)$value->withdrawal)
            );
        }

        foreach ($walletEarning as $key => $value) {
            $tempArray = array(
                array_push($YearArrayEarning, $value->year),
                array_push($AmmountArrayEarning, (int)$value->earning)
            );
        }

        $data['BarChartYear'] = json_encode($YearArray);
        $data['BarChartAmmount'] = json_encode($AmmountArray);

        $data['BarChartYearEarning'] = json_encode($YearArrayEarning);
        $data['BarChartAmmountEarning'] = json_encode($AmmountArrayEarning);

        $data['dashboard'] = $this->artistInterface->Dashboard(null);
        $data['news'] = News::where('status',1)->orderBy('news_date', 'desc')->get();
        return view("admin.dashboard.dashboard", $data);
    }

    public function newsDetails($news) {
        $news = News::find($news);
        return view("admin.news.views", compact('news'));
    }
}
