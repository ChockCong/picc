<?php

namespace App\Model\Pz;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class Jydw extends Model
{
    public static function messageall($com)
    {
        $row = DB::table('main')
            ->where('Order1','like',$com.'%')
            ->orderby('Date','desc')
            ->get();
        return $row;
    }

    public static function consearch($conmessage,$com)
    {

        $d = $conmessage['Date1'];
        $o = $conmessage['Order1'];
        $e = $conmessage['Date2'];
//        dd($com);
        if (!Empty($d) && !Empty($o) && !Empty($e)) {
            $row = DB::table('main')
                ->where('Order1', '=', $o)
                ->whereBetween('Date',array($d,$e))
                ->where('Order1','like',$com.'%')
                ->get();
            return $row;

        } elseif (!Empty($o)) {
            $row = DB::table('main')
                ->where('Order1','=',$o)
                ->where('Order1','like',$com.'%')
                ->get();
            return $row;
        } elseif (!Empty($d) && !Empty($e)) {
            $row = DB::table('main')
                ->whereBetween('Date',array($d,$e))
                ->where('Order1','like',$com.'%')
                ->get();
            return $row;
        } else{
            return 0;
        }
    }

    public static function insert($refermessage)
    {
        $i = $refermessage;
        $o = $i['Order'];
        $com = $i['Com'];
        $na = $i['Name'];
        $da = $i['Date'];
        $nu = $i['Num'];
        $t = $i['Title'];
        $c = $i['Content'];
        $s = '审核中';
        $bool = DB::insert('insert into main (Order1,Com,Name,Date,Num,Content,State,Pass1,Title) values (?,?,?,?,?,?,?,?,?)',
            [$o, $com, $na, $da, $nu, $c, $s, 1,$t]);
        return $bool;
    }

    public static function uploadfiles($f,$o)
    {
    foreach ($f as $value) {
    //文件是否上传成功
        $originalName = $value->getClientOriginalName(); //源文件名
        $ext = $value->getClientOriginalExtension();    //文件拓展名
//        dd($ext);
        $type = $value->getClientMimeType(); //文件类型
//        dd($type);
        $realPath = $value->getRealPath();   //临时文件的绝对路径
//        dd($realPath);
        $fileName = date('YmdHis').'-'.uniqid().'.'.$ext;  //新文件名
//                    echo $fsileName.'<br>';
        Storage::disk('uploads')->put($fileName,file_get_contents($realPath));
        $bool=DB::insert('insert into files (Order1,FileName,Name,Route) values (?,?,?,?)',
            [$o,$fileName,$originalName,0]);
    }
     return $bool;

    }
    public static function getdetail($order)
    {
        $row = DB::table('main')
            ->where('Order1', '=', $order)
            ->first();
        return $row;
    }
    public static function getfiles($order){
        $row = DB::table('files')
            ->where('Order1', '=', $order)
            ->get();
        return $row;
    }

    public static function rejected()
    {
        $row = DB::table('main')
            ->where('State', '=', '未通过')
            ->get();
        return $row;
    }

    public static function getrejectedetail($order)
    {
        $row = DB::table('main')
            ->where('Order1', '=', $order)
            ->first();
        return $row;
    }

    public static function altermessage($altermessage)
    {
        $o = $altermessage['Order1'];
        $n = $altermessage['Num'];
        $c = $altermessage['Content'];
        $t = $altermessage['Title'];
        $s = '审核中';

        $bool = DB::update('update main set Title = ?,Num = ?,Content = ?,State = ?,Pass1 = ?,Tag1 = ?,Tag2 = ?,Tag3 = ?,Tag4 = ?,Tag5 = ?,Tag6 = ?,Advice1 = ?,Advice2 = ?,Advice3 = ?,Advice4 = ?,Advice5 = ?,Advice6 = ?  where Order1 = ?',
            [$t,$n,$c,$s,1,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,$o]);
//        DB::update('update jydw set Num=?,File=?,Content=?,State=? ',
//            [$n,$f,$c,$s]);
        return $bool;
    }
    public static function alterfiles($o,$f){
//        删除文件
        $i=DB::table('files')
            ->where('Order1', '=', $o)
            ->get();
          foreach ($i as $a){
              Storage::disk('uploads')->delete($a->FileName);
          }
//          删除表
         DB::table('files')
             ->where('Order1', '=', $o)
             ->delete();
        foreach ($f as $value) {
            //文件是否上传成功
            $originalName = $value->getClientOriginalName(); //源文件名
            $ext = $value->getClientOriginalExtension();    //文件拓展名
//        dd($ext);
            $type = $value->getClientMimeType(); //文件类型
//        dd($type);
            $realPath = $value->getRealPath();   //临时文件的绝对路径
//        dd($realPath);
            $fileName = date('YmdHis') . '-' . uniqid() . '.' . $ext;  //新文件名
//                    echo $fileName.'<br>';
            Storage::disk('uploads')->put($fileName, file_get_contents($realPath));
            DB::insert('insert into files (Order1,FileName,Name,Route) values (?,?,?,?)',
                [$o,$fileName,$originalName,0]);
        }
        return 1;
    }
}
