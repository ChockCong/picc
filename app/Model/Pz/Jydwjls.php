<?php
namespace App\Model\Pz;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Empty_;
use Illuminate\Support\Facades\Storage;


class  Jydwjls extends Model{
    public static function consearch($conmessage,$com)
{
    $d = $conmessage['Date1'];
    $o = $conmessage['Order1'];
    $e = $conmessage['Date2'];
//        dd($com);
    if (!Empty($d) && !Empty($o) && !Empty($e)) {
        $row = DB::table('main')
            ->where('Order1', '=', $o)
            ->where('Pass1', '=', '1')
            ->whereBetween('Date',array($d,$e))
            ->where('Order1','like',$com.'%')
            ->get();
        return $row;

    } elseif (!Empty($o)) {
        $row = DB::table('main')
            ->where('Order1','=',$o)
            ->where('Pass1', '=', '1')
            ->where('Order1','like',$com.'%')
            ->get();
        return $row;
    } elseif (!Empty($d) && !Empty($e)) {
        $row = DB::table('main')
            ->whereBetween('Date',array($d,$e))
            ->where('Pass1', '=', '1')
            ->where('Order1','like',$com.'%')
            ->get();
        return $row;
    } else{
        return 0;
    }
}
    public static function consearched($searchmessage,$com)
    {
        $d = $searchmessage['Date1'];
        $o = $searchmessage['Order1'];
        $e = $searchmessage['Date2'];
//        dd($com);
        if (!Empty($d) && !Empty($o) && !Empty($e)) {
            $row = DB::table('main')
                ->where('Order1', '=', $o)
                ->where('Tag1', '=', '1')
                ->whereBetween('Date',array($d,$e))
                ->where('Order1','like',$com.'%')
                ->get();
            return $row;

        } elseif (!Empty($o)) {
            $row = DB::table('main')
                ->where('Order1','=',$o)
                ->where('Tag1', '=', '1')
                ->where('Order1','like',$com.'%')
                ->get();
            return $row;
        } elseif (!Empty($d) && !Empty($e)) {
            $row = DB::table('main')
                ->whereBetween('Date',array($d,$e))
                ->where('Tag1', '=', '1')
                ->where('Order1','like',$com.'%')
                ->get();
            return $row;
        } else{
            return 0;
        }
    }
    //未审核
    public static function searchx($com){
        $row = DB::table('main')
            ->where('Order1','like',$com.'%')
            ->where('Pass1','=','1')
            ->get();
        return $row;
    }
    //已审核
    public static function searchy($com){
        $row = DB::table('main')
            ->where('Order1','like',$com.'%')
//            ->where('Pass1','=','1')
                ->where('Tag1','=','1')
            ->get();
        return $row;
    }
    public static function detailx($order){
        $row = DB::table('main')
            ->where('Order1','=',$order)
            ->first();
        return $row;
    }

    public static function pass($order,$advice){
        $bool=DB::update('update main set Pass1 = ?,Pass2 = ?,Tag1 = ?,Advice1 = ?  where Order1 = ?',
            [0,1,1,$advice,$order]);
        return $bool;
    }
    public static function nopass($order,$advice){
        $bool=DB::update('update main set State = ?,Pass1 = ?,Advice1 = ?,Tag1 = ? where Order1 = ?',
            ['未通过',0,$advice,1,$order]);
        return $bool;
    }

    public static function rejected(){
        $row = DB::table('main')
            ->where('Reject1','!=',null)
            ->get();
        return $row;
    }
    public static function rejectedtails($order){
            $row = DB::table('main')
                ->where('Order1','=',$order)
                ->first();
            return $row;
    }
    public static function backreject($s,$advice,$order){

        $bool=DB::update('update main set Reject1 = ? , Advice1 = ? ,'.$s.'= ? where Order1 = ?',
            [null,$advice,1,$order]);
        return $bool;

    }

}