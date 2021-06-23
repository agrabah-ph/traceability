<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\Inventory;
use App\Trace;
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $subdomain = join('.', explode('.', $_SERVER['HTTP_HOST'], -2));

        $host_names = explode(".", $_SERVER['HTTP_HOST']);
        $domain = $host_names[count($host_names)-2] . "." . $host_names[count($host_names)-1];

        if(auth()->user()->hasRole('super-admin')){
            $inventory = Inventory::count();
            $trace = Trace::count();
            $farmer = Inventory::distinct('farmer_id')->count('farmer_id');

            return view('admin.dashboard', compact( 'inventory', 'trace', 'farmer'));
        }else{
            $inventory = Inventory::where('master_id', Auth::user()->master->account_id)->count();
            $trace = Trace::where('user_id', Auth::user()->id)->count();
            $farmer = Inventory::where('master_id', Auth::user()->master->account_id)->distinct('farmer_id')->count('farmer_id');


            return view('dashboard', compact( 'inventory', 'trace', 'farmer'));
        }

    }
}
