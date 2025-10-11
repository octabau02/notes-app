<?php

namespace App\Services;

use App\BO\UsuarioBO;
use App\RepoAction\UsuarioRepoAction;
use App\RepoData\UsuarioRepoData;
use Exception;

class UsuarioService
{
    public static function listar($filtros = [], $columnas = '', $orden = [], $limit = null, $offset = null){

        $usuarios = UsuarioRepoData::listar($filtros, $columnas, $orden, $limit, $offset);
        return $usuarios;
    }

    public static function agregar($usuarioData){
        $usuarios = self::listar(['email' => $usuarioData['email']], 'id,email');
        if(!empty($usuarios)){
            throw new Exception('El correo ingresado ya esta registrado');
            return redirect()->route('registrar')->withErrors(['El correo ingresado ya esta registrado'])->withInput();
        }

        $insertUsuario = UsuarioBO::armarInsert($usuarioData);
        UsuarioRepoAction::agregar($insertUsuario);
    }

    public static function obtener($id, $email, $columnas = []){

        $usuario = UsuarioRepoData::obtener($id, $email, $columnas);
        return $usuario;
    }
}
