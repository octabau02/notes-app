<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserController extends Controller
{
    public function mostrarRegistro()
    {
        try {
            if(Auth::check()){
                return redirect()->route('notas.gestor');
            }
            return view('Auth.register');
        } catch (Throwable $error) {
            Log::error('Ocurrio un error al mostrar la pagina de registro' . $error);
            return redirect()->back()->withErrors(['Ocurrio un error al mostrar la pagina de registro']);
        }
    }

    public function agregar(Request $request)
    {
        try{
            $usuarioData = $request->validate([
                'name' => 'string|required|max:255',
                'email' => 'string|email|required',
                'password' => 'string|required|min:8',
            ]);

            UsuarioService::agregar($usuarioData);
            return redirect('login')->with('success', 'Usuario Registrado correctamente');
        }catch(Throwable $error){
            Log::error('Ocurrio un error al registrar el usuario' . $error);
            return redirect('register')->withErrors(['Ocurrio un error al registrar el usuario: ' . $error->getMessage()])->withInput();
        }
    }
}
