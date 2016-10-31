<?php

//	$con = mysqli_connect('localhost', 'root', 'jmy5zhentan5') or die ("不能连接数据库:");
//	mysqli_select_db($con,'SportReservation');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>健身房预约 - 北邮易班</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link href="assets/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="assets/css/index.css" type="text/css" rel="stylesheet" />
  <style media="screen">
  body {
      display: flex;
      min-height: 100vh;
      flex-direction: column;
  }

  main {
      flex: 1 0 auto;
  }
  </style>
</head>
<body>
  <header>
    <nav class="light-blue lighten-1" role="navigation">
      <div class="nav-wrapper container hide-on-med-and-down">
        <a href="index.php" class="brand-logo"> <img class="logo circle" src="assets/img/logo.png" />健身房预约</a>
          <ul class="right">
            <?php
            if ($_SESSION['userType'] === "辅导员"){
              echo "<li><a href='adminbroadcast.php'>发布公告</a></li>";
              echo "<li><a href='adminform.php'>后台管理</a></li>";
            }
            ?>
            <li><a href="my.php">个人中心</a></li>
          </ul>
      </div>
      <div class="nav-wrapper hide-on-large-only">
        <a href="index.php" class="brand-logo"> <img class="logo circle" src="assets/img/logo.png" />健身房预约</a>
        <ul class="left">
          <li><a href="my.php"><img id="user" class="circle" src="assets/img/user.png" /></a></li>
        </ul>
      </div>
    </nav>
  </header>
<main>
  <div class="container">
  <div class="row">
      <h5 class="grey-text darken-1">公告发布栏</h5>
  </div>
  <div class="row">
    <form id="broadcast" class="col s12">
	    <div class="row">
            <div class="input-field col s12">
                <input id="topic" type="text" class="validate">
                <label for="topic">公告标题</label>
            </div>
		</div>
		<div class="row">
            <div class="input-field col s6">
              <input id="startTime" type="text" class="validate">
              <label for="startTime">公告起始时间【格式形如：2016-01-01】</label>
            </div>
            <div class="input-field col s6">
              <input id="endTime" type="text" class="validate">
              <label for="endTime">公告终止时间</label>
            </div>
	    </div>
	    <div class="row">
          <div class="input-field col s12">
            <textarea id="content" class="materialize-textarea"></textarea>
            <label for="content">公告内容</label>
          </div>
        </div>
		<div class="row">
	        <button id="submit" class="btn waves-effect waves-light" type="button" name="action">发布
            <i class="mdi-content-send right"></i>
            </button>
		</div>
    </form>
  </div>
  </div>
</main>
  <footer class="page-footer orange">
    <div class="footer-copyright">
      <div class="container">
      Copyright© 北邮易班学生发展中心 <a class="orange-text text-lighten-3" href="http://buptyiban.org/">BUPTYiban</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="assets/js/materialize.js"></script>
  <script>
    $(function(){
      $('#submit').click(function(){
            var order_data = {};
            var url = "changeBroadCast.php";
            order_data.topic = $("#topic").val();
            order_data.startTime = $("#startTime").val();
            order_data.endTime = $("#endTime").val();
            order_data.content = $("#content").val();

            $.post(url,order_data,function(data,status){
                if (status == "success") {
                    if (data == "1") Materialize.toast("发布公告成功!将在3秒后返回主页", 3000,'',function(){
            window.location.href="index.php";
            });
                    else if (data == "2") Materialize.toast("非法请求!", 5000);
                    else if (data == "3") Materialize.toast("未知错误", 5000);
                    else if (data == "5") Materialize.toast("参数错误!请勿作死!", 5000);
                    else Materialize.toast("服务器异常，请稍后再试!", 5000);
                } else Materialize.toast("服务器异常，请稍后再试!", 5000);
            });
            Materialize.toast('发布公告成功!将在3秒后返回主页', 3000,'',function(){
            window.location.href="index.php";
        });

      })
  }); // end of document ready
    </script>
  </body>
</html>
