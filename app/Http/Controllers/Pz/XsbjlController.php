<?php
namespace App\Http\Controllers\Pz;
use App\Http\Controllers\Controller;
use App\Model\Pz\Jydw;
use App\Model\Pz\Xsbjl;
use Illuminate\Http\Request;



class XsbjlController extends Controller{


    public function main(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep=="销售部经理")
            return view('Pz.xsbjl.Main');
        else
            return redirect()->action('LoginController@login');
    }
    public function sp(){
        return view('Pz.xsbjl.sp');
    }
    //未审核查询动作返回数据
    public function consearch(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="销售部经理") {
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
            $row=Xsbjl::consearch($searchmessage);
            if (!Empty($row)){
                return view('Pz.xsbjl.searchx',compact('row'));
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
        if($user->Dep!="销售部经理") {
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
            $row=Xsbjl::consearched($searchmessage);
            if (!Empty($row)){
                return view('Pz.xsbjl.searchy',compact('row'));
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
        if($user->Dep!="销售部经理") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Xsbjl::searchx(null);  //查询未审核
        return view('Pz.xsbjl.searchx',compact('row'));
    }
    //已审加载页面时同步显示数据
    public function searchy(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="销售部经理") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Xsbjl::searchy(null);  //查询已审核
        return view('Pz.xsbjl.searchy',compact('row'));
    }
    public function detailx($order,Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="销售部经理") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Xsbjl::detailx($order);
        $f=Jydw::getfiles($order);
        return view('Pz.xsbjl.detailx',compact('row','f'));
    }
    public function detaily($order,Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="销售部经理") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Xsbjl::detailx($order);
        $f=Jydw::getfiles($order);
        return view('Pz.xsbjl.detaily',compact('row','f'));
    }
    public function Pass(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="销售部经理") {
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
        $i='销售部经理';
        if($checkpass=="通过") {
            if (Xsbjl::pass($order,$advice)) {
                echo "<script>alert('审批成功');</script>";
                return $this->searchx($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }
        }else if($checkpass=="不通过"){
            if(Xsbjl::nopass($order,$advice)){
                echo "<script>alert('审批成功');</script>";
                return $this->searchx($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }

        }else if($checkpass=="返回") {
            $select=$all['select'];
            if($select==null){
                echo "<script>alert('请选择返回部门');history.go(-1);</script>";
                exit();
            }
            elseif($select=='经营单位经理岗'){
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
            if (Xsbjl::reject($order, $s, $i, $advice)) {
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
        if($user->Dep!="销售部经理") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Xsbjl::rejected();
        return view('Pz.xsbjl.rejected',compact('row'));
    }

    public function rejectedtails($order,Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="销售部经理") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Xsbjl::detailx($order);
        $f=Jydw::getfiles($order);
        return view('Pz.xsbjl.rejecteddetail',compact('row','f'));
    }

    public function alterrejected(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="销售部经理") {
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
        }elseif($select=='财务中心主任'){
            $s='Pass4';
        }elseif($select=='分管副总经理'){
            $s='Pass5';
        }elseif($select=='总经理'){
            $s='Pass6';
        }elseif($select=='销售部经理'){
            $s='Pass7';
        }
        if($checkpass=="提交") {
            if (Xsbjl::backreject($s,$advice,$order)) {
                echo "<script>alert('审批成功');</script>";
                return $this->rejected($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }
        }else if($checkpass=="不通过"){
            if(Xsbjl::nopass($order,$advice)){
                echo "<script>alert('审批成功');</script>";
                return $this->rejected($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }

        }


    }
}