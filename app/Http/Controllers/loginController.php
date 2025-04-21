<?php

namespace App\Http\Controllers;

use App\Models\users_app;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function loginUser(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Buscar el usuario primero
        $user = \App\Models\users_app::where('username', $credentials['username'])->first();

        // Si no existe o está desactivado, mostrar error
        if (!$user || $user->state == 0) {
            return redirect()->route('app')->with('alerta', [
                'titulo' => '¡Error!',
                'mensaje' => 'El Usuario ingresdo no existe, intente nuevamente.',
                'icono' => 'error',
                'confirmarTexto' => 'Entendido',
                'mostrarCancelar' => false
            ]);
        }

        // Verificar las credenciales
        if (Auth::guard('web')->attempt($credentials)) {
            session(['fullname' => $user->fullname]);
            return redirect()->route('index');
        }

        // Si las credenciales no coinciden
        return redirect()->route('app')->with('alerta', [
            'titulo' => '¡Error!',
            'mensaje' => 'Usuario o contraseña incorrectos, intente nuevamente.',
            'icono' => 'error',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }


    public function logoutUser(Request $request)
    {
        auth()->guard('web')->logout();
        session()->forget(['fullname']);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('app')->with('alerta', [
            'titulo' => '',
            'mensaje' => 'Gracias por visitarnos.',
            'icono' => 'success',
            'confirmarTexto' => 'Entendido',
            'mostrarCancelar' => false
        ]);
    }
}
