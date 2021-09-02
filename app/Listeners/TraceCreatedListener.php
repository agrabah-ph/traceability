<?php

namespace App\Listeners;

use App\Mail\TraceShipped;
use App\Trace;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class TraceCreatedListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        dd($event);
//        Mail::to($event->details['email'])->send(new TraceShipped($event->details));

        $trace = Trace::find($event->trace->id);

        $details = [
            'title' => 'Agrabah Shipping details.',
            'url' => route('trace-tracking', array('code'=>$trace->reference)),
            'body' => '<p>Please present this CODE upon receiving your package.</p><br><table><thead><tr><th colspan="4" align="center">Dispatch Information</th></tr></thead><tbody><tr><td width="150" align="left">Driver Name</td><td align="left">'. $trace->dispatch->value_0 .'</td></tr><tr><td align="left">Mobile no.</td><td align="left">'. $trace->dispatch->value_1 .'</td></tr><tr><td align="left">Vehicle Type</td><td align="left">'. $trace->dispatch->value_2 .'</td></tr><tr><td align="left">Plate No.</td><td align="left">'. $trace->dispatch->value_3 .'</td></tr></tbody></table><br><br><br>',
            'code' => $trace->receiver->value_3
        ];

        Mail::to($trace->receiver->value_1)->send(new TraceShipped($details));
    }
}
