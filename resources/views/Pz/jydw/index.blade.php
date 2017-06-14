<?php
date_default_timezone_set("Asia/Shanghai");
$i=Session::get('user');
$time=date("Y-m-d");
$Order="";
function getnum($row1,$num){
    if($row1=="端州支公司"){
        $num.="DZ";
        $num.="PZ";
        $num.=date("YmdHis");
    }elseif($row1=="怀集支公司"){
        $num.="HJ";
        $num.="PZ";
        $num.=date("YmdHis");
    }elseif($row1=="广宁支公司"){
        $num.="GD";
        $num.="PZ";
        $num.=date("YmdHis");
    }elseif($row1=="封开支公司"){
        $num.="FK";
        $num.="PZ";
        $num.=date("YmdHis");
    }elseif($row1=="高要支公司"){
        $num.="GY";
        $num.="PZ";
        $num.=date("YmdHis");
    }elseif($row1=="德庆支公司"){
        $num.="DQ";
        $num.="PZ";
        $num.=date("YmdHis");
    }elseif($row1=="四会支公司"){
        $num.="SH";
        $num.="PZ";
        $num.=date("YmdHis");
    }
    elseif($row1=="电子商务业务部"){
        $num.="DZSWYW";
        $num.="PZ";
        $num.=date("YmdHis");
    }elseif($row1=="车商业务部"){
        $num.="CSYW";
        $num.="PZ";
        $num.=date("YmdHis");
    }
    return $num;
}
$Order=getnum($i->Com,$Order);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <title>用户中心</title>
    <link href="bootstrap-3.3.5-dist/css/bootstrap.min.css" title="" rel="stylesheet" />
    <link title="" href="css/style.css" rel="stylesheet" type="text/css"  />
    <link title="blue" href="css/dermadefault.css" rel="stylesheet" type="text/css"/>
    <link title="green" href="css/dermagreen.css" rel="stylesheet" type="text/css" disabled="disabled"/>
    <link title="orange" href="css/dermaorange.css" rel="stylesheet" type="text/css" disabled="disabled"/>
    <link href="css/templatecss.css" rel="stylesheet" title="" type="text/css" />
    <script src="script/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="script/jquery.cookie.js" type="text/javascript"></script>
    <script src="bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script>
        function deltr(index){
            //var _len = $("#tab tr").length;
            $("tr[id='"+index+"']").remove();//删除当前行
        }
        function clearNoNum(obj){   obj.value = obj.value.replace(/[^\d.]/g,"");  //清除“数字”和“.”以外的字符 
            obj.value = obj.value.replace(/^\./g,"");  //验证第一个字符是数字而不是.
            obj.value = obj.value.replace(/\.{2,}/g,"."); //只保留第一个. 清除多余的.  
            obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
        }

//        $(function(){
//            $("#but").click(function(){
//                var _len = $("#tab tr").length-6;
//                $("#tabfile").append("<tr id="+_len+">"
//                +"<td>附件</td>"
//                +"<td colspan='2'><input type='file' name='File["+(_len)+"]'></td>"
////            +'<td><input type="text"  class="text" name="modelAttrs['+(_len-1)+'].remark" maxLength="50" value="" ></td>'
//                +"<td class='del'><button onclick=\'deltr("+_len+")\'>-</button></td>"
//                +"</tr>");
//            });
//        })
    </script>
</head>
<div class="panel panel-default" style="">
    <div class="panel-heading">申报表单</div>
    <div class="panel-body" style="font-size:110%">
<form method="post" action="{{ url('refer') }}" role="form" enctype="multipart/form-data">
    <input type= "hidden"   name="_token" value="{{ csrf_token() }}">
    <table id="tab" class="table table-bordered table-header" style="text-align:center">
        <thead>
        <tr>
            <td colspan="4" style=""><h4>批增审批单</h4></th>
        </tr>
        </thead>
        <tbody  id="tabfile">
        <tr>
            <td>工单编号</td>
            <td colspan=""><input name="Order"  readonly value="{{$Order}}"></td>
            <td>工单标题（必填）</td>
            <td colspan=""><input name="Title" value=""></td>
        </tr>
        <tr>
            <td>公司名称</td>
            <td><input name="Com"  readonly value="{{$i->Com}}"></td>
            <td>申请人</td>
            <td><input name="Name"  readonly value="{{$i->Name}}"></td>
        </tr>
        <tr>
            <td>发起日期</td>
            <td><input type="text" readonly name="Date" value="{{$time}}"></td>
            <td>申报审批金额（必填）</td>
            <td><input type="float" name="Num" value=""   onkeyup="clearNoNum(this)"></td>
        </tr>
        <tr>
            <td>附件</td>
            <td colspan="3" style="text-align: left">
                <input id="File" type="file" name="FileMessage[]" multiple>
                <div id="showfile"></div>
            </td>
        </tr>
        </tbody>
        <tbody>
        <tr>
            <td colspan="4">申报描述（必填）</td>
        </tr>
        <tr><td colspan="4"><textarea style="resize: none"  rows="6%" cols="100%" name="Content"></textarea></td></tr>
        </tbody>
    </table>
    <input type="submit" name="" value="提交">
    <input type="reset" value="重置">
</form>
    </div>
</div>
</html>

<script>
    var test = document.getElementById('File');
    test.addEventListener('change', function() {
        //获取File
        var t_files = this.files;
        var str = '';
        //输出文本
        for (var i = 0, len = t_files.length; i < len; i++) {
            str +=  t_files[i].name+"<br />";
        };
        if(t_files.length==1) str="";
        document.getElementById('showfile').innerHTML = str;
    }, false);
</script>
