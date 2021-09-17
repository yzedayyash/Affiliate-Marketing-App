<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
class DashboardController extends Controller
{
    public function index()
    {

        $user = \Auth::user();

        $referrals = $user->referrals()->paginate(1);

        return view('dashboard' )->with( ['user' => $user  , 'referrals' => $referrals ]  );
    }


    public function chart()
    {
    $user_id = \Auth::user()->id;

        $chart_data =   User::where('referrer_id' , $user_id)
        ->whereDate('created_at' , '>', \Carbon\Carbon::now()->subDays(14))
        ->select( DB::raw("(count(id)) as total_users"),DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as date"))
        ->orderBy('created_at')
        ->groupBy(DB::raw("date"))
        ->get();



        return response()
        ->json($chart_data);

    }
}
