<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public static function ingresar($usuarioData): bool
    {
        return Auth::attempt($usuarioData);
    }

    public static function cerrarSesion()
    {
        Auth::logout();
    }
}
