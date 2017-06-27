<?php
namespace App\Http\Controllers\Test;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel;
use App\Model\Reward\Reward;


class TestController extends Controller
{
    //Excel文件导出功能 By Laravel学院
    public function export(){
        $cellData = [
            ['学号','姓名','成绩'],
            ['10001','AAAAA','99'],
            ['10002','BBBBB','92'],
            ['10003','CCCCC','95'],
            ['10004','DDDDD','89'],
            ['10005','EEEEE','96'],
        ];

        Excel::create(iconv('UTF-8', 'GBK', '学生成绩'),function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->store('xls')->export('xls');

    }
    public function import(){

//        foreach ($f as $value) {
//            //文件是否上传成功
//            $originalName = $value->getClientOriginalName(); //源文件名
//            $ext = $value->getClientOriginalExtension();    //文件拓展名
////        dd($ext);
//            $type = $value->getClientMimeType(); //文件类型
////        dd($type);
//            $realPath = $value->getRealPath();   //临时文件的绝对路径
////        dd($realPath);
//            $fileName = date('YmdHis').'-'.uniqid().'.'.$ext;  //新文件名
////                    echo $fsileName.'<br>';
//            Storage::disk('uploads')->put($fileName,file_get_contents($realPath));
//            $bool=DB::insert('insert into files (Order1,FileName,Name,Route) values (?,?,?,?)',
//                [$o,$fileName,$originalName,0]);
//        }
//        return $bool;


        $filePath = 'storage/exports/'.iconv('UTF-8', 'GBK', '奖励佣金导入表样例').'.xlsx';
        Excel::load($filePath, function($reader) {
            $data = $reader->all();
//            dd($data);
            $value=array(array('Com'=>0,'Gcode'=>0,'Eid'=>0,'Mem'=>0,'Jlj'=>0,'Grj'=>0));

            foreach($data as $i => $val){
                if(count($val['机构名称'])!=0){
                    $value[$i]['Com']=$val['机构名称'];
                    $value[$i]['Gcode']=$val['团队代码'];
                    $value[$i]['Eid']=$val['工号'];
                    $value[$i]['Mem']=$val['姓名'];
                    $value[$i]['Jlj']=$val['经理奖'];
                    $value[$i]['Grj']=$val['个人奖'];
                }
//                echo $val['机构']." ".$val['团队']." ".$val['销售人员']." ".
//                    $val['奖励名称']." ".$val['奖励金额']." ".$val['奖励时间']."<br />";
            }
//            dd($value);
            $bool=Reward::insertexcel($value);//插入数据库
            if($bool){
                echo 1;
            }
        });
    }
}