<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionTimeout
{
    public function handle(Request $request, Closure $next)
    {
        $timeout = 15; // en minutos

        if (Session::has('last_activity') && (time() - Session::get('last_activity')) > ($timeout * 60)) {
            auth()->guard('web')->logout();
            session()->forget(['fullname']);
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('app')->with('alerta', [
                'titulo' => 'Atención',
                'mensaje' => 'Su sesión se ha cerrado por inactividad.',
                'icono' => 'warning',
                'confirmarTexto' => 'Entendido',
                'mostrarCancelar' => false,
                'cleanMenu' => true
            ]);
        }

        Session::put('last_activity', time());

        return $next($request);
    }
}
