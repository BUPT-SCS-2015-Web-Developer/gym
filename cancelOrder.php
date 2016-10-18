<?php
  session_start();

  //这里加上非法请求的判断

  $yibanID = "yibanID";
  $id = $_POST['id'];

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

  $sql_query = "SELECT * FROM `gym_reserve` WHERE id ='". $id."'";
  $result = $db->query($sql_query);

  if ($result->num_rows < 1)
  {
      echo "4";
      die;
  }

  foreach ($result as $value) {
      $yibanID = $value['yibanID'];
      $schoolID = $value['schoolID'];
      $name = $value['name'];
      $date = $value['date'];
      $time = $value['time'];
  }

//这里是记录取消预约和回复网薪的

  $sql_query = "DELETE FROM `gym_reserve` WHERE `gym_reserve`.`id` = '".$id."'";
  $result = $db->query($sql_query);
  if (!$result)
  {
    echo "2";
    die;
  }
  else {
    echo "1";
  }

/*
返回值
1成功
2非法请求
4不存在的请求(id找不到对应预约)
*/
?>
