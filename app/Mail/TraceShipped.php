<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TraceShipped extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $trace;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($trace)
    {
        $this->trace = $trace;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.trace.shipped')
            ->with('details', $this->trace);

//        return $this->markdown('emails.trace.shipped');
    }
}
