<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificaSolMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject='SIGE te informa de un nuevo mensaje para gestion';
    public $contenido;

    public function __construct($contenido)
    {
        $this->contenido = $contenido;  //nueva instancia del contenido
    }


    public function build()
    {
        return $this->view('emails.notificacion');  //se crea el mensaje
    }
}
