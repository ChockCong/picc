<html>
<head>
    <meta charset="utf-8">
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
            margin-top: -50px;
        }
    </style>
</head>
<table border="0" style="text-align:center" width="100%">
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
