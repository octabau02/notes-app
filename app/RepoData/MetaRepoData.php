<?php

namespace App\RepoData;

use Illuminate\Support\Facades\DB;

class MetaRepoData
{
    public static function obtener(array $data = []){
        $query = DB::table('metadata');

        if(isset($data['key'])){
            $query->where('key', $data['key']);
        }

        return $query->value('value');
    }
}
