<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Model\Reward\Reward;
use Excel;

class RewardController extends Controller{
    public function rshow(){
        return view('Reward.importreward');
    }

    public function rimport(Request $request){
        $refermessage = $request->all();
        $d = $refermessage['date1'];
        $f = $request->file('file1');	//接文件
        $filename=Reward::uploadfiles($f);
        if($filename!=0){
            $filePath = 'storage/exports/'.iconv('UTF-8', 'GBK', $filename).'.xlsx';
            echo 1;
        }
    }
}



