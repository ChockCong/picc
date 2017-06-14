{{--驳回--}}
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
<div class="panel panel-default">
    <div class="panel-heading">驳回工单查询</div>
    <div class="panel-body" style="font-size:110%">
        <form method="post" action="{{url('')}}">
            <input type= "hidden"   name="_token" value="{{ csrf_token() }}">
            <label>工单编号</label><input type="text" name="Order1" value="">
            {{--<label>申请人</label><input disabled type="text" name="Name" value="">--}}
            {{--<label>机构名称</label><input disabled type="text" name="Dep" value="">--}}
            <label>开始日期</label><input type="date" name="Date1" value="">
            <label>终止日期</label><input type="date" name="Date2" value="">
            <input type="submit" name="" value="查询">
        </form>
    </div>
    <div class="panel-heading">驳回表单</div>
    <div class="panel-body" style="font-size:110%;overflow-y:scroll;" >
        <table class="table table-striped table-responsive table-hover">
            <thead>
            <tr>
                <th>工单编号</th>
                <th>标题</th>
                <th>机构</th>
                <th>申报人</th>
                <th>发起日期</th>
                <th>申报金额</th>
                <th>项目状态</th>
                <th>项目进度</th>
                <th>详情</th>
            </tr>
            </thead>
            <tbody>
            @if($row!=null)
                @foreach($row as $val)
                    <?php
                    if ($val->Pass1=='1'){
                        $j='经营单位经理岗';
                    }elseif($val->Pass2=='1'){
                        $j='销售部综合岗';
                    }elseif($val->Pass3=='1'){
                        $j='车险部经理';
                    }elseif($val->Pass4=='1'){
                        $j='财务中心主任';
                    }elseif($val->Pass5=='1'){
                        $j='分管副总经理';
                    }elseif($val->Pass6=='1'){
                        $j='总经理';
                    }elseif(!empty($val->Reject1)){
                        $j='经营单位经理岗';
                    }elseif(!empty($val->Reject2)){
                        $j='销售部综合岗';
                    }elseif(!empty($val->Reject3)){
                        $j='车险部经理';
                    }elseif(!empty($val->Reject4)){
                        $j='财务中心主任';
                    }elseif(!empty($val->Reject5)){
                        $j='分管副总经理';
                    }else{
                        $j=$val->State;
                    }
                    ?>


                    <tr>
                        <td>{{$val->Order1}}</td>
                        <td>{{$val->Title}}</td>
                        <td>{{$val->Com}}</td>
                        <td>{{$val->Name}}</td>
                        <td>{{$val->Date}}</td>
                        <td>{{$val->Num}}</td>
                        <td>{{$val->State}}</td>
                        <td>{{$j}}</td>
                        <td><a href="{{url('xsbrejectedetails/'.$val->Order1)}}" target="Center">查看</a></td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>