<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\Inventory;
use App\LoanProvider;
use App\LoanType;
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
//        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $subdomain = join('.', explode('.', $_SERVER['HTTP_HOST'], -2));
//        $host_names = explode(".", $_SERVER['HTTP_HOST']);
//        $domain = $host_names[count($host_names)-2] . "." . $host_names[count($host_names)-1];

        if(auth()->user()->hasRole('super-admin')){
            $inventory = Inventory::count();
            $trace = Trace::count();
            $farmer = Inventory::distinct('farmer_id')->count('farmer_id');





            return view('admin.dashboard', compact( 'inventory', 'trace', 'farmer'));
        }

        if(auth()->user()->hasRole('community-leader')){
            $inventory = Inventory::where('leader_id', Auth::user()->leader->account_id)->count();
            $trace = Trace::where('user_id', Auth::user()->id)->count();
            $farmer = Inventory::where('leader_id', Auth::user()->leader->account_id)->distinct('farmer_id')->count('farmer_id');
            return view(subDomainPath('dashboard'), compact( 'inventory', 'trace', 'farmer'));
        }

        if(auth()->user()->hasRole('loan-provider')){

//            $data = array();
//            $loanType = LoanType::withCount([
//                'product as product_count' => function ($query) {
//                    $query->where('loan_provider_id', Auth::user()->loan_provider->id);
//                }])
//                ->with(array('product' => function($query) {
//                    $query->where('loan_provider_id', Auth::user()->loan_provider->id);
//                }))
//                ->get();
//            foreach ($loanType as $type){
//                $pending = 0;
//                $active = 0;
//                $completed = 0;
//                $declined = 0;
//                foreach ($type->product as $product){
//                    foreach ($product->loan as $loan){
//                        switch ($loan->status) {
//                            case 'Pending':
//                                $pending += 1;
//                                break;
//                            case 'Active':
//                                $active += 1;
//                                break;
//                            case 'Completed':
//                                $completed += 1;
//                                break;
//                            case 'Declined':
//                                $declined += 1;
//                                break;
//                        }
//                    }
//                }
//                array_push($data, array($type->display_name, $type->product_count), $pending, $active, $completed, $declined);
//            }
//            return $data;

            return view(subDomainPath('loan-provider.dashboard'));
        }

        if(auth()->user()->hasRole('farmer')){
            $farmer = Farmer::find(Auth::user()->farmer->id);
            $loans = $farmer->loans;

//            return $loans;
            return view(subDomainPath('farmer.dashboard'), compact('loans'));
        }

    }
}
