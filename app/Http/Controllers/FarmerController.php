<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\Inventory;
use App\MasterFarmer;
use App\Product;
use App\Profile;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('super-admin')){
            $datas = Farmer::with('master')->get();
        }else{
            $ids = Inventory::where('master_id', Auth::user()->master->id)->distinct('farmer_id')->pluck('farmer_id')->toArray();
            $datas = Farmer::with('master')
                ->whereIn('id', $ids)
                ->get();
        }

//        return $datas;
        return response()->view('user.farmer.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $number = str_pad(Farmer::count() + 1, 6, 0, STR_PAD_LEFT);
        $number = Farmer::count() + 1;
//        $number = Auth::user()->master->account_id.'-'.$number;
        return response()->view('user.farmer.create', compact( 'number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $number = str_pad(Farmer::count() + 1, 5, 0, STR_PAD_LEFT);
//        $number = Auth::user()->master->account_id.'-'.$number;
        $farmer = new Farmer();
        $farmer->account_id = $number;
        $farmer->master_id = Auth::user()->master->id;
        $farmer->url = route('inv-listing', array('account'=>$number));
        if($farmer->save()){
            QrCode::size(500)
                ->format('png')
                ->generate($farmer->url, public_path('images/farmer/'.$farmer->account_id.'.png'));
            $profile = new Profile();
            $profile->first_name = $request->input('first_name');
            $profile->middle_name = $request->input('middle_name');
            $profile->last_name = $request->input('last_name');
            $profile->mobile = $request->input('mobile');
            $profile->address = $request->input('address');
            $profile->education = $request->input('education');
            $profile->four_ps = $request->input('four_ps', 0);
            $profile->pwd = $request->input('pwd', 0);
            $profile->indigenous = $request->input('indigenous', 0);
            $profile->livelihood = $request->input('livelihood', 0);
            $profile->farm_lot = $request->input('farm_lot');
            $profile->farming_since = $request->input('farming_since');
            $profile->organization = $request->input('organization');
            $profile->qr_image = $farmer->account_id.'.png';
            $profile->qr_image_path = '/images/farmer/'.$farmer->account_id.'.png';
            if($farmer->profile()->save($profile)){
                return redirect()->route('farmer.index');
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function show(Farmer $farmer)
    {
        $data = Farmer::with('inventory')->find($farmer->id);
//        return $data;
        $group = array();
        if($data->profile->four_ps == 1){
            array_push($group,'4Ps');
        }
        if($data->profile->pwd == 1){
            array_push($group,'PWD');
        }
        if($data->profile->indigenous == 1){
            array_push($group,'Indigenous');
        }
        if($data->profile->livelihood == 1){
            array_push($group,'Livelihood');
        }

        $inventories = Inventory::where('farmer_id', $farmer->id)->get();
        $host_names = explode(".", $_SERVER['HTTP_HOST']);
        $url = $host_names[count($host_names)-2] . "." . $host_names[count($host_names)-1]."/inv-listing/".$data->account_id;

//        return $group;
        return view('user.farmer.show', compact('data', 'group', 'inventories', 'url'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function edit(Farmer $farmer)
    {
        return view('user.farmer.edit', compact('farmer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Farmer $farmer)
    {
        $farmer = Farmer::find($farmer->id);

        $profile = Profile::find($farmer->profile->id);
        $profile->first_name = $request->input('first_name');
        $profile->middle_name = $request->input('middle_name');
        $profile->last_name = $request->input('last_name');
        $profile->mobile = $request->input('mobile');
        $profile->address = $request->input('address');
        $profile->education = $request->input('education');

        $profile->four_ps = $request->input('four_ps', 0);
        $profile->pwd = $request->input('pwd', 0);
        $profile->indigenous = $request->input('indigenous', 0);
        $profile->livelihood = $request->input('livelihood', 0);

        $profile->farm_lot = $request->input('farm_lot');
        $profile->farming_since = $request->input('farming_since');
        $profile->organization = $request->input('organization');
        if($profile->save()){
            return redirect()->route('farmer.show', array('farmer'=>$farmer->id));
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Farmer $farmer)
    {
        //
    }

    public function farmerQrPrint($account)
    {
        $data = Farmer::where('account_id', $account)->first();
        return view('user.mobile.farmer-qr-print', compact('data'));
    }

    public function farmerQr(Request $request)
    {
        return view('user.mobile.scan-qr-farmer');
    }

    public function farmerLogin()
    {
        return view('user.mobile.farmer.login');
    }

    public function farmerLoginForm(Request $request)
    {
        $rules = array(
            'farmer' => 'required|exists:farmers,account_id'
        );
        $messages = [
            'farmer'    => 'Farmer does not exists.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        return redirect()->route('farmers-info', array('account'=>$request->input('farmer')));
    }

    public function farmerInfo($account)
    {
        $data = Farmer::where('account_id', $account)->first();
        return view('user.mobile.farmer.info', compact('data'));
    }

    public function farmerInventory(Request $request)
    {
        return view('user.mobile.farmer.inventory');
    }
}
