<?php
date_default_timezone_set("Asia/Shanghai");
$i=Session::get('user');
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
        $(function(){
            $("#but").click(function(){
                var _len = $("#tab tr").length-6;
                $("#tabfile").append("<tr id="+_len+">"
                +"<td>附件</td>"
                +"<td colspan='2'><input type='file' name='File["+(_len)+"]'></td>"
//            +'<td><input type="text"  class="text" name="modelAttrs['+(_len-1)+'].remark" maxLength="50" value="" ></td>'
                +"<td><a href=\'#\' onclick=\'deltr("+_len+")\'>删除</a></td>"
                +"</tr>");
            })
        })
    </script>
</head>
<div class="panel panel-default" style="">
    <div class="panel-heading">用户表单</div>
    <div class="panel-body" style="font-size:110%">
        <table class="table table-striped table-responsive table-hover">
            <tbody>
            <tr>
                <td>账号</td>
                <td>{{$i->Account}}</td>
            </tr>
            <tr>
                <td>密码</td>
                <td>{{$i->Password}}</td>
            </tr>
            <tr>
                <td>姓名</td>
                <td>{{$i->Name}}</td>
            </tr>
            <tr>
                <td>公司名称</td>
                <td>{{$i->Com}}</td>
            </tr>
            <tr>
                <td>公司</td>
                <td>{{$i->Com}}</td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>