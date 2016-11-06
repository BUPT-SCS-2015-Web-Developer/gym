<?php
    session_start();

    $yibanID = $_SESSION['yibanID'];

    include "assets/API/header_api_session.php";
    include "assets/API/iapp.php";
    include "assets/API/config.php";
    include "assets/API/db_config.php";

    $date = array();
    $id = array();

    date_default_timezone_set('Asia/Shanghai');
    $nowTimeShow = date("Y年m月d日 H:i");
    $judgeDate = date("Y-m-d");
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
    <?php

    if ($_SESSION['userType'] === "辅导员"){
        echo "<br/><div class='row hide-on-large-only'>
        <div class='col s2 offset-s2 grid-example'>
        <a class='waves-effect waves-light btn' href='adminbroadcast.php' >发布公告</a>
        </div>";
      echo "<div class='col s2 offset-s2 grid-example'>
          <a href='adminform.php' class='waves-effect waves-light btn'>后台管理</a>
      </div></div>";
    }


      $flag = false;
      $sql_query = "SELECT * FROM gym_announcement";
      $result = $db->query($sql_query);
      foreach ($result as $value) {
        if ($value['startTime'] <= $judgeDate && $judgeDate <= $value['endTime'])
        {
          echo "<div id='notice1'>
              <div class='card grey lighten-5'>
                <div class='card-content grey-text text-darken-4'>
                  <span class='card-title'>".$value['topic']."</span>
                  <p>".$value['content']."</p>
                </div>
                <div class='card-action'>
                  <a class='known' href='#'>我知道了</a>
                </div>
              </div>
          </div>";
          $flag = true;
        }
      }

      if (!$flag)
      {
        echo "<div id='notice0'>
         <div class='card grey lighten-5 '>
          <div class='card-content grey-text text-darken-4'>
           <span class='card-title'>Harvest by labor, fitness by exercise.</span>
          </div>
         </div>
        </div>";
      }


     ?>
   <!-- 说明 -->
   <div class="info">
    <h3>预订日程</h3>
    <p>现在时间是<b><?php echo $nowTimeShow; ?></b>,当日预约截止时间为17:00</p>
    <p>您可以预订<b><?php echo $showingDay; ?></b>天内的健身,点击下方可用时间段进行预订!</p>
    <!-- <p>由于您之前两次预订失约，您在两周内不能再进行预约。 哦豁o(*≧▽≦)ツ┏━┓[拍桌狂笑!]</p> -->
    <!-- <p>您已经预约了目前所有可用的时间段！对不起，您一定是疯了- -</p> -->

   </div>

   <hr />
   <div class="right">
      <span class='colorBox teal lighten-2 showing'></span> 空闲
      <span class='colorBox yellow darken-2 showing'></span> 繁忙
      <span class='colorBox red lighten-3 showing'></span> 满额
   </div>
   <br>
   <!-- 预订状况开始  -->
   <!-- 以下为范例,括弧中为提示,正式上线时务必删除 -->
   <div id="bookList">
    <ul class="collapsible popout" data-collapsible="expandable">
        <?php
            for ($i=0;$i<$showingDay;$i++)
            {
                $nowPeople = array();
                $class = array();
                $confirm = array();
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
                    $sql_query = "SELECT * FROM `gym_reserve` WHERE date ='". $date[$i]."' AND time = '".$j."' AND yibanID = '".$yibanID."'";
                    $result = $db->query($sql_query);
                    if ($result->num_rows >= 1){
                      $confirm[$j] = "已预约";
                    }
                    else{
                      $confirm[$j] = "";
                    }

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
                    ".$nowPeople[1]."/".$peopleLimit." ".$confirm[1]."
                   </div>
                  </div>
                  <div class='timeBox timeBox2'>
                   <div class='colorBox".$class[2]."'></div>
                   <div class='leftBox'>
                    19:00~20:00
                   </div>
                   <div class='rightBox'>
                    ".$nowPeople[2]."/".$peopleLimit." ".$confirm[2]."
                   </div>
                  </div>
                  <div class='timeBox timeBox3'>
                   <div class='colorBox".$class[3]."'></div>
                    <div class='leftBox'>
                    20:00~21:00
                   </div>
                   <div class='rightBox'>
                    ".$nowPeople[3]."/".$peopleLimit." ".$confirm[3]."
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
  <br /></main>
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
       <li><a id="BTNinstruction" class="grey-text text-lighten-3" href="#">使用说明</a></li>
       <li><a id="BTNterms" class="grey-text text-lighten-3" href="#">使用条款</a></li>
       <li><a id="BTNfeedback" class="grey-text text-lighten-3" href="#">意见反馈</a></li>
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
   <div id="terms">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">北京邮电大学沙河校区健身房管理规定</span>
              <p>
1. 学校健身房只对本校学生和教职工免费开放，谢绝校外人员进入。学生和教职工按照上述开放时间进入活动，进入时必须主动出示本人的校园一卡通，本人校园卡不得转借他人使用。<br/>
2. 健身房内禁止吸烟，以确保场内卫生和空气流畅。严禁酒后进入健身房进行锻炼。<br/>
3. 自觉维护健身房的公共卫生，严禁乱丢果皮纸屑，严禁在健身房内吸烟、乱丢垃圾或大声喧哗；严禁在墙壁乱涂乱画或蹬踏。<br/>
4. 使用健身器材需穿运动服、鞋，禁止穿高跟鞋、皮鞋锻炼。<br/>
5. 按说明书要求正确使用健身器材，确保人员及器材安全，防止使用不当造成不安全事故。<br/>
6. 进入健身房参加运动的人员，要爱护健身器材，不得轻易拆卸器材；造成健身器材损坏的，照价赔偿。<br/>
7. 健身器材发生故障或损坏，应停止使用，并及时报告管理人员进行维修。<br/>
8. 进入健身房人员应提高警惕，注意安全，自行保管好衣物及重要财物，若有丢失责任自负。<br/>
9. 活动完毕，自觉将各种器械放回原处，摆放整齐。严格遵守健身时间及健身房各注意事项。<br/>
10.在健身房健身的人员必须遵守有关规章制度，服从管理人员的管理。<br/>
</p>
            </div>
            <div class="card-action">
              <a id="closeTerms" href="#">关闭</a>
            </div>
          </div>
        </div>
      <div id="instruction">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">健身房系统使用说明</span>
              <p>
预约: 进入健身房系统主页并经过易班授权后，只需点击可用的时间段(非红色满人时间段)即可进入预约页，在支付一定网薪(待定)后就预约完成啦。<br/>
查看预约信息：手机端的话点左上角的头像进个人中心查看，电脑则是右上角。可以在这里临时取消预约。<br/>
违约处罚：一旦被记录失约后，您将一段时间内无法预约。 如恶意违约多次可能会被封禁。<br/>
              </p>
            </div>
            <div class="card-action">
              <a id="closeInstruction" href="#">关闭</a>
            </div>
          </div>
        </div>
  </footer>
  <!--  Scripts-->
  <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="assets/js/materialize.js"></script>
  <script src="assets/js/index.js"></script>
 </body>
</html>
