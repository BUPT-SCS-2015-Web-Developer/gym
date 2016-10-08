

$(function(){
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
        
    })
}); 