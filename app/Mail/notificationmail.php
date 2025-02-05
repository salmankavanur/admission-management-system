<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class notificationmail extends Mailable
{
    use Queueable, SerializesModels;
    public $name,$ID,$message_text;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$ID,$message_text)
    {
        $this->name = $name;
        $this->ID = $ID;
        $this->message_text = $message_text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Admission Management System')->view('emails.notification');
    }
}
