<?php
namespace App\Http\Controllers\Pz;
use App\Model\Pz\Cwzxzr;
use App\Model\Pz\Jydw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class CwzxzrController extends Controller{

    public function main(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep=="财务中心主任")
            return view('Pz.cwzxzr.Main');
        else
            return redirect()->action('LoginController@login');

    }
    //未审加载页面时同步显示数据
    public function searchx(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="财务中心主任") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Cwzxzr::searchx();  //查询未审核
        return view('Pz.cwzxzr.searchx',compact('row'));
    }
    public function detailx($order,Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="财务中心主任") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Cwzxzr::detailx($order);
        $f=Jydw::getfiles($order);
        return view('Pz.cwzxzr.detailx',compact('row','f'));
    }
    //已审加载页面时同步显示数据
    public function searchy(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="财务中心主任") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Cwzxzr::searchy();  //查询已审核
        return view('Pz.cwzxzr.searchy',compact('row'));
    }
    public function detaily($order,Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="财务中心主任") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Cwzxzr::detailx($order);
        $f=Jydw::getfiles($order);
        return view('Pz.cwzxzr.detaily',compact('row','f'));
    }
    //接收驳回
    public function rejected(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="财务中心主任") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Cwzxzr::rejected();
        return view('Pz.cwzxzr.rejected',compact('row'));
    }
    public function rejectedtails($order,Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="财务中心主任") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Cwzxzr::detailx($order);
        $f=Jydw::getfiles($order);
        return view('Pz.cwzxzr.rejecteddetail',compact('row','f'));
    }
    //未审核查询动作返回数据
    public function consearch(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="财务中心主任") {
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
            $row=Cwzxzr::consearch($searchmessage);
            if (!Empty($row)){
                return view('Pz.cwzxzr.searchx',compact('row'));
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
        if($user->Dep!="财务中心主任") {
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
            $row=Cwzxzr::consearched($searchmessage);
            if (!Empty($row)){
                return view('Pz.cwzxzr.searchy',compact('row'));
            }else{
                echo "<script>alert('没有该项目');history.go(-1);</script>";
            }
        }else{
            echo "<script>alert('查询条件错误');history.go(-1);</script>";
        }
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
        $advice=$all['Advice'];
        $checkpass=$all['pass'];
        $select=$all['select'];
        $i='财务中心主任';
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
            if (Cwzxzr::pass($order,$advice)) {
                echo "<script>alert('审批成功');</script>";
                return $this->searchx($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }
        }else if($checkpass=="不通过"){
            if(Cwzxzr::nopass($order,$advice)){
                echo "<script>alert('审批成功');</script>";
                return $this->searchx($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }
        }elseif($checkpass=="驳回") {
            if(Cwzxzr::reject($order,$s,$i,$advice)){
                echo "<script>alert('审批成功');</script>";
                return $this->searchx($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }

        }
    }

    public function alterrejected(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="财务中心主任") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $all=$request->all();
        $advice=$all['Advice'];
        $select=$all['rejectcom'];
        $checkpass=$all['pass'];
        $order=$all['Order1'];
        if($select=='经营单位经理岗'){
            $s='Pass1';
        }elseif($select=='销售部综合岗'){
            $s='Pass2';
        }elseif($select=='车险部经理'){
            $s='Pass3';
        }elseif($select=='销售部综合岗'){
            $s='Pass4';
        }elseif($select=='分管副总经理'){
            $s='Pass5';
        }elseif($select=='总经理'){
            $s='Pass6';
        }
        if($checkpass=="提交") {
            if (Cwzxzr::backreject($s,$advice,$order)) {
                echo "<script>alert('审批成功');</script>";
                return $this->searchx($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }
        }else if($checkpass=="不通过"){
            if(Cwzxzr::nopass($order,$advice)){
                echo "<script>alert('审批成功');</script>";
                return $this->searchx($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }

        }


    }
}