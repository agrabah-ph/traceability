<?php

namespace App\Http\Controllers;

use App\CommunityLeader;
use App\Profile;
use App\User;
use Illuminate\Http\Request;

class CommunityLeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = CommunityLeader::with('profile')->get();
//        return $datas;
        return response()->view(subDomainPath('community-leader.index'), compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view(subDomainPath('community-leader.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {$number = str_pad(CommunityLeader::count() + 1, 5, 0, STR_PAD_LEFT);
        $master = new CommunityLeader();
        $master->account_id = $number;
        if($master->save()){
            $profile = new Profile();
            $profile->first_name = $request->input('first-name');
            $profile->middle_name = $request->input('middle-name');
            $profile->last_name = $request->input('last-name');
            if($master->profile()->save($profile)){
                $user = new User();
                $user->name = $profile->first_name.' '.$profile->last_name;
                $user->email = $request->input('email');
                $user->password = bcrypt($request->input('password'));
                $user->passkey = $request->input('password');
                $user->active = 1;
                if($user->save()) {
                    $user->assignRole(stringSlug('community-leader'));
                    $user->markEmailAsVerified();
                    $master->user_id = $user->id;
                    $master->save();
                    return redirect()->route('community-leader.index');
                }
            }
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CommunityLeader  $communityLeader
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityLeader $communityLeader)
    {
        $data = CommunityLeader::find($communityLeader->id);

//        return $data;
        return response()->view(subDomainPath('community-leader.show'), compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CommunityLeader  $communityLeader
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityLeader $communityLeader)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CommunityLeader  $communityLeader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommunityLeader $communityLeader)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CommunityLeader  $communityLeader
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityLeader $communityLeader)
    {
        //
    }
}
