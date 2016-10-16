<?php

//	$con = mysqli_connect('localhost', 'root', 'jmy5zhentan5') or die ("不能连接数据库:");
//	mysqli_select_db($con,'SportReservation');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>健身房预约 - 北邮易班</title>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="assets/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="assets/css/index.css" type="text/css" rel="stylesheet"/>
</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container hide-on-med-and-down">
        <a href="#" class="brand-logo">
            <img class="logo circle" src="assets/img/logo.png">健身房预约</a>
      <ul class="right">
        <li><a href="#">个人中心</a></li>
      </ul>
    </div>
    <div class="nav-wrapper hide-on-large-only">
        <a href="#" class="brand-logo">
            <img class="logo circle" src="assets/img/logo.png">健身房预约</a>
      <ul class="left">
        <li><a href="#"><img id="user" class="circle" src="assets/img/user.png"></a></li>
      </ul>
    </div>
  </nav>



  <div class="container">
  <div class="row">
      <h5 class="grey-text darken-1">公告发布栏</h5>
  </div>
  <div class="row">
    <form class="col s12">
	    <div class="row">
            <div class="input-field col s12">
                <input id="topic" type="text" class="validate">
                <label for="topic">公告标题</label>
            </div>
		</div>
		<div class="row">
            <div class="input-field col s6">
              <input id="start_time" type="text" class="validate">
              <label for="start_time">公告起始时间</label>
            </div>
            <div class="input-field col s6">
              <input id="end_time" type="text" class="validate">
              <label for="end_time">公告终止时间</label>
            </div>
	    </div>
	    <div class="row">
          <div class="input-field col s12">
            <textarea id="textarea1" class="materialize-textarea"></textarea>
            <label for="textarea1">公告内容</label>
          </div>
        </div>
		<div class="row">
	        <button class="btn waves-effect waves-light" type="submit" name="action">发布
            <i class="mdi-content-send right"></i>
            </button>
		</div>
    </form>
  </div>
  </div>

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
  <script type="text/javascript" src="getexcel.js"></script>
  <script>
    $(function(){

  }); // end of document ready
    </script>
  </body>
</html>
