<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <title>用户中心</title>
    <link href="../bootstrap-3.3.5-dist/css/bootstrap.min.css" title="" rel="stylesheet" />
    <link title="" href="../css/style.css" rel="stylesheet" type="text/css"  />
    <link title="blue" href="../css/dermadefault.css" rel="stylesheet" type="text/css"/>
    <link title="green" href="../css/dermagreen.css" rel="stylesheet" type="text/css" disabled="disabled"/>
    <link title="orange" href="../css/dermaorange.css" rel="stylesheet" type="text/css" disabled="disabled"/>
    <link href="../css/templatecss.css" rel="stylesheet" title="" type="text/css" />
    <script src="../script/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="../script/jquery.cookie.js" type="text/javascript"></script>
    <script src="../bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script>
        function clearNoNum(obj){   obj.value = obj.value.replace(/[^\d.]/g,"");  //清除“数字”和“.”以外的字符 
            obj.value = obj.value.replace(/^\./g,"");  //验证第一个字符是数字而不是.
            obj.value = obj.value.replace(/\.{2,}/g,"."); //只保留第一个. 清除多余的.  
            obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
        }
    </script>
</head>
<div class="panel panel-default" style="">
    <div class="panel-heading">已审申报表单</div>
    <div class="panel-body" style="font-size:110%">
        <form method="post" action="" role="form" enctype="multipart/form-data">
            <input type= "hidden"   name="_token" value="{{ csrf_token() }}">
            <table id="tab" class="table table-striped table-responsive table-hover" border="1" style="text-align:center">
                <thead>
                <tr>
                    <td colspan="4"><h4>批增审批单</h4></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>工单编号</td>
                    <td><input  readonly  name="Order1" value="{{$row->Order1}}"></td>
                    <td>工单标题</td>
                    <td><input  readonly value="{{$row->Title}}"></td>
                </tr>
                <tr>
                    <td>公司名称</td>
                    <td><input name="Dep"  readonly value="{{$row->Com}}"></td>
                    <td>申请人</td>
                    <td><input name="Name"  readonly value="{{$row->Name}}"></td>
                </tr>
                <tr>
                    <td>发起日期</td>
                    <td><input type="text" readonly name="Date" value="{{$row->Date}}"></td>
                    <td>申报审批金额</td>
                    <td><input type="float" readonly name="Num" value="{{$row->Num}}" onkeyup="clearNoNum(this)"></td>
                </tr>
                </tbody>
                <tbody id="tabfile">
                <tr>
                    <td>附件</td>
                    <td colspan="3" style="text-align: left;">
                        @foreach($f as $a)
                        <a style="color: #a14100" href="{{url(('downloadfile/'.$a->FileName.'/'.$a->Name))}}" target="_blank">{{$a->Name}}</a><br />
                        @endforeach
                    </td>
                </tr>
                </tbody>
                <tbody>
                <tr>
                    <td colspan="4">申报描述</td>
                </tr>
                <tr><td colspan="4"><textarea style="resize: none"  readonly rows="6%" cols="100%" name="Content">{{$row->Content}}</textarea></td></tr>
                <tr>
                    <td colspan="4">流程签字意见</td>
                </tr>
                <tr style="text-align: left">
                    <td colspan="4">
                        经营单位经理岗：{{$row->Advice1}}
                    <td/>
                </tr>
                <tr style="text-align: left">
                    <td colspan="4">
                        销售部综合岗：{{$row->Advice2}}
                    </td>
                </tr>
                <tr style="text-align: left">
                    <td colspan="4">
                        车险部经理：{{$row->Advice3}}
                    </td>
                </tr>
                <tr style="text-align: left">
                    <td colspan="4">
                        财务中心主任：{{$row->Advice4}}
                    </td>
                </tr>
                <tr style="text-align: left">
                    <td colspan="4">
                        分管副总经理：{{$row->Advice5}}
                    </td>
                </tr>
                <tr style="text-align: left">
                    <td colspan="4">
                        总经理：{{$row->Advice6}}
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
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

