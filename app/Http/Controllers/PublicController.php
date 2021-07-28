<?php

namespace App\Http\Controllers;

use App\CommunityLeader;
use App\Farmer;
use App\Inventory;
use App\LoanProvider;
use App\Trace;
use App\ModelInfo;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PublicController extends Controller
{
    public function traceTracking($code)
    {
        $trace = Trace::with('inventories')->where('reference', $code)->first();
//        return $trace;
        return view(subDomainPath('mobile.trace-tracking'), compact('trace'));
    }

    public function traceShipped(Request $request)
    {
        $trace = Trace::where('code', $request->input('code'))->first();
        if($trace){
            $modelInfo = new ModelInfo();
            $modelInfo->type = 'status';
            $modelInfo->value_0 = 'Delivered';
            $modelInfo->value_1 = 'Delivered to Client';
            $trace->info()->save($modelInfo);
            $trace->active = 0;
            $trace->delivered = 1;
            $trace->save();
            Trace::find($trace->id)->inventories()->update(array(
                'status'=>'Delivered'
            ));

            return response()->json('success');
        }
        return response()->json('error');


//        return redirect()->route('trace-tracking', array('code'=>$trace->reference));
    }

    public function traceUpdate(Request $request)
    {
        $action = $request->input('action');
        $update = '';
        $trace = Trace::find($request->input('id'));
        $modelInfo = new ModelInfo();
        $modelInfo->type = 'status';
        switch ($action){
            case 'Depart':
                $update = 'Transit';
                $modelInfo->value_0 = $update;
                $modelInfo->value_1 = 'On Transit';
                break;
            case 'Transit':
                $update = 'Arrive';
                $modelInfo->value_0 = $update;
                $modelInfo->value_1 = 'Arrived at destination';
                break;
            case 'Arrive':
                $update = 'Loaded';
                $modelInfo->value_0 = $update;
                $modelInfo->value_1 = 'Waiting to travel';
                break;
            case 'Delivered':
                $update = $action;
                $modelInfo->value_0 = $action;
                $modelInfo->value_1 = 'Delivered to Client';
                $trace->active = 0;
                $trace->delivered = 1;
                break;
            case 'Undeliverable':
                $update = $action;
                $modelInfo->value_0 = $action;
                $modelInfo->value_1 = 'Unable to Deliver';
                $trace->active = 0;
                break;
        }
        $trace->save();
        $trace->info()->save($modelInfo);

        Trace::find($trace->id)->inventories()->update(array(
            'status'=>$update
        ));

//        return response()->json();
    }

    public function traceInfo($code)
    {
        $data = Trace::where('reference', $code)->first();
//        return $data;
        return view(subDomainPath('mobile.trace-info'), compact('data'));
    }

    public function farmerQr(Request $request)
    {
        return view(subDomainPath('mobile.scan-qr-farmer'));
    }

    public function loanRegistration()
    {
        return view('loan.auth.register');
    }

    public function loanUserRegistrationStore(Request $request)
    {
        $rules = array(
            'type' => 'required',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|max:255',
            'repeat-password' => 'required|same:password',
        );
        $messages = [
            'same'    => 'Password not match.',
            'repeat-password'    => 'This field is required..',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = new User();
        $data->email = $request->input('email');
        $data->password = bcrypt($request->input('password'));
        $data->passkey = $request->input('password');
        if($data->save()){
            switch ($request->input('type')){
                case 'farmer':
                    $data->assignRole(stringSlug('Farmer'));
                    $number = Farmer::count() + 1;
                    $farmer = new Farmer();
                    $farmer->account_id = $number;
                    $farmer->user_id = $data->id;
                    $farmer->save();
                    break;
                case 'community-leader':
                    $data->assignRole(stringSlug('Community Leader'));
                    $number = CommunityLeader::count() + 1;
                    $loanProvider = new CommunityLeader();
                    $loanProvider->account_id = $number;
                    $loanProvider->user_id = $data->id;
                    $loanProvider->save();
                    break;
                case 'loan-provider':
                    $data->assignRole(stringSlug('Loan Provider'));
                    $number = LoanProvider::count() + 1;
                    $loanProvider = new LoanProvider();
                    $loanProvider->account_id = $number;
                    $loanProvider->user_id = $data->id;
                    $loanProvider->save();
                    break;
            }
            $data->sendEmailVerificationNotification();
            Auth::loginUsingId($data->id);
            return redirect()->route('home');
        }

    }

    public function loneProviderProfileCreate()
    {
        return view(subDomainPath('loan-provider.profile.create'));
    }

    public function farmerProfileCreate()
    {
        return view(subDomainPath('farmer.profile.create'));
    }

    public function traceRegistration()
    {
        return view('trace.auth.register');
    }

    public function traceUserRegistrationStore(Request $request)
    {
        $rules = array(
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|max:255',
            'repeat-password' => 'required|same:password',
        );
        $messages = [
            'same'    => 'Password not match.',
            'repeat-password'    => 'This field is required..',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = new User();
        $data->email = $request->input('email');
        $data->password = bcrypt($request->input('password'));
        $data->passkey = $request->input('password');
        if($data->save()){

            $data->assignRole(stringSlug('Farmer'));
            $number = Farmer::count() + 1;
            $farmer = new Farmer();
            $farmer->account_id = $number;
            $farmer->user_id = $data->id;
            $farmer->save();

            $data->sendEmailVerificationNotification();
            Auth::loginUsingId($data->id);
            return redirect()->route('home');
        }

    }
}
