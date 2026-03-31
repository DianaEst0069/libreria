<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertaLoginCorreo;

class EnviarCorreo
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        //Obtener la información del usuario en cuento inicia sesión 
        $user = $event->user;

        //Obtener el correo del usuario y construir el correo para enviarlo
        Mail::to($user->email())->send(new AlertaLoginCorreo($user));
    }
}
