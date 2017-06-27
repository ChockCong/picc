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

    public static function uploadfiles($value)
    {

            //文件是否上传成功
            $originalName = $value->getClientOriginalName(); //源文件名
            $ext = $value->getClientOriginalExtension();    //文件拓展名
//        dd($ext);
            $type = $value->getClientMimeType(); //文件类型
//        dd($type);
            $realPath = $value->getRealPath();   //临时文件的绝对路径
//        dd($realPath);

            $fileName = iconv('UTF-8', 'GBK', $originalName).'-'.uniqid().'.'.$ext;  //新文件名
//                    echo $fsileName.'<br>';
            Storage::disk('exports')->put($fileName,file_get_contents($realPath));

        return $fileName;

    }

}
