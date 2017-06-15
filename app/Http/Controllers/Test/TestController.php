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
        $filePath = 'storage/exports/'.iconv('UTF-8', 'GBK', '奖励查询报表样例').'.xlsx';
        Excel::load($filePath, function($reader) {
            $data = $reader->all();
//            dd($data);
            $value=array(array('Com'=>0,'Gro'=>0,'Mem'=>0,'Rname'=>0,'Rmb'=>0,'Rtime'=>0));

            foreach($data as $i => $val){
                if(count($val['机构'])!=0){
                    $value[$i]['Com']=$val['机构'];
                    $value[$i]['Gro']=$val['团队'];
                    $value[$i]['Mem']=$val['销售人员'];
                    $value[$i]['Rname']=$val['奖励名称'];
                    $value[$i]['Rmb']=$val['奖励金额'];
                    $value[$i]['Rtime']=$val['奖励时间'];
                }
//                echo $val['机构']." ".$val['团队']." ".$val['销售人员']." ".
//                    $val['奖励名称']." ".$val['奖励金额']." ".$val['奖励时间']."<br />";
            }
            dd($value);
//            $bool=Reward::insertexcel($value);//插入数据库
//            if($bool){
//                echo 1;
//            }
        });
    }
}