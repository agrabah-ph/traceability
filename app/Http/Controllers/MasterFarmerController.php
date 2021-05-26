<?php

namespace App\Http\Controllers;

use App\MasterFarmer;
use App\Profile;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MasterFarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = MasterFarmer::with('profile')->get();
//        return $datas;
        return response()->view('user.master-farmer.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('user.master-farmer.create');
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
            $user->assignRole(stringSlug('master-farmer'));
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->first_name = $request->input('first-name');
            $profile->middle_name = $request->input('middle-name');
            $profile->last_name = $request->input('last-name');
            if($profile->save()){
                $masterFarmer = new MasterFarmer();
                $masterFarmer->profile_id = $profile->id;
                if($masterFarmer->save()){
                    return response()->view('user.master-farmer.index');
                }
            }
        }

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MasterFarmer  $masterFarmer
     * @return \Illuminate\Http\Response
     */
    public function show(MasterFarmer $masterFarmer)
    {
        $data = MasterFarmer::find($masterFarmer->id);

//        return $data;
        return response()->view('user.master-farmer.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MasterFarmer  $masterFarmer
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterFarmer $masterFarmer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MasterFarmer  $masterFarmer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterFarmer $masterFarmer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MasterFarmer  $masterFarmer
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterFarmer $masterFarmer)
    {
        //
    }
}
