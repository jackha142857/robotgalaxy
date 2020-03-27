<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $name;
    public $sender;
    public $subject;
    public $content;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $sender, $subject, $content)
    {
        $this->name = $name;
        $this->sender = $sender;
        $this->subject = $subject;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.content');
    }
}
