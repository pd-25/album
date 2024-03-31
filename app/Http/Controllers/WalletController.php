<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['Wallet'] = Wallet::with('userDetails')->where('type', 'E')->orderBy('year', 'Desc')->orderBy('month', 'desc')->paginate(20);
        $data['user'] = User::where('type', 'user')->orderBy('name', 'asc')->get();
        return view('admin.wallet.add', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $analysis= Wallet::where('userId', auth()->user()->id)->where('type', 'D')->where('year', date('Y'))->where('status', 1)->orderBy('month', 'asc')->get();
        $finalArray= array();
        foreach ($analysis as $key => $value) {
            $tempArray = array(
                array_push($finalArray, $value->adjust_earning)
            );
        }
        $data['chartData'] = json_encode($finalArray);
        // dd($data['chartData']);

        $data['pendingWithdrawal'] = Wallet::where('userId', auth()->user()->id)->where('type', 'D')->orderBy('created_at', 'desc')->get();

        $data['TotalEarning'] = Wallet::select(DB::raw('sum(earning) as `TotalEarning`'))->where('userId', auth()->user()->id)->where('type', 'E')->get();

        $data['TotalDeduction'] = Wallet::select(DB::raw('sum(adjust_earning) as `TotalDeduction`'))->where('userId', auth()->user()->id)->where('status', 1)->where('type', 'D')->get();

        return view('user.wallet.wallet', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'userId'=>'required',
            'earning'=>'required',
            'month'=>'required',
            'year' =>'required'
        ]);
        $BalancCount = Wallet::where('userId', $request->userId)->where('month', $request->month)->where('year', $request->year)->where('type', 'E')->count();
        if($BalancCount == 0)
        {
            $wallet = new Wallet;
            $wallet->userId = $request->userId;
            $wallet->earning = $request->earning;
            $wallet->month = $request->month;
            $wallet->year = $request->year;
            $wallet->type = $request->type;
            $wallet->adminId = auth()->guard('admin')->user()->id;
            $wallet->earning_referance = $request->earning_referance;
            $wallet->save();
            return back()->with('success', 'Balance added successfully.');
        }else{
            return back()->with('errorMessage', "This month's balance has already been added.");
        }
    }

    public function userstore(Request $request)
    {
        $request->validate([
            'userId'=>'required',
            'adjust_earning'=>'required',
            'month'=>'required',
            'year' =>'required'
        ]);
        $userId = $request->userId;
        $BalanceDeduction = Wallet::where('userId', $userId)->where('month', $request->month)->where('year', $request->year)->where('type', 'D')->count();

        $TotalEarning = Wallet::select(DB::raw('sum(earning) as `TotalEarning`'))->where('userId', $userId)->where('type', 'E')->get();

        $TotalDeduction = Wallet::select(DB::raw('sum(adjust_earning) as `TotalDeduction`'))->where('userId', $userId)->where('status', 1)->where('type', 'D')->get();

        $RemainBalance = ($TotalEarning[0]->TotalEarning) - ($TotalDeduction[0]->TotalDeduction);
        if($BalanceDeduction == 0 && $RemainBalance >= ($request->adjust_earning))
        {
            $wallet = new Wallet;
            $wallet->userId = $request->userId;
            $wallet->month = $request->month;
            $wallet->year = $request->year;
            $wallet->type = $request->type;
            $wallet->adjust_earning = $request->adjust_earning;
            $wallet->earning_referance = $request->earning_referance;
            $wallet->save();
            return back()->with('success', 'Withdrawal request send successfully.');
        }else{
            return back()->with('errorMessage', "This month's balance has already been added Or remaining balance < adjust earning");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Wallet $wallet)
    {
        $data['user'] = User::where('type', 'user')->orderBy('name', 'asc')->get();
        $data['withdrawal'] = Wallet::with('userDetails')->where('type', 'D')->orderBy('year', 'DESC')->orderBy('month', 'DESC')->paginate(30);
        return view('admin.wallet.withdrawal_request', $data);
    }

    public function getUserBalance($id)
    {
        $TotalEarning = Wallet::select(DB::raw('sum(earning) as `TotalEarning`'))->where('userId', $id)->where('type', 'E')->get();
        $TotalDeduction = Wallet::select(DB::raw('sum(adjust_earning) as `TotalDeduction`'))->where('userId', $id)->where('status', 1)->where('type', 'D')->get();

        $RemainBalance = ($TotalEarning[0]->TotalEarning) - ($TotalDeduction[0]->TotalDeduction);
        return $RemainBalance;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wallet $wallet)
    {
        $wallet = Wallet::find($request->id);
        $wallet->adjust_earning = $request->adjust_earning;
        $wallet->earning_referance = $request->earning_referance;
        $wallet->status = $request->status;
        $wallet->save();
        return back()->with('success', "Update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $Id = $request->DeleteId;
        $new = Wallet::find($Id);
        $new->delete();
        return back()->with('success', 'Successfully Deleted');
    }
}
