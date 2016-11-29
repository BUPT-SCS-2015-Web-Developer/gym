<?php
  session_start();
  //    include "assets/API/header_api_session.php";
  //    include "assets/API/iapp.php";
  include "assets/API/config.php";
  include "assets/API/db_config.php";

  if (isset($_GET['checkDate']))
    $checkDate = $_GET['checkDate'];
  else
    $checkDate = date("m月d日");

  $db = new mysqli($db_host,$db_user,$db_password,$db_database);
  if (!$db)
  {
    exit('Could not connect: ' . mysql_error());
  }
  $db->query("set names 'utf8'");

  date_default_timezone_set('Asia/Shanghai');
  $nowDate = date("m月d日");
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
      <div id='notice0'>
       <div class='card grey lighten-5 '>
        <div class='card-content grey-text text-darken-4'>
         <span class='card-title'>有问题联系qq:907886076</span>
        </div>
       </div>
      </div>
      <!--<div class="row">
          <h5 class="grey-text darken-1">当前预约状况</h5>
      </div>-->
    <div class="cross">
      <table id="excel1" class="striped">
        <thead>
          <tr>
            <th data-field="schoolID">学号</th>
            <th data-field="name">姓名</th>
            <th data-field="date">预约日期</th>
            <th data-field="time">预约时间</th>
            <th data-field="confirm">赴约情况</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
<<<<<<< HEAD
              $sql_query = "SELECT * FROM `gym_reserve` WHERE `date` = '".$checkDate."' order by `date`, `time`";
=======
              $sql_query = "SELECT * FROM `gym_reserve` WHERE `date` <= '".$nowDate."' order by `date`, `time`";
>>>>>>> 1e4a7d4f1dcc28dcfe28de0a0e605483d96b742c
              $result = $db->query($sql_query);
            	foreach ($result as $row) {
            		$nid=$row['id'];
            ?>
            <td><?php echo $row['schoolID']?></td>
            <td><?php echo $row['name']?></td>
						<td><?php echo $row['date']?></td>
						<td><?php
                        if ($row['time'] == 1)
                        {
                          $time = "18:00-19:00";
                        }
                        elseif ($row['time'] == 2) {
                          $time = "19:00-20:00";
                        }
                        elseif ($row['time'] == 3)
                        {
                          $time = "20:00-21:00";
                        }
                        echo $time;?></td>
			<!--	    <td id="change<?=$nid?>"><?php echo $row['id']?></td> -->
						<td><a class='dropdown-button btn   waves-effect waves-teal btn-flat   ' data-activates='drop<?=$nid?>'>修改状态</a>
                            <ul id='drop<?=$nid?>' class='dropdown-content'>
                            <li><a onclick="javascript:ypromise('<?=$nid?>');">已赴约</a></li>
                            <li><a onclick="javascript:npromise('<?=$nid?>');">未赴约</a></li></ul>
						</td>
          </tr>

          <?php
            }
          ?>
        </tbody>
      </table>
	</div>
		<div class="row">
		    <div class="col s2 offset-s2 grid-example">
		        <!-- Dropdown Trigger -->
                <!--<a class='dropdown-button btn' href='#' data-activates='dropdown2'>记录筛选</a>-->
                <!-- Dropdown Structure -->
                <ul id='dropdown2' class='dropdown-content'>
                    <li><a href="adminsorttime1.php">18:00—19:00</a></li>
                    <li><a href="adminsorttime2.php">19:00—20:00</a></li>
                    <li><a href="adminsorttime3.php">20:00—21:00</a></li>
					<li class="divider"></li>
					<li><a href="adminform.php">全部记录</a></li>
                </ul>
		    </div>
		    <div class="col s2 offset-s2 grid-example">
                <a href="maybeexcel.php" class="waves-effect waves-light btn">导出表格</a>
		    <!--    <a id="wantexcel" class="waves-effect waves-light btn"  onclick="funTestDown();">导出表格</a>-->
		    </div>
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
  <script type="text/javascript" src="assets/js/getexcel.js"></script>

<script type="text/javascript">
        function funTestDown() {
			var xmlhttp;
		    try {
			   xmlhttp = new XMLHttpRequest();
		    }
		    catch (e) {
			    try {
				    xmlhttp = new ActiveXObject("Msxm12.XMLHTTP");
			        }
			    catch (e){
				    try {
					    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				    }
				    catch (e){
					   alert("您的浏览器不支持AJAX");
					   return false;
				    }
			    }
		    }
			var url = "maybeexcel.php?sid="+Math.random();
		    xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {

                }
            };
		    xmlhttp.open("GET",url,true);
		    xmlhttp.send(null);
           var myrar = window.open("AppointmentInformation.xlsx");
            myrar.document.execCommand("SaveAs");
            myrar.close();
        }
    </script>



<script type="text/javascript">
    function ypromise(thisid){
		var xmlhttp;
		try {
			xmlhttp = new XMLHttpRequest();
		}
		catch (e) {
			try {
				xmlhttp = new ActiveXObject("Msxm12.XMLHTTP");
			}
			catch (e){
				try {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e){
					alert("您的浏览器不支持AJAX");
					return false;
				}
			}
		}

		var url = "adminsignin.php?outcome=Y&id="+thisid+"&sid="+Math.random();
		xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                document.getElementById("change"+thisid).innerHTML=xmlhttp.responseText;
            }
        };
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
        window.location.href="adminform.php";
	}

	function npromise(thisid){
		var xmlhttp;

		try {
			xmlhttp = new  XMLHttpRequest();
		}
		catch (e) {
			try {
				xmlhttp = new ActiveXObject("Msxm12.XMLHTTP");
			}
			catch (e){
				try {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e){
					alert("您的浏览器不支持AJAX");
					return false;
				}
			}
		}

		var url = "adminsignin.php?outcome=N&id="+thisid+"&sid="+Math.random();
		xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                document.getElementById("change"+thisid).innerHTML=xmlhttp.responseText;
            }
        }
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
        window.location.href="adminform.php";
	}
</script>

  <script>
    $(function(){

  }); // end of document ready
    </script>
  </body>
</html>
