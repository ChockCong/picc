<?php
namespace App\Http\Controllers\Pz;
use App\Http\Controllers\Controller;
use App\Model\Pz\Fgfzjl;
use App\Model\Pz\Jydw;
use Illuminate\Http\Request;



class FgfzjlController extends Controller{


    public function main(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep=="分管副总经理")
            return view('Pz.fgfzjl.Main');
        else
            return redirect()->action('LoginController@login');

    }
    //未审加载页面时同步显示数据
    public function searchx(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="分管副总经理") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Fgfzjl::searchx();  //查询未审核
        return view('Pz.fgfzjl.searchx',compact('row'));
    }
    public function detailx($order,Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="分管副总经理") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Fgfzjl::detailx($order);
        $f=Jydw::getfiles($order);
        return view('Pz.fgfzjl.detailx',compact('row','f'));
    }
    //已审加载页面时同步显示数据
    public function searchy(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="分管副总经理") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Fgfzjl::searchy();  //查询已审核
        return view('Pz.fgfzjl.searchy',compact('row'));
    }
    public function detaily($order,Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="分管副总经理") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Fgfzjl::detailx($order);
        $f=Jydw::getfiles($order);
        return view('Pz.fgfzjl.detaily',compact('row','f'));
    }
    //接收驳回
    public function rejected(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="分管副总经理") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Fgfzjl::rejected();
        return view('Pz.fgfzjl.rejected',compact('row'));
    }
    public function rejectedtails($order,Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="分管副总经理") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Fgfzjl::detailx($order);
        $f=Jydw::getfiles($order);
        return view('Pz.fgfzjl.rejecteddetail',compact('row','f'));
    }
    //未审核查询动作返回数据
    public function consearch(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="分管副总经理") {
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
            $row=Fgfzjl::consearch($searchmessage);
            if (!Empty($row)){
                return view('Pz.fgfzjl.searchx',compact('row'));
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
        if($user->Dep!="分管副总经理") {
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
            $row=Fgfzjl::consearched($searchmessage);
            if (!Empty($row)){
                return view('Pz.fgfzjl.searchy',compact('row'));
            }else{
                echo "<script>alert('没有该项目');history.go(-1);</script>";
            }
        }else{
            echo "<script>alert('查询条件错误');history.go(-1);</script>";
        }
    }
    public function Pass(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="分管副总经理") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $all=$request->all();
        $order=$all['Order1'];
        $advice=$all['Advice'];
        $checkpass=$all['pass'];
        $select=$all['select'];
        $i='分管副总经理';
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
            if (Fgfzjl::pass($order,$advice)) {
                echo "<script>alert('审批成功');</script>";
                return $this->searchx($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }
        }else if($checkpass=="不通过"){
            if(Fgfzjl::nopass($order,$advice)){
                echo "<script>alert('审批成功');</script>";
                return $this->searchx($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }
        }elseif($checkpass=="驳回") {
            if(Fgfzjl::reject($order,$s,$i,$advice)){
                echo "<script>alert('审批成功');</script>";
                return $this->searchx($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }

        }
    }

    public function alterrejected(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="分管副总经理") {
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
            if (Fgfzjl::backreject($s,$advice,$order)) {
                echo "<script>alert('审批成功');</script>";
                return $this->searchx($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }
        }else if($checkpass=="不通过"){
            if(Fgfzjl::nopass($order,$advice)){
                echo "<script>alert('审批成功');</script>";
                return $this->searchx($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }

        }

    }
}