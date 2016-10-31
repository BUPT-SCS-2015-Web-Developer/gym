<?php
	session_start();

	$outcome=$_GET['outcome'];
	$id=$_GET['id'];

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
			$reserveTime = $value['reserveTime'];
  }

//这里是记录取消预约和回复网薪的
			$sql_query = "INSERT INTO `gym_data` (yibanID, schoolID, name, date, time, reserveTime, come, cancel)
			VALUES ('$yibanID', '$schoolID', '$name', '$date', '$time', '$reserveTime', '$outcome', 'N' )";

			$result = $db->query($sql_query);


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

?>
