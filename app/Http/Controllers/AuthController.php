<?php

namespace App\Http\Controllers;

use App\Coordidators\AuthCoordinator;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class AuthController extends Controller
{
        public function mostrarLogin()
    {
        try {
            if(Auth::check()){
                return redirect()->route('notas.gestor');
            }
            return view('Auth.login');
        } catch (Throwable $error) {
            Log::error('Ocurrio un error al mostrar la pagina inicio de sesión' . $error);
            return redirect()->back()->withErrors(['Ocurrio un error al mostrar la pagina inicio de sesión']);
        }
    }

    public function login(Request $request)
    {
        try {
            $credenciales = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if(AuthCoordinator::ingresar($credenciales)){
                return redirect()->route('notas.gestor');
            }
            return redirect()->back()->withErrors(['Las credenciales ingresadas no son correctas']);
        } catch (Throwable $error) {
            Log::error('Ocurrio un error al inicar sesión' . $error);
            return redirect()->back()->withErrors(['Ocurrio un error al inicar sesión' . $error->getMessage()]);
        }
    }

    public function logout()
    {
        try {
            AuthService::cerrarSesion();
            return redirect('login');
        } catch (Throwable $error) {
            Log::error('Ocurrio un error al cerrar sesión' . $error);
            return redirect()->back()->withErrors(['Ocurrio un error al cerrar sesión' . $error]);
        }
    }
}
