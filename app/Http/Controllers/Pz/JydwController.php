<?php
/**
 * Created by PhpStorm.
 * User: PICC
 * Date: 2017/5/24
 * Time: 17:27
 */
namespace App\Http\Controllers\Pz;
use App\Http\Controllers\Controller;
use App\Model\Pz\Jydw;
use Illuminate\Http\Request;


class JydwController extends Controller {


    //从模型中获取jydw表存放到数组返回view
    public function show(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="经营单位") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
        }else
            return view('Pz.jydw.index');

    }
    public  function main(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep=="经营单位")
            return view('Pz.jydw.main');
        else
            return redirect()->action('LoginController@login');

    }
    public function logo(Request $request){
            return view('Pz.jydw.logo');

    }
    //从Jydwview中获取数据申报信息，提交申请，存放到jydwjls表中
    public function refer(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="经营单位") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
    //获取申报数据
        $refermessage = $request->all();
        $o=$refermessage['Order'];
        $c=$refermessage['Content'];
        $n=$refermessage['Num'];
        $t=$refermessage['Title'];
        $f = $request->file('FileMessage');	//接文件

        if (!is_numeric($n)){
            echo "<script>alert('申报审批金额格式不对');history.go(-1);</script>";
        }elseif (is_null($f[0])){
            echo "<script>alert('请选择上传文件');history.go(-1);</script>";
        }elseif (Empty($c)){
            echo "<script>alert('请填写申报描述');history.go(-1);</script>";
        }elseif (Empty($t)){
            echo "<script>alert('请填写申报工单标题');history.go(-1);</script>";
        } else{
            if (Jydw::insert($refermessage) && Jydw::uploadfiles($f,$o)){
                echo "<script>alert('申报成功');</script>";
                return view('Pz.jydw.index');
            }
            else{
                echo "<script>alert('申报失败');history.go(-1);</script>";
            }
          }
        }
//查询所有数据返回页面显示
    public function searchall(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="经营单位"){
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $i=session()->get('user');
        $row1=$i->Com;
        if($row1=="端州支公司"){
            $com="DZ";
        }elseif($row1=="怀集支公司"){
            $com="HJ";
        }elseif($row1=="广宁支公司"){
            $com="GD";
        }elseif($row1=="封开支公司"){
            $com="FK";
        }elseif($row1=="高要支公司"){
            $com="GY";
        }elseif($row1=="德庆支公司"){
            $com="DQ";
        }elseif($row1=="四会支公司"){
            $com="SH";
        }
        elseif($row1=="电子商务业务部"){
            $com="DZSWYW";
        }elseif($row1=="车商业务部"){
            $com="CSYW";
        }
        $row=0;
        $row = Jydw::messageall($com);
        return view('Pz.jydw.search',compact('row'));
    }
    //条件查询数据返回页面显示
    public function consearch(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="经营单位"){
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $searchmessage = $request->all();
        $o=$searchmessage['Order1'];
        $d=$searchmessage['Date1'];
        $e=$searchmessage['Date2'];
        $i=session()->get('user');
        $row1=$i->Com;
        if($row1=="端州支公司"){
            $com="DZ";
        }elseif($row1=="怀集支公司"){
            $com="HJ";
        }elseif($row1=="广宁支公司"){
            $com="GD";
        }elseif($row1=="封开支公司"){
            $com="FK";
        }elseif($row1=="高要支公司"){
            $com="GY";
        }elseif($row1=="德庆支公司"){
            $com="DQ";
        }elseif($row1=="四会支公司"){
            $com="SH";
        }
        elseif($row1=="电子商务业务部"){
            $com="DZSWYW";
        }elseif($row1=="车商业务部"){
            $com="CSYW";
        }
        if (!Empty($o) || (!Empty($d) && !Empty($e))){
            $row=Jydw::consearch($searchmessage,$com);
            if (!Empty($row)){
                return view('Pz.jydw.search',compact('row'));
            }else{
                echo "<script>alert('没有该项目');history.go(-1);</script>";
            }
            }else{
            echo "<script>alert('查询条件错误');history.go(-1);</script>";
        }
    }
    public function info(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="经营单位"){
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
        }else
        return view('Pz.jydw.info');
    }

    public  function detail($order,Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="经营单位"){
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Jydw::getdetail($order);
        $f=Jydw::getfiles($order);
//        dd($row);
        return view('Pz.jydw.detail',compact('row','f'));
    }
    public function rejected(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="经营单位"){
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Jydw::rejected();
        return view('Pz.jydw.rejected',compact('row'));
    }
    public function rejectedetails($order,Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="经营单位"){
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Jydw::getrejectedetail($order);
//        dd($row);
        $f=Jydw::getfiles($order);
        return view('Pz.jydw.rejecteddetail',compact('row','f'));
    }
    public function alterject(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="经营单位"){
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $altermessage = $request->all();
        $t = $altermessage['Title'];
        $f = $request->file('FileMessage');	//接文件
        $c=$altermessage['Content'];
        $n=$altermessage['Num'];
        $o=$altermessage['Order1'];
//        dd($f);
        if (!is_numeric($n)){
            echo "<script>alert('申报审批金额格式不对');history.go(-1);</script>";
        }else if (is_null($f[0])){
            echo "<script>alert('请选择上传文件');history.go(-1);</script>";
        }else if (Empty($c)){
            echo "<script>alert('请填写申报描述');history.go(-1);</script>";
        }else if (Empty($t)) {
            echo "<script>alert('请填写工单标题');history.go(-1);</script>";
        }    else{
            if (Jydw::alterfiles($o,$f) && Jydw::altermessage($altermessage)){
                echo "<script>alert('修改成功');</script>";

                return $this->rejected($request);
            }
            else{
                echo "<script>alert('修改失败');history.go(-1);</script>";
            }
        }
    }
    public function downloadfile($filename,Request $request){

        $pathToFile='C:/xampp/htdocs/picc/storage/app/uploads/'.$filename;
//        return response()->download($pathToFile);
//        return response()->download($pathToFile,$name);
        return response()->file($pathToFile);



    }
}
