<?php
//易班验证blablabla


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
 </head>
 <body>
  <nav class="light-blue lighten-1" role="navigation">
   <div class="nav-wrapper container hide-on-med-and-down">
    <a href="index.php" class="brand-logo"> <img class="logo circle" src="assets/img/logo.png" />健身房预约</a>
    <ul class="right">
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
  <div class="container">
   <!-- 说明 -->
   <div class="info">
    <h3>确认预订信息</h3>
    <p>您的网薪:x点,这是您本周第一次预订，享受免费预订机会,额外预订需要支付y网薪!</p>
    <!-- <p>您的网薪:x点,本周免费预订次数您已用完！额外预订需要支付y网薪!</p> -->
    <!-- <p>由于您之前两次预订失约，您在两周内不能再进行预约。 哦豁o(*≧▽≦)ツ┏━┓[拍桌狂笑!]</p> -->
    <!-- <p>您已经预约了目前所有可用的时间段！对不起，您一定是疯了- -</p> -->
    <p>请确认您的预订信息,并点击下方按钮来预订!</p>
   </div>
   <hr />
   <!-- 表单开始  -->
      <div id="show">
          <p>姓名 : <span id="show_name">预填充姓名(接口)</span></p>
          <p>学号 : <span id="show_id">预填充学号(接口)</span></p>
          <p>日期 : <span id="show_date"></span></p>
          <p>时间 : <span id="show_time"></span></p>
      </div>
      <form id="form" method="post" action="">
          <input value="刘子锐" id="name" type="hidden" name="name">
          <input id="id" value="2015212149" type="hidden" name="id">
          <input id="date" type="hidden" name="date">
          <input id="time" type="hidden" name="time">
      </form>

      <hr />
   <a class="waves-effect waves-light btn" id="submit">确认预订信息，提交</a>
   <a class="waves-effect waves-light btn" id="back" onclick="window.location.href='index.php'">返回主页</a>
   <!-- 表单结束 -->
  </div>
  <br />
  <br />
  <br />
  <footer class="page-footer grey">
   <div class="container">
    <div class="row">
     <div class="col l6 s12">
      <h5 class="white-text">快乐健身,精彩人生</h5>
      <p class="grey-text text-lighten-4">健身可提高呼吸系统和心血管系统机能。科学实践证实，较长时间有节奏的深长呼吸，能使人体呼吸大量的氧气，吸收氧气量若超过平时的7—8倍，就可以抑制人体癌细胞的生长和繁殖。其次长跑锻炼还改善了心肌供氧状态，加快了心肌代谢，同时还使心肌肌纤维变粗，心收缩力增强，从而提高了心脏工作能力。</p>
     </div>
     <div class="col l4 offset-l2 s12">
      <h5 class="white-text">Links</h5>
      <ul>
       <li><a class="grey-text text-lighten-3" href="#!">使用说明</a></li>
       <li><a class="grey-text text-lighten-3" href="#!">使用条款</a></li>
       <li><a class="grey-text text-lighten-3" href="#!">意见反馈</a></li>
      </ul>
     </div>
    </div>
   </div>
   <div class="footer-copyright">
    <div class="container">
      Copyright&copy; 北邮易班学生发展中心
     <a class="grey-text text-lighten-3" href="http://buptyiban.org/">BUPTYiban</a>
    </div>
   </div>
  </footer>
  <!--  Scripts-->
  <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="assets/js/materialize.js"></script>
  <script src="assets/js/new.js"></script>
 </body>
</html>
