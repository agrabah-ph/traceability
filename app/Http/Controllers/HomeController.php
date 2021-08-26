<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\Inventory;
use App\Loan;
use App\LoanProvider;
use App\LoanType;
use App\Trace;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(auth()->user()->hasRole('community-leader')){
            $inventory = Inventory::where('leader_id', Auth::user()->leader->account_id)->count();
            $trace = Trace::where('user_id', Auth::user()->id)->count();
            $farmer = Inventory::where('leader_id', Auth::user()->leader->account_id)->distinct('farmer_id')->count('farmer_id');

            return view('trace.dashboard', compact( 'inventory', 'trace', 'farmer'));
        }else{
            return view('layouts.activation');
        }

    }

}
