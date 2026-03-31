<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertaLoginCorreo;

use Illuminate\Support\Facades\Cache;

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

        //Registrar el envio del correo en la cache
        $registro = 'login_' . $user -> id;

        //Evaluar si el usuario ya recibió un correo
        if(cache::has($registro)){
            return;
        }

        //Registrar envio de correo en cache y borrarlo después
        Cache::pull($registro,true, now()-> addSeconds(10));

        //Obtener el correo del usuario y construir el correo para enviarlo
        Mail::to($user->email)->send(new AlertaLoginCorreo($user));
    }
}
