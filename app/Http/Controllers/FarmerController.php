<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\MasterFarmer;
use App\Profile;
use App\User;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Farmer::with(array('master', 'profile'))->get();
        return response()->view('user.farmer.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = MasterFarmer::with('profile')->get();
        return response()->view('user.farmer.create', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->input('first-name').' '.$request->input('last-name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->passkey = $request->input('password');
        $user->active = 1;
        if($user->save()) {
            $user->assignRole(stringSlug('farmer'));
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->first_name = $request->input('first-name');
            $profile->middle_name = $request->input('middle-name');
            $profile->last_name = $request->input('last-name');
            if($profile->save()){
                $masterFarmer = new Farmer();
                $masterFarmer->master_id = $request->input('master-id');
                $masterFarmer->profile_id = $profile->id;
                if($masterFarmer->save()){
                    return response()->view('user.farmer.index');
                }
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function edit(Farmer $farmer)
    {
        //
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
        //
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
}
