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
        Materialize.toast('参数错误!请勿直接访问此页,将在3秒后返回主页!', 3000,'',function(){
            window.location.href="index.php";
        });
    } else {
        //$("#show_date").text($_GET['date']);
        //$("#show_time").text(time[$_GET['time']]);
        $("#date").attr("value",$_GET['date']);
        $("#time").attr("value",$_GET['time']);
    }

    String.prototype.trim=function(){return this.replace(/(^\s+)|(\s+$)/g,'')};

    $("#submit").click(function(){
        //前端验证
        var e_name = new RegExp("^[\u4e00-\u9fa5]+(·[\u4e00-\u9fa5]+)*$"),
            e_id = new RegExp("^[0-9]{10}$"),
            e_date = new RegExp("^[0-9]{8}$"),
            e_time = new RegExp("^[123]$");
        if (e_name.test($("#name").val().trim()) && e_id.test($("#id").val().trim()) && e_date.test($("#date").val().trim()) && e_time.test($("#time").val().trim())) {
            var order_data = {};
            //order_data.ybid 易班id部分 需后台session验证
            order_data.name = $("#name").val().trim();
            order_data.id = $("#id").val().trim();
            order_data.date = $("#date").val().trim();
            order_data.time = $("#time").val().trim();

            $.post("newOrder.php",order_data,function(data,status){
                if (status == "success") {
                    if (data == "1") Materialize.toast("修改成功!将在3秒后返回主页", 3000,'',function(){
            window.location.href="index.php";
        });
                    else if (data == "2") Materialize.toast("非法请求!", 5000);
                    else if (data == "3") Materialize.toast("本时间段人数已满!", 5000);
                    else if (data == "5") Materialize.toast("参数错误!请勿作死!", 5000);
                    else Materialize.toast("服务器异常，请稍后再试!", 5000);
                } else Materialize.toast("服务器异常，请稍后再试!", 5000);
            });
            Materialize.toast('提交成功!将在3秒后返回主页', 3000,'',function(){
            window.location.href="index.php";
        });
        } else {
            Materialize.toast('参数错误!请勿作死!', 5000);
            return;
        }
    });
});
