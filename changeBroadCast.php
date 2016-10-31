<?php
  session_start();

  $topic = $_POST['topic'];
  $startTime = $_POST['startTime'];
  $endTime = $_POST['endTime'];
  $content = $_POST['content'];
  $schoolID = $_SESSION['schoolID'];

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

  $sql_query = "INSERT INTO `gym_announcement`(topic, startTime, endTime, content, askTime, askPeople)
        VALUES ('$topic', '$startTime', '$endTime', '$content', '$nowTime', '$schoolID')";

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
