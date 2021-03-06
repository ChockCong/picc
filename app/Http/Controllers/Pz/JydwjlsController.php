<?php
namespace App\Http\Controllers\Pz;
use App\Model\Pz\Jydw;
use  App\Model\Pz\Jydwjls;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class JydwjlsController extends Controller{


    public function main(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep=="经营单位经理室")
            return view('Pz.jydwjls.Main');
        else
            return redirect()->action('LoginController@login');

    }
    public function sp(){
        return view('Pz.jydwjls.sp');
    }
    //未审核查询动作返回数据
    public function consearch(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="经营单位经理室") {
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
            $row=Jydwjls::consearch($searchmessage,$com);
            if (!Empty($row)){
                return view('Pz.jydwjls.searchx',compact('row'));
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
        if($user->Dep!="经营单位经理室") {
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
            $row=Jydwjls::consearched($searchmessage,$com);
            if (!Empty($row)){
                return view('Pz.jydwjls.searchy',compact('row'));
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
        if($user->Dep!="经营单位经理室") {
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
        $row=Jydwjls::searchx($com);  //查询未审核
        return view('Pz.jydwjls.searchx',compact('row'));
    }
    //已审加载页面时同步显示数据
    public function searchy(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="经营单位经理室") {
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
        $row=Jydwjls::searchy($com);  //查询已审核
        return view('Pz.jydwjls.searchy',compact('row'));
    }
    public function detailx($order,Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="经营单位经理室") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Jydwjls::detailx($order);
        $f=Jydw::getfiles($order);
        return view('Pz.jydwjls.detailx',compact('row','f'));
    }
    public function detaily($order,Request $request){
        if(!$request->session()->has('user')) {
            echo "<script>" .
                "alert('请重新登录！');".
                "window.parent.location.reload()".
                "</script>";
            exit();
        }
        $row=Jydwjls::detailx($order);
        $f=Jydw::getfiles($order);
        return view('Pz.jydwjls.detaily',compact('row','f'));
    }
    public function Pass(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="经营单位经理室") {
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
        if($checkpass=="通过") {
            if (Jydwjls::pass($order,$advice)) {
                echo "<script>alert('审批成功');</script>";
                return $this->searchx($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }
        }else if($checkpass=="不通过"){
            if(Jydwjls::nopass($order,$advice)){
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
        if($user->Dep!="经营单位经理室") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Jydwjls::rejected();
        return view('Pz.jydwjls.rejected',compact('row'));
    }

    public function rejectedtails($order,Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="经营单位经理室") {
            echo "<script>" .
                "alert('请重新登录！');".
                "top.location.reload();".
                "</script>";
            exit();
        }
        $row=Jydwjls::detailx($order);
        $f=Jydw::getfiles($order);
        return view('Pz.jydwjls.rejecteddetail',compact('row','f'));
    }

    public function alterrejected(Request $request){
        $user=$request->session()->get('user');
        if($user->Dep!="经营单位经理室") {
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
        }
        if($checkpass=="提交") {
            if (Jydwjls::backreject($s,$advice,$order)) {
                echo "<script>alert('审批成功');</script>";
                return $this->rejected($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }
        }else if($checkpass=="不通过"){
            if(Jydwjls::nopass($order,$advice)){
                echo "<script>alert('审批成功');</script>";
                return $this->rejected($request);  //查询未审核
            } else {
                echo "<script>alert('审批失败');history.go(-1);</script>";
            }

        }


    }
}