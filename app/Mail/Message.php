<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Message extends Mailable
{

    use Queueable, SerializesModels;
    public $email;
    public $direction;
    public $name;
    public $note;
    public $phone;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $direction, $name,  $phone, $note)
    {
        $this->email = $email;
        $this->name = $name;
        $this->direction = $direction;
        $this->phone = $phone;
        $this->note = $note;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Заявка с KazMediaPro')
            ->markdown('emails.messages');
    }
}
