<?php

namespace App\Mail;

use App\MessagePhoto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendMessage extends Mailable
{
    use Queueable, SerializesModels;


    public $essais;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(MessagePhoto $essais)
    {
        $this->essais = $essais;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this
            ->from('contact@equicode.fr', '[Equicode] Nouveau message')
            ->view('email.sendMessage');
    }
}
