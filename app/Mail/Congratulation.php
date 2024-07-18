<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Bike;

class Congratulation extends Mailable
{
    use Queueable, SerializesModels;
    public $bike;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Bike $bike)
    {
        $this->bike = $bike;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@larabikes.com')
                    ->subject('Felicidades!')
                    ->view('emails.congratulation');
    }
}
