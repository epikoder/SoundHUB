<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailReset extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Activation key
     *
     * @var $data
     */
    public $data;

    /**
     * Create a new message instance.
     *
     * @param mixed $key
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.reset')
                    ->with('data', $this->data);
    }
}
