<?php

	$con = mysqli_connect('localhost', 'root', 'jmy5zhentan5') or die ("不能连接数据库:");
	mysqli_select_db($con,'SportReservation');
	
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
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container hide-on-med-and-down">
        <a href="#" class="brand-logo">
            <img class="logo circle" src="assets/img/logo.png">健身房预约</a>
      <ul class="right">
        <li><a href="#">个人中心</a></li>
      </ul>
    </div>
    <div class="nav-wrapper hide-on-large-only">
        <a href="#" class="brand-logo">
            <img class="logo circle" src="assets/img/logo.png">健身房预约</a>
      <ul class="left">
        <li><a href="#"><img id="user" class="circle" src="assets/img/user.png"></a></li>
      </ul>
    </div>
  </nav>



  <div class="container">
            <!--<div class="row">
                <h5 class="grey-text darken-1">当前预约状况</h5>
            </div>-->
    	    <div class="cross">
		    <table id="excel1" class="striped">
                <thead>
                    <tr>
                        <th data-field="id">学号</th>
                        <th data-field="name">姓名</th>
						<th data-field="institution">学院</th>
						<th data-field="date">预约日期</th>
                        <th data-field="time">预约时间</th>
						<th data-field="ifkppromise">赴约情况</th>
                     </tr>
                </thead>
                <tbody>
<?php
    $result = mysqli_query($con,"SELECT * FROM `appointment` ");
	mysqli_query($con,"set names utf8");
	$num_result = mysqli_num_rows($result);
	for ($i=0;$i<$num_result;$i++) {
		$row = mysqli_fetch_row($result);
		if ($row[5]=='19:00-20:00'){
		?>          
					<tr>
                        <td><?php echo $row[1]?></td>
                        <td><?php echo $row[2]?></td>
                        <td><?php echo $row[3]?></td>
						<td><?php echo $row[4]?></td>
						<td><?php echo $row[5]?></td>
						<td><a class="waves-effect waves-teal btn-flat" href="#">已赴约</a><a class="waves-effect waves-teal btn-flat" href="#">未赴约</a></td>
                    </tr>
					
		<?php
		}
	}
?>  
                </tbody>
             </table>
		</div>
		<div class="row">
		    <div class="col s2 offset-s2 grid-example">
		        <!-- Dropdown Trigger -->
                <a class='dropdown-button btn' href='#' data-activates='dropdown1'>记录筛选</a>
                <!-- Dropdown Structure -->
                <ul id='dropdown1' class='dropdown-content'>
                    <li><a href="adminsorttime1.php">18:00—19:00</a></li>
                    <li><a href="adminsorttime2.php">19:00—20:00</a></li>
                    <li><a href="adminsorttime3.php">20:00—21:00</a></li>
					<li class="divider"></li>
					<li><a href="adminform.php">全部记录</a></li>
                </ul>
		    </div>
		    <div class="col s2 offset-s2 grid-example">
		        <a class="waves-effect waves-light btn" onclick="saveAsExcel('excel1')">导出表格</a>
		    </div>
		</div>
  </div>

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
  <script>
    $(function(){

  }); // end of document ready
    </script>
  </body>
</html>