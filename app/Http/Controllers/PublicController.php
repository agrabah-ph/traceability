<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Trace;
use App\ModelInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function traceTracking($code)
    {
        $trace = Trace::with('inventories')->where('reference', $code)->first();
//        return $trace;
        return view('user.mobile.trace-tracking', compact('trace'));
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
                break;
            case 'Undeliverable':
                $update = $action;
                $modelInfo->value_0 = $action;
                $modelInfo->value_1 = 'Undeliverable';
                break;
        }
        $trace->info()->save($modelInfo);

        Trace::find($trace->id)->inventories()->update(array(
            'status'=>$update
        ));

//        return response()->json();
    }
}
