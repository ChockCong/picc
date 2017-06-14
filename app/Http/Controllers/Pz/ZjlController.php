<?php
namespace App\Http\Controllers\Pz;
use App\Http\Controllers\Controller;
use App\Model\Pz\Jydw;
use  App\Model\Pz\Jydwjls;
use App\Model\Pz\Zjl;
use Illuminate\Http\Request;



class ZjlController extends Controller{


    public function main(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep=="总经理")
            return view('Pz.zjl.Main');
        else
            return redirect()->action('LoginController@login');

    }
    //未审核查询动作返回数据
    public function consearch(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="总经理") {
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
        if (!Empty($o) || (!Empty($d) && !Empty($e))){
            $row=Zjl::consearch($searchmessage);
            if (!Empty($row)){
                return view('Pz.zjl.searchx',compact('row'));
            }else{
                echo "<script>alert('没有该项目');history.go(-1);</script>";
            }
        }else{
            echo "<script>alert('查询条件错误');history.go(-1);</script>";
        }
    }
    //已审核查询动作返回数据
    public function consearched(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="总经理") {
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

        if (!Empty($o) || (!Empty($d) && !Empty($e))){
            $row=Zjl::consearched($searchmessage);
            if (!Empty($row)){
                return view('Pz.zjl.searchy',compact('row'));
            }else{
                echo "<script>alert('没有该项目');history.go(-1);</script>";
            }
        }else{
            echo "<script>alert('查询条件错误');history.go(-1);</script>";
        }
    }
    //未审加载页面时同步显示数据
    public function searchx(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="总经理") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Zjl::searchx();  //查询未审核
        return view('Pz.zjl.searchx',compact('row'));
    }
    //已审加载页面时同步显示数据
    public function searchy(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="总经理") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Zjl::searchy();  //查询已审核
        return view('Pz.zjl.searchy',compact('row'));
    }
    public function detailx($order,Request $request){
        if(!$request->session()->has('user')) {
            echo "<script>" .
                "alert('请重新登录！');".
                "window.parent.location.reload()".
                "</script>";
            exit();
        }
        $row=Jydwjls::detailx($order);
        $f=Jydw::getfiles($order);
        return view('Pz.zjl.detailx',compact('row','f'));
    }
    public function detaily($order,Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="总经理") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Jydwjls::detailx($order);
        $f=Jydw::getfiles($order);
        return view('Pz.zjl.detaily',compact('row','f'));
    }
    public function Pass(Request $request){
        if(!$request->session()->has('user')) {
            echo "<script>" .
                "alert('请重新登录！');".
                "window.parent.location.reload()".
                "</script>";
            exit();
        }
        $all=$request->all();
        $order=$all['Order1'];
        $checkpass=$all['pass'];
        $select=$all['select'];
        $advice=$all['Advice'];
        $i='总经理';
        if($select=='经营单位经理岗'){
            $s='Reject1';
        }elseif($select=='销售部综合岗'){
            $s='Reject2';
        }elseif($select=='车险部经理'){
            $s='Reject3';
        } elseif($select=='财务中心主任'){
            $s='Reject4';
        }elseif($select=='分管副总经理'){
            $s='Reject5';
        }
        if($checkpass=="通过") {
            if (Zjl::pass($order,$advice)) {
                echo "<script>alert('审批成功');</script>";
                return $this->searchx($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }
        }else if($checkpass=="不通过"){
            if(Zjl::nopass($order,$advice)){
                echo "<script>alert('审批成功');</script>";
                return $this->searchx($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }
        }elseif($checkpass=="驳回") {
            if(Zjl::reject($order,$s,$i,$advice)){
                echo "<script>alert('审批成功');</script>";
                return $this->searchx($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }

        }
    }
    //接收驳回
    public function rejected(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="总经理") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Zjl::rejected();
        return view('Pz.zjl.rejected',compact('row'));
    }

    public function rejectedtails($order,Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="总经理") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Jydwjls::detailx($order);
        $f=Jydw::getfiles($order);
        return view('Pz.zjl.rejecteddetail',compact('row','f'));
    }

    public function alterrejected(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="总经理") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
//        $all=$request->all();
//        $advice=$all['Advice'];
//        $com=$all['rejectcom'];
//        dd($all);
    }
}