<?php

namespace App\Mail;

use App\Devis;
use App\MessagePhoto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendDevis extends Mailable
{
    use Queueable, SerializesModels;


    public $essais;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Devis $essais)
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
            ->from('contact@equicode.fr', '[Equicode] Nouveau devis')
            ->view('email.sendDevis');
    }
}
