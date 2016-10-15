<?php
  session_start();

  //这里加上非法请求的判断

  $yibanID = "yibanID";
  $schoolID = $_POST['id'];
  $name = $_POST['name'];
  $date = $_POST['date'];
  $time = $_POST['time'];
  $year = substr($date,0,4);
  $month = substr($date,4,2);
  $day = substr($date,6,2);

  $id = $schoolID.$date.$time;
  $date = $month."月".$day."日";

  include "assets/API/config.php";
  include "assets/API/db_config.php";

  date_default_timezone_set('Asia/Shanghai');
  $nowTime = date("Y年m月d日 H:i");

  $db = new mysqli($db_host,$db_user,$db_password,$db_database);
  if (!$db)
  {
    exit('Could not connect: ' . mysql_error());
  }
  $db->query("set names 'utf8'");

  //这里检验人数
  $sql_query = "SELECT * FROM `gym_reserve` WHERE date ='". $date."' AND time = '".$time."'";
  $result = $db->query($sql_query);
  $nowPeople = $result->num_rows;
  if ($nowPeople >= $peopleLimit)
  {
    echo "3";
    die;
  }

  $sql_query = "INSERT INTO `gym_reserve` (id, yibanID, schoolID, name, date, time, reserveTime)
        VALUES ('$id', '$yibanID', '$schoolID', '$name', '$date', '$time', '$nowTime')";
  $result = $db->query($sql_query);
  if (!$result)
  {
    echo "5";
    die;
  }
  else {
    echo "1";
  }
/*
返回值
1成功

2非法请求
3人数已满
5参数错误
*/
?>
