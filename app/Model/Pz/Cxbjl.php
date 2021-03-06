<?php
namespace App\Model\Pz;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Empty_;
use Illuminate\Support\Facades\Storage;


class  Cxbjl extends Model{
    public static function consearch($conmessage)
    {
        $d = $conmessage['Date1'];
        $o = $conmessage['Order1'];
        $e = $conmessage['Date2'];
//        dd($com);
        if (!Empty($d) && !Empty($o) && !Empty($e)) {
            $row = DB::table('main')
                ->where('Order1', '=', $o)
                ->where('Pass3', '=', '1')
                ->whereBetween('Date',array($d,$e))
                ->get();
            return $row;

        } elseif (!Empty($o)) {
            $row = DB::table('main')
                ->where('Order1','=',$o)
                ->where('Pass3', '=', '1')
                ->get();
            return $row;
        } elseif (!Empty($d) && !Empty($e)) {
            $row = DB::table('main')
                ->whereBetween('Date',array($d,$e))
                ->where('Pass3', '=', '1')
                ->get();
            return $row;
        } else{
            return 0;
        }
    }
    public static function consearched($searchmessage)
    {
        $d = $searchmessage['Date1'];
        $o = $searchmessage['Order1'];
        $e = $searchmessage['Date2'];
//        dd($com);
        if (!Empty($d) && !Empty($o) && !Empty($e)) {
            $row = DB::table('main')
                ->where('Order1', '=', $o)
                ->where('Tag3', '=', '1')
                ->whereBetween('Date',array($d,$e))
                ->get();
            return $row;

        } elseif (!Empty($o)) {
            $row = DB::table('main')
                ->where('Order1','=',$o)
                ->where('Tag3', '=', '1')
                ->get();
            return $row;
        } elseif (!Empty($d) && !Empty($e)) {
            $row = DB::table('main')
                ->whereBetween('Date',array($d,$e))
                ->where('Tag3', '=', '1')
                ->get();
            return $row;
        } else{
            return 0;
        }
    }
    //未审核
    public static function searchx(){
        $row = DB::table('main')
            ->where('Pass3','=','1')
            ->get();
        return $row;
    }
    //已审核
    public static function searchy(){
        $row = DB::table('main')
            ->where('Tag3','=','1')
            ->get();
        return $row;
    }
    public static function rejected(){
        $row = DB::table('main')
            ->where('Reject3','!=',null)
            ->get();
        return $row;
    }
    public static function detailx($order){
        $row = DB::table('main')
            ->where('Order1','=',$order)
            ->first();
        return $row;
    }
    public static function rejectedtails($order){
        $row = DB::table('main')
            ->where('Order1','=',$order)
            ->first();
        return $row;
    }

    public static function pass($order,$advice){
        $bool=DB::update('update main set Pass3 = ?,Pass4 = ?,Tag3 = ?,Advice3 = ?  where Order1 = ?',
            [0,1,1,$advice,$order]);
        return $bool;
    }
    public static function nopass($order,$advice){
        $bool=DB::update('update main set State = ?,Pass3 = ?,Advice3 = ?,Tag3 = ?,Reject3 = ? where Order1 = ?',
            ['未通过',0,$advice,1,null,$order]);
        return $bool;
    }

    public static function backreject($s,$advice,$order){

        $bool=DB::update('update main set Reject3 = ? , Advice3 = ? ,'.$s.'= ? where Order1 = ?',
            [null,$advice,1,$order]);
        return $bool;

    }
    public static function reject($order,$s,$i,$advice){
        $bool=DB::update('update main set Pass3 = ?, Tag3 = ? , '.$s.'  = ? ,Advice3 = ? where Order1 = ? ',
            [0,1,$i,$advice,$order]);
        return $bool;
    }

}