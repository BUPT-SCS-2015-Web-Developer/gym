<?php
    session_start();
    //    include "assets/API/header_api_session.php";
    //    include "assets/API/iapp.php";
    include "assets/API/config.php";
    include "assets/API/db_config.php";

    $date = array();
    $id = array();

    date_default_timezone_set('Asia/Shanghai');
    $nowTimeShow = date("Y年m月d日 H:i");
    $nowTime = date("H:i");
    $nowDate = date("Y-m月d日");

    //$nowWeekday = date("N"); //1~7
    $flag = 0;
    if ($nowTime >= "17:00")
    {
        $flag = 1;
    }
    else
    {
        ;
    }
    for ($i=0;$i<$showingDay;$i++)
    {
        $date[$i] = date("m月d日",strtotime("+".($i+$flag)." day"));
        $id[$i] = date("Ymd",strtotime("+".($i+$flag)." day"));
    }

    $db = new mysqli($db_host,$db_user,$db_password,$db_database);
    if (!$db)
    {
      exit('Could not connect: ' . mysql_error());
    }
    $db->query("set names 'utf8'");

/*    $yibanID = $_SESSION['yibanID'];
    $sql_query = "SELECT * FROM `askforleave` WHERE `yibanID` = $yibanID";
    $result = $db->query($sql_query);
    if ($result->num_rows == 0)
    {
      echo "<script language=javascript>alert('您还未请假！');window.location.href='leave.php';</script>";
      exit(0);
    }
    else {
      ;
    }
*/
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
   <!-- 公告开始 -->
   <!-- 公告模板 php处理
      <div id="notice1">
          <div class="card grey lighten-5">
            <div class="card-content grey-text text-darken-4">
              <span class="card-title">公告标题</span>
              <p>公告内容</p>
            </div>
            <div class="card-action">
              <a class="known" href="#">我知道了</a>
            </div>
          </div>
      </div>
      -->
   <!-- 如果没有公告 显示这个 -->
   <div id="notice0">
    <div class="card grey lighten-5 ">
     <div class="card-content grey-text text-darken-4">
      <span class="card-title">Harvest by labor, fitness by exercise.</span>
     </div>
    </div>
   </div>
   <!-- 公告结束 -->
   <!-- 说明 -->
   <div class="info">
    <h3>预订日程</h3>
    <p>现在时间是<b><?php echo $nowTimeShow; ?></b>,当日预约截止时间为17:00</p>
    <p>您可以预订<b><?php echo $showingDay; ?></b>天内的健身,点击下方可用时间段进行预订!</p>
    <!-- <p>由于您之前两次预订失约，您在两周内不能再进行预约。 哦豁o(*≧▽≦)ツ┏━┓[拍桌狂笑!]</p> -->
    <!-- <p>您已经预约了目前所有可用的时间段！对不起，您一定是疯了- -</p> -->
   </div>
   <hr />
   <!-- 预订状况开始  -->
   <!-- 以下为范例,括弧中为提示,正式上线时务必删除 -->
   <div id="bookList">
    <ul class="collapsible popout" data-collapsible="expandable">
        <?php
            for ($i=0;$i<$showingDay;$i++)
            {
                $nowPeople = array();
                $class = array();
                $totalPeople = $peopleLimit*3;

                $sql_query = "SELECT * FROM `gym_reserve` WHERE `date` ='". $date[$i]."'";
                $result = $db->query($sql_query);
                $nowTotalPeople = $result->num_rows;

                if($nowTotalPeople < $totalPeople * 0.65)
                {
                    $totalClass = " teal lighten-2 active ";
                }
                elseif ($nowTotalPeople < $totalPeople) {
                    $totalClass = " yellow darken-2 active ";
                }
                else {
                    $totalClass = " red lighten-3 ";
                }

                for($j=1;$j<=3;$j++)
                {
                    $sql_query = "SELECT * FROM `gym_reserve` WHERE date ='". $date[$i]."' AND time = '".$j."'";
                    $result = $db->query($sql_query);
                    $nowPeople[$j] = $result->num_rows;
                    if($nowPeople[$j] < $peopleLimit * 0.65)
                    {
                        $class[$j] = " teal lighten-2 active ";
                    }
                    elseif ($nowPeople[$j] < $peopleLimit) {
                        $class[$j] = " yellow darken-2 active ";
                    }
                    else {
                        $class[$j] = " red lighten-3 ";
                    }
                }
                echo "<li>
                 <div class='collapsible-header grey-text text-lighten-5 ".$totalClass."'>
                   ".$date[$i]."  ".$nowTotalPeople."/".$totalPeople."
                 </div>
                 <div id=".$id[$i]." class='collapsible-body'>
                  <div class='timeBox timeBox1'>
                   <div class='colorBox".$class[1]."'></div>
                   <div class='leftBox'>
                    18:00~19:00
                   </div>
                   <div class='rightBox'>
                    ".$nowPeople[1]."/".$peopleLimit."
                   </div>
                  </div>
                  <div class='timeBox timeBox2'>
                   <div class='colorBox".$class[2]."'></div>
                   <div class='leftBox'>
                    19:00~20:00
                   </div>
                   <div class='rightBox'>
                    ".$nowPeople[2]."/".$peopleLimit."
                   </div>
                  </div>
                  <div class='timeBox timeBox3'>
                   <div class='colorBox".$class[3]."'></div>
                    <div class='leftBox'>
                    20:00~21:00
                   </div>
                   <div class='rightBox'>
                    ".$nowPeople[3]."/".$peopleLimit."
                   </div>
                  </div>
                 </div>
               </li>";
            }
        ?>
    </ul>
   </div>
   <!-- 预订状况结束 -->
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
  <script src="assets/js/index.js"></script>
 </body>
</html>
