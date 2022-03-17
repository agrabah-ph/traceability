<?php

namespace App\Http\Controllers;

use App\CommunityLeader;
use App\Events\NewUserRegisteredEvent;
use App\Exports\FarmersExport;
use App\Farmer;
use App\Inventory;
use App\Loan;
use App\LoanPaymentSchedule;
use App\LoanProvider;
use App\Trace;
use App\ModelInfo;
use App\User;
use Carbon\Carbon;
use CreatvStudio\Itexmo\Facades\Itexmo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class PublicController extends Controller
{
    public function traceTracking($code)
    {
        $trace = Trace::with('inventories')->where('reference', $code)->first();
//        return $trace;
        return view('trace.mobile.trace-tracking', compact('trace'));
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
            $trace->note = $request->input('note');
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
        $note = $request->input('note');
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
                $trace->note = $note;
                break;
            case 'Undeliverable':
                $update = $action;
                $modelInfo->value_0 = $action;
                $modelInfo->value_1 = 'Unable to Deliver';
                $trace->active = 0;
                $trace->note = $note;
                break;
        }
        $trace->save();
        $trace->info()->save($modelInfo);

        Trace::find($trace->id)->inventories()->update(array(
            'status'=>$update
        ));

        emailNotification('trace-status-update', $trace->id);

//        return response()->json();
    }

    public function traceInfo($code)
    {
        $data = Trace::where('reference', $code)->first();
//        return $data;
        return view('trace.mobile.trace-info', compact('data'));
    }

    public function farmerQr(Request $request)
    {
        return view('trace.mobile.scan-qr-farmer');
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

        $user = new User();
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->passkey = $request->input('password');
        if($user->save()){
            switch ($request->input('type')){
                case 'farmer':
                    $user->assignRole(stringSlug('Farmer'));
//                    $number = Farmer::count() + 1;
                    $number = str_pad(Farmer::count() + 1, 5, 0, STR_PAD_LEFT);
                    $farmer = new Farmer();
                    $farmer->account_id = $number;
                    $farmer->user_id = $user->id;
                    $farmer->save();
                    break;
                case 'loan-provider':
                    $user->assignRole(stringSlug('Loan Provider'));
//                    $number = LoanProvider::count() + 1;
                    $number = str_pad(LoanProvider::count() + 1, 5, 0, STR_PAD_LEFT);
                    $loanProvider = new LoanProvider();
                    $loanProvider->account_id = $number;
                    $loanProvider->user_id = $user->id;
                    $loanProvider->save();
                    break;
            }
            $user->sendEmailVerificationNotification();
//            event(new NewUserRegisteredEvent($user));

            Auth::loginUsingId($user->id);
            return redirect()->route('home');
        }

    }

    public function farmerProfileCreate()
    {
        return view('trace.profile.create');
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

        $user = new User();
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->passkey = $request->input('password');
        if($user->save()){

            $user->assignRole(stringSlug('Farmer'));
            $number = str_pad(Farmer::count() + 1, 5, 0, STR_PAD_LEFT);
            $farmer = new Farmer();
            $farmer->account_id = $number;
            $farmer->user_id = $user->id;
            $farmer->save();

//            $user->sendEmailVerificationNotification();
            event(new NewUserRegisteredEvent($user));
            Auth::loginUsingId($user->id);
            return redirect()->route('home');
        }

    }

    public function wharfUserRegistrationStore(Request $request)
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

            switch ($type = $request->input('type')){
                case 'farmer':
                case 'borrower':
                case 'community-leader':
                    $data->assignRole(stringSlug('Farmer'));
//                    $number = Farmer::count() + 1;
                    $number = str_pad(Farmer::count() + 1, 5, 0, STR_PAD_LEFT);
                    $farmer = new Farmer();
                    $farmer->account_id = $number;
                    $farmer->user_id = $data->id;
                    if($type == 'community-leader'){
                        $farmer->community_leader = 1;
                    }
                    $farmer->save();
                    break;
                case 'loan-provider':
                    $data->assignRole(stringSlug('Loan Provider'));
//                    $number = LoanProvider::count() + 1;
                    $number = str_pad(LoanProvider::count() + 1, 5, 0, STR_PAD_LEFT);
                    $loanProvider = new LoanProvider();
                    $loanProvider->account_id = $number;
                    $loanProvider->user_id = $data->id;
                    $loanProvider->save();
                    break;
                default:
                    $data->assignRole(stringSlug($type));
                    break;
            }

            $data->sendEmailVerificationNotification();
            Auth::loginUsingId($data->id);
            return redirect()->route('home');
        }

    }

    public function qrReader()
    {
        return view('trace.mobile.qr-reader');
    }

    public function smsTest()
    {
        Itexmo::to('09152451835')->content('Test SMS from Agrabah Loan App')->send();
    }

    public function activation()
    {
        return view('layouts.account-activation');
    }

    public function export()
    {
        return Excel::download(new FarmersExport(), 'farmers.xlsx');
    }

    public function test()
    {
        $loans = Loan::where('status', 'Active')->get();
//        smsNotification('loan-due', 1);
        return $loans;
    }

    public function scan()
    {
        return view('trace.scan');
    }

    public function submitRemark(Request $request)
    {
        $data = Inventory::find($request->input('id'));
        $data->receiver_remark = $request->input('remark');
        $data->save();

        return $data;
    }
}
