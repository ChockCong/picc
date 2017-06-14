<?php
namespace App\Model\Pz;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class  Zjl extends Model
{
    public static function searchx()
    {
        $row = DB::table('main')
            ->where('Pass6', '=', '1')
            ->get();
        return $row;
    }

    public static function searchy()
    {
        $row = DB::table('main')
            ->where('Tag6', '=', '1')
            ->get();
        return $row;
    }

    public static function consearch($conmessage)
    {
        $d = $conmessage['Date1'];
        $o = $conmessage['Order1'];
        $e = $conmessage['Date2'];
//        dd($com);
        if (!Empty($d) && !Empty($o) && !Empty($e)) {
            $row = DB::table('main')
                ->where('Order1', '=', $o)
                ->where('Pass6', '=', '1')
                ->whereBetween('Date', array($d, $e))
                ->get();
            return $row;

        } elseif (!Empty($o)) {
            $row = DB::table('main')
                ->where('Order1', '=', $o)
                ->where('Pass6', '=', '1')
                ->get();
            return $row;
        } elseif (!Empty($d) && !Empty($e)) {
            $row = DB::table('main')
                ->whereBetween('Date', array($d, $e))
                ->where('Pass6', '=', '1')
                ->get();
            return $row;
        } else {
            return 0;
        }
    }

    public static function consearched($conmessage)
    {
        $d = $conmessage['Date1'];
        $o = $conmessage['Order1'];
        $e = $conmessage['Date2'];
//        dd($com);
        if (!Empty($d) && !Empty($o) && !Empty($e)) {
            $row = DB::table('mian')
                ->where('Order1', '=', $o)
                ->where('Tag6', '=', '1')
                ->whereBetween('Date', array($d, $e))
                ->get();
            return $row;
        }
    }
    public static function pass($order,$advice){
        $bool=DB::update('update main set Pass6 = ?, Tag6 = ?,State = ? ,Advice6 = ? where Order1 = ?',
            [0,1,'通过',$advice,$order]);
        return $bool;
    }
    public static function nopass($order,$advice){
        $bool=DB::update('update main set State = ?,Pass6 = ?,Advice6 = ?,Tag6 = ? where Order1 = ?',
            ['未通过',0,$advice,1,$order]);
        return $bool;
    }

    public static function reject($order,$s,$i,$advice){

        $bool=DB::update('update main set Pass6 = ?, Tag6 = ? , '.$s.'  = ? ,Advice6 = ? where Order1 = ? ',
            [0,1,$i,$advice,$order]);
        return $bool;
    }
}