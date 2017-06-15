<?php

namespace App\Model\Reward;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class Reward extends Model
{
    public static function insertexcel($data)
    {
        var_dump($data);
        $bool =DB::table('edata')->insert($data);
        return $bool;
    }

}
