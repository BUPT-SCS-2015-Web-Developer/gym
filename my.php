<?php
    session_start();
    include "assets/API/header_api_session.php";
    include "assets/API/iapp.php";
    include "assets/API/config.php";
    include "assets/API/db_config.php";

    $yibanID = $_SESSION['yibanID'];

    date_default_timezone_set('Asia/Shanghai');
    $nowTimeShow = date("Y年m月d日 H:i");
    $nowHour = date("H");
    $nowTime = date("H:i");
    $nowDate = date("m月d日");

    if ($nowHour < "19")
      $flagHour = 0;
    elseif ($nowHour >= "19" && $nowHour < "20")
      $flagHour = 1;
    elseif ($nowHour >= "20" && $nowHour < "21") {
      $flagHour = 2;
    }
    else {
      $flagHour = 3;
    }

    $db = new mysqli($db_host,$db_user,$db_password,$db_database);
    if (!$db)
    {
      exit('Could not connect: ' . mysql_error());
    }
    $db->query("set names 'utf8'");
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
   <!-- 说明 -->
   <div class="info">
    <h3>个人中心</h3>
    <p>现在时间是<b><?php echo $nowTimeShow; ?></b>,当日预约截止时间为17:00</p>
   </div>
   <hr />
   <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s3"><a class="active" href="#test1">已预约的健身计划</a></li>
        <li class="tab col s3"><a href="#test2">已完成的健身计划</a></li>
        <li class="tab col s3"><a href="#test3">按时提醒</a></li>
      </ul>
    </div>
    <div id="test1" class="col s12">
        <!-- 已预约的健身计划 以下为范例-->
        <ul class="collection">
          <?php
            $sql_query = "SELECT * FROM `gym_reserve` WHERE yibanID ='". $yibanID."'";
            $result = $db->query($sql_query);
            $i=0;
            if ($result->num_rows == 0)
            {
              ;
            }
            else {
              foreach ($result as $value) {
                if ($value['time'] == 1)
                {
                  $time = "18:00-19:00";
                }
                elseif ($value['time'] == 2) {
                  $time = "19:00-20:00";
                }
                elseif ($value['time'] == 3)
                {
                  $time = "20:00-21:00";
                }

                echo "<li id='".$value['id']."' class='collection-item'>
                    ".$value['date']." ".$time;
                if ($value['date'] > $nowDate)
                  echo "<a class='right waves-effect waves-light btn btn-cancel'>取消预约</a>";
                elseif ($value['time'] > $flagHour && $value['date'] == $nowDate) {
                  echo "<a class='right waves-effect waves-light btn btn-cancel'>取消预约</a>";
                }
                else {
                  echo "<div class='right'>等待确认</span>";
                }
                echo "</li>";
                ;
                $i++;
              }
            }

           ?>
          </ul>

    </div>
    <div id="test2" class="col s12">
        <!-- 已完成的健身计划 以下为范例-->
        <ul class="collection">
          <?php
            $sql_query = "SELECT * FROM `gym_data` WHERE yibanID ='". $yibanID."'";
            $result = $db->query($sql_query);
            if ($result->num_rows == 0)
            {
              ;
            }
            else {
              foreach ($result as $value) {
                if ($value['time'] == 1)
                {
                  $time = "18:00-19:00";
                }
                elseif ($value['time'] == 2) {
                  $time = "19:00-20:00";
                }
                elseif ($value['time'] == 3)
                {
                  $time = "20:00-21:00";
                }
                echo "<li id='".$value['id']."' class='collection-item'>
                    ".$value['date']." ".$time."</li>
                ";
              }
            }
           ?>
        <!--    <li id="1" /*此处id即为用户预约表中的id */class="collection-item">
                10月11日 19:00~20:00
            </li>
            <li id="2" class="collection-item">
                10月12日 20:00~21:00
            </li> -->
          </ul>
    </div>
    <div id="test3" class="col s12">
        <!-- 按时提醒 -->

        <label>开启按时提醒后，易班客户端将会在预约前提前通知您。</label>
        <label>提醒功能还在测试中！敬请期待！</label>
    <select class="browser-default" id="alarm">
      <option value="-1" selected>不提醒</option>
      <option value="5">提前5分钟</option>
      <option value="10">提前10分钟</option>
      <option value="15">提前15分钟</option>
      <option value="30">提前30分钟</option>
    </select>

    </div>
  </div>
  <hr>
  </div>
  <br />
  <br />
  <br />
</main>
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
  <script src="assets/js/my.js"></script>
 </body>
</html>
