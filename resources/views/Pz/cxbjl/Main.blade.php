<?php
date_default_timezone_set("Asia/Shanghai");
$i=Session::get('user');
$time1=date("Y年m月d日");
$week=get_week($time1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <title>PICC</title>
    <link href="bootstrap-3.3.5-dist/css/bootstrap.min.css" title="" rel="stylesheet" />
    <link title="" href="css/style.css" rel="stylesheet" type="text/css"  />
    <link title="black" href="css/dermablack.css" rel="stylesheet" type="text/css"/>
    <link href="css/templatecss.css" rel="stylesheet" title="" type="text/css" />
    <script src="script/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="script/jquery.cookie.js" type="text/javascript"></script>
    <script src="bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <style type="text/css">
        @-webkit-keyframes run{
            0%  {
                -webkit-transform:rotateY(0deg);
            }
            100% {
                -webkit-transform:rotateY(360deg);
            }
        }
        @-moz-keyframes run{
            0%  {
                -moz-transform:rotateY(0deg);
            }
            100% {
                -moz-transform:rotateY(360deg);
            }
        }
        @keyframes run{
            0%  {
                transform:rotateY(0deg);
            }
            100% {
                transform:rotateY(360deg);
            }
        }

        img{
            width:420px;height:200px;
            margin:13% 0 30px 0;
            background-size:cover;
            -webkit-transform:translate3d(0,0,0);
            -moz-transform:translate3d(0,0,0);
            transform:translate3d(0,0,0);
            -webkit-animation:run 8s linear infinite;
            -moz-animation:run 8s linear infinite;
            animation:run 8s linear infinite;
            transition-delay: 10s;
            -moz-transition-delay: 10s;
            -webkit-transition-delay: 10s;
            -o-transition-delay: 10s;
        }
        .china{
            font-family:"隶书";
            font-size: 48px;
            font-weight:700;letter-spacing: 0px;
        }
        .English{
            font-family: "Roboto", Helvetica, Arial, sans-serif;
            font-size: 22px;
            font-weight:700;letter-spacing: 1px;
            margin-top: 0px;
        }
    </style>
</head>
<body bgcolor="orange" style="">
<nav class="nav navbar-default navbar-mystyle navbar-fixed-top">
    <div class="navbar-header">
        <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="{{url('cxbjlmain')}}"><div class="navbar-brand mystyle-brand"><span class="glyphicon glyphicon-home"></span></div></a></div>
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="li-border"><a class="mystyle-color" href="{{url('cxbjlsp')}}">流程审批</a></li>
            <li class="li-border"><a class="mystyle-color" href="#">业务查询</a></li>
            <li class="li-border"><a class="mystyle-color" href="#">销售佣金查询</a></li>
            <li class="li-border"><a class="mystyle-color" href="#">奖励佣金查询</a></li>
            <li class="li-border"><a class="mystyle-color" href="#">销售人员信息管理</a></li>
            <!----下拉框选项---->
        </ul>

        <ul class="nav navbar-nav pull-right">

            <li class="li-border">
                <a class="mystyle-color">
                    {{$time1}}
                </a>
            </li>
            <li class="li-border">
                <a class="mystyle-color">
                    {{$i->Com}}
                </a>
            <li class="li-border">
                <a href="{{url('jinfo')}}" target="Center" class="mystyle-color">
                    {{$i->Name}}
                </a>
            </li>
            </li>
            </li>
            <li class="li-border">
                <a href="{{url('loginout')}}" class="mystyle-color">
                    退出
                </a>
            </li>

        </ul>
    </div>
</nav>


    <div class="right-product my-index right-full">
        <div class="container-fluid">
            <div class="info-center">
                <!---title----->
                <div class="info-title">
                </div>
                <div class="clearfix"></div>
            </div>
            <!----content-list---->
            <div class="container-fluid">
                <div class="info-center">
                    <div class="clearfix">
                    </div>
                    <div class="table-margin" style="height: 500px">

                        <!--<table class="table table-bordered table-header">-->
                        {{--<iframe name="Center" src="{{url('logo')}}" style="border: 0;overflow-y: hidden" width="100%" height="600px">--}}

                        {{--</iframe>--}}
                        <table border="0" style="text-align:center;margin:50px 0 0 -80px" width="100%">
                            <tr>
                                <td><a href="images/picc.png" target="_blank"><img clsaa="showlogo" src="images/picc.png"></a></td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="width:100%;height:20%;">
                                        <p class="china">中国人民财产保险股份有限公司</p>
                                        <p class="English">PICC PROPERTY AND CASUALTY COMPANY LIMITED</p>
                                    </div>
                                </td>

                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $(function(){
        /*换肤*/
        $(".dropdown .changecolor li").click(function(){
            var style = $(this).attr("id");
            $("link[title!='']").attr("disabled","disabled");
            $("link[title='"+style+"']").removeAttr("disabled");

            $.cookie('mystyle', style, { expires: 7 }); // 存储一个带7天期限的 cookie
        })
        var cookie_style = $.cookie("mystyle");
        if(cookie_style!=null){
            $("link[title!='']").attr("disabled","disabled");
            $("link[title='"+cookie_style+"']").removeAttr("disabled");
        }
        /*左侧导航栏显示隐藏功能*/
        $(".subNav").click(function(){
            /*显示*/
            if($(this).find("span:first-child").attr('class')=="title-icon glyphicon glyphicon-chevron-down")
            {
                $(this).find("span:first-child").removeClass("glyphicon-chevron-down");
                $(this).find("span:first-child").addClass("glyphicon-chevron-up");
                $(this).removeClass("sublist-down");
                $(this).addClass("sublist-up");
            }
            /*隐藏*/
            else
            {
                $(this).find("span:first-child").removeClass("glyphicon-chevron-up");
                $(this).find("span:first-child").addClass("glyphicon-chevron-down");
                $(this).removeClass("sublist-up");
                $(this).addClass("sublist-down");
            }
            // 修改数字控制速度， slideUp(500)控制卷起速度
            $(this).next(".navContent").slideToggle(300).siblings(".navContent").slideUp(300);
        })
        /*左侧导航栏缩进功能*/
        $(".left-main .sidebar-fold").click(function(){

            if($(this).parent().attr('class')=="left-main left-full")
            {
                $(this).parent().removeClass("left-full");
                $(this).parent().addClass("left-off");

                $(this).parent().parent().find(".right-product").removeClass("right-full");
                $(this).parent().parent().find(".right-product").addClass("right-off");

            }
            else
            {
                $(this).parent().removeClass("left-off");
                $(this).parent().addClass("left-full");

                $(this).parent().parent().find(".right-product").removeClass("right-off");
                $(this).parent().parent().find(".right-product").addClass("right-full");

            }
        })

        /*左侧鼠标移入提示功能*/
        $(".sBox ul li").mouseenter(function(){
            if($(this).find("span:last-child").css("display")=="none")
            {$(this).find("div").show();}
        }).mouseleave(function(){$(this).find("div").hide();});

        $(".navContent li").click(function(){
            $(".navContent li").removeClass("active");//首先移除全部的active
            $(this).addClass("active");//选中的添加acrive
        });
    })
</script>
</body>
</html>
<?php
header("Content-type: text/html; charset=utf-8");
//获取星期方法
function   get_week($date){
    //强制转换日期格式
    $date_str=date('Y-m-d',strtotime($date));

    //封装成数组
    $arr=explode("-", $date_str);

    //参数赋值
    //年
    $year=$arr[0];

    //月，输出2位整型，不够2位右对齐
    $month=sprintf('%02d',$arr[1]);

    //日，输出2位整型，不够2位右对齐
    $day=sprintf('%02d',$arr[2]);

    //时分秒默认赋值为0；
    $hour = $minute = $second = 0;

    //转换成时间戳
    $strap = mktime($hour,$minute,$second,$month,$day,$year);

    //获取数字型星期几
    $number_wk=date("w",$strap);

    //自定义星期数组
    $weekArr=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");

    //获取数字对应的星期
    return $weekArr[$number_wk];
}
?>
