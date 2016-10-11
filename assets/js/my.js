$(function() {
    
    $("btn_cancel").click(function(){
        var cancelData = {};
        cancelData.id = $(this).parents("li").attr("id");
        console.log(cancelData);
        $.post("cancelOrder.php",cancelData,function(data,status){
            if (status == "success") {
                if (data == "1") Materialize.toast("取消预约成功!", 5000);
                else if (data == "2") Materialize.toast("非法请求!", 5000);
                else if (data == "4") Materialize.toast("不存在的预约!", 5000);
                else Materialize.toast("服务器异常，请稍后再试!", 5000);
            } else Materialize.toast("服务器异常，请稍后再试!", 5000);
        });
    });
    $("#alarm").change(function(){
        var alarmData = {};
        alarmData.time = parseInt($("#alarm").val());
        $.post("alarm.php",alarmData,function(data,status){
            if (status == "success") {
                if (data == "1") Materialize.toast("修改成功!", 5000);
                else if (data == "2") Materialize.toast("非法请求!", 5000);
                else Materialize.toast("服务器异常，请稍后再试!", 5000);
            } else Materialize.toast("服务器异常，请稍后再试!", 5000);
        });
    })
});