<?php

namespace App\BO;

use Illuminate\Support\Facades\Hash;

class UsuarioBO
{
    public static function armarInsert($usuarioData){
        $usuario = [
            'name' => $usuarioData['name'],
            'email' => $usuarioData['email'],
            'password' => Hash::make($usuarioData['password']),
            'created_at' => now(),
        ];

        return $usuario;
    }
}
