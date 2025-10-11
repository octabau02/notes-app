<?php

namespace App\BO;

use Exception;
use Illuminate\Support\Facades\Auth;

class NotaBO
{
    public static function armarInsert($tipo, $data)
    {
        $nota = [
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => Auth::id(),
            'created_at' => now(),
        ];

        self::agregarCamposExt($tipo, $data, $nota);
        return $nota;
    }

    public static function armarUpdate($tipo, $data){
        $nota = [
            'title' => $data['title'],
            'content' => $data['content'],
            'updated_at' => now(),
        ];

        self::agregarCamposExt($tipo, $data, $nota);
        return $nota;
    }

    private static function agregarCamposExt($tipo, $data, &$nota){
        switch ($tipo) {
            case 'normal':
                $nota['type'] = 'normal';
                break;

            case 'important':
                $nota['type'] = 'important';
                break;

            case 'reminder':
                $nota['type'] = 'reminder';
                $nota['reminder_date'] = !empty($data['reminder_date']) ? $data['reminder_date'] : null;
                break;

            default:
                throw new Exception('Tipo de nota no soportado');
                break;
        }
    }
}
