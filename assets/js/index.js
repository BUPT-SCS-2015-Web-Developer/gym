

$(function(){
    
    $("#terms").hide();
    $("#instruction").hide();
    $(".timeBox").click(function(){
        var time;
        var date = $(this).parent(".collapsible-body").attr('id');
        if($(this).hasClass("timeBox1")) time = 1;
        else if($(this).hasClass("timeBox2")) time = 2;
        else  time = 3;
        //console.log(time);
        //console.log($(this).parent(".collapsible-body").attr('id'));
        var string = "new.php?time="+time+"&date="+date;
        window.location.href = string;

    });
    $('.known').click(function() {
       $(this).parents(".card").hide(500);
    });
    
    $("#BTNinstruction").click(function(){
        $("#instruction").slideToggle(500);
        return;
    });
    
    $("#BTNterms").click(function(){
        $("#terms").slideToggle(500);
        return;
    });
    $("#BTNfeedback").click(function(){
        var $toastContent = $('<p>对本系统有建议或bug可以在易班应用详情页面评论！<br> 也可以联系我们邮箱liuzirui1122#163.com (#换成@)</p>');
        Materialize.toast($toastContent, 5000);
        return;
    });
    
    $("#closeTerms").click(function(){
        $("#terms").slideToggle(500);
        return;
    });
    $("#closeInstruction").click(function(){
        $("#instruction").slideToggle(500);
        return;
    });
});
