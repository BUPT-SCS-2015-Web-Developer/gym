<?php 
//易班验证blablabla

    $showingDay = 7; //可以提前预定/列表显示的天数
    $peopleLimit = 15; //每个时间段人数上限


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
      <div class="noticeBox" id="notice1">
          <div class="card grey lighten-5">
            <div class="card-content grey-text text-darken-4">
              <span class="card-title">公告标题</span>
              <p>公告内容</p>
            </div>
            <div class="card-action grey-text text-darken-4">
              <a class="known" href="#">我知道了</a>
            </div>
          </div>
      </div>
   -->  
   <!-- 如果没有公告 显示这个 --> 
   <div class="notice" id="notice0"> 
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
    <p>现在时间是mm-dd hh-mm,当日预约截止时间为17:00</p> 
    <p>您可以预订x天内的健身,点击下方可用时间段进行预订!</p> 
    <!-- <p>由于您之前两次预订失约，您在两周内不能再进行预约。 哦豁o(*≧▽≦)ツ┏━┓[拍桌狂笑!]</p> --> 
    <!-- <p>您已经预约了目前所有可用的时间段！对不起，您一定是疯了- -</p> --> 
   </div> 
   <hr /> 
   <!-- 预订状况开始  --> 
   <!-- 以下为范例,括弧中为提示,正式上线时务必删除 --> 
   <div id="bookList"> 
    <ul class="collapsible popout" data-collapsible="expandable"> 
     <li> 
      <!-- collapsible-header和colorBox的class分别为 red lighten-3 满人 yellow darken-2 超过10人 teal lighten-2 空闲 --> 
      <!-- 对于满人的一天，class中不加active --> 
      <!-- 注意后台要有判断不显示的天，如国庆7天放假等 --> 
      <div class="collapsible-header teal lighten-2 grey-text text-lighten-5 active">
        10月11日 星期二(32/45 不满80% 为绿色) 
      </div> 
      <div id="20161011" class="collapsible-body"> 
       <!-- id为日期,yyyymmdd格式 --> 
       <div class="timeBox timeBox1"> 
        <div class="colorBox yellow darken-2"></div> 
        <div class="leftBox">
          18:00~19:00 
        </div> 
        <div class="rightBox">
          12/15 
        </div> 
       </div> 
       <div class="timeBox timeBox2"> 
        <div class="colorBox red lighten-3"></div> 
        <div class="leftBox">
          19:00~20:00 
        </div> 
        <div class="rightBox">
          15/15 
        </div> 
       </div> 
       <div class="timeBox timeBox3"> 
        <div class="colorBox teal lighten-2"></div> 
        <div class="leftBox">
          20:00~21:00 
        </div> 
        <div class="rightBox">
          5/15 
        </div> 
       </div> 
      </div> </li> 
     <li> 
      <div class="collapsible-header yellow darken-2 grey-text text-lighten-5 active">
        10月12日 星期三(39/45 超过80% 为黄色) 
      </div> 
      <div id="20161011" class="collapsible-body"> 
       <div class="timeBox timeBox1"> 
        <div class="colorBox yellow darken-2"></div> 
        <div class="leftBox">
          18:00~19:00 
        </div> 
        <div class="rightBox">
          14/15 
        </div> 
       </div> 
       <div class="timeBox timeBox2"> 
        <div class="colorBox red lighten-3"></div> 
        <div class="leftBox">
          19:00~20:00 
        </div> 
        <div class="rightBox">
          15/15 
        </div> 
       </div> 
       <div class="timeBox timeBox3"> 
        <div class="colorBox yellow darken-2"></div> 
        <div class="leftBox">
          20:00~21:00 
        </div> 
        <div class="rightBox">
          13/15 
        </div> 
       </div> 
      </div> </li> 
     <li> 
      <div class="collapsible-header red lighten-3 grey-text text-lighten-5">
        10月13日 星期四(45/45 红色 且无active 即默认不显示) 
      </div> 
      <div id="20161011" class="collapsible-body"> 
       <div class="timeBox timeBox1"> 
        <div class="colorBox red lighten-3"></div> 
        <div class="leftBox">
          18:00~19:00 
        </div> 
        <div class="rightBox">
          15/15 
        </div> 
       </div> 
       <div class="timeBox timeBox2"> 
        <div class="colorBox red lighten-3"></div> 
        <div class="leftBox">
          19:00~20:00 
        </div> 
        <div class="rightBox">
          15/15 
        </div> 
       </div> 
       <div class="timeBox timeBox3"> 
        <div class="colorBox red lighten-3"></div> 
        <div class="leftBox">
          20:00~21:00 
        </div> 
        <div class="rightBox">
          15/15 
        </div> 
       </div> 
      </div> </li> 
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