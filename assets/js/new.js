$(function(){
    var time = [];
    time[1]="18:00~19:00";
    time[2]="19:00~20:00";
    time[3]="20:00~21:00";
    var $_GET = (function () {
            var url = window.document.location.href.toString();
            var u = url.split("?");
            if (typeof(u[1]) == "string") {
                u = u[1].split("&");
                var get = {};
                for (var i in u) {
                    var j = u[i].split("=");
                    get[j[0]] = j[1];
                }
                return get;
            } else {
                return {};
            }
        })();
    if ($_GET['date']==null || $_GET['time']==null) {
        Materialize.toast('参数错误!请勿直接访问此页,将在5秒后返回主页!', 5000,'',function(){
            window.location.href="index.php";
        });
    } else {
        $("#show_date").text($_GET['date']);
        $("#show_time").text(time[$_GET['time']]);
        $("#date").attr("value",$_GET['date']);
        $("#time").attr("value",$_GET['time']);
    }
});