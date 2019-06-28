<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>个性化地图</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <style type="text/css">
        html,body{
            width:100%;
            height:100%;
        }
        *{
            margin:0px;
            padding:0px;
        }
        body {
            font: 12px/16px Verdana, Helvetica, Arial, sans-serif;
        }
        #container{
            min-width:600px;
            min-height:767px;
        }
    </style>
    <script charset="utf-8" src="https://map.qq.com/api/js?v=2.exp&key=6LLBZ-QMLCX-HNA4L-T3ADN-4O3V5-BFFLB"></script>
    <script>
        window.onload = function () {
            function init() {
                // 创建地图
                var map = new qq.maps.Map(document.getElementById("container"), {
                    center: new qq.maps.LatLng(39.916527, 116.397128),      // 地图的中心地理坐标
                    zoom: 8,     // 地图缩放级别
                    mapStyleId: 'style1'  // 该key绑定的style1对应于经典地图样式，若未绑定将弹出无权限提示窗
                });
            }
            //调用初始化函数
            init();
        }
    </script>
</head>
<body>
<!--   定义地图显示容器   -->
<div id="container"></div>
</body>
</html>