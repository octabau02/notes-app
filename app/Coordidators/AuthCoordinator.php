<?php

namespace App\Coordidators;

use App\Services\AuthService;
use App\Services\UsuarioService;

class AuthCoordinator
{
    public static function ingresar($credenciales): bool
    {
        $usuario = UsuarioService::obtener(null ,$credenciales['email']);

        if(empty($usuario)){
            //throw new Exception('No existe el usuario con ese correo');
            return false;
        }
        return AuthService::ingresar($credenciales);
    }
}
