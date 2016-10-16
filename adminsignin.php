<?php

	$con = mysqli_connect('localhost', 'root', 'jmy5zhentan5') or die ("不能连接数据库:");
	mysqli_select_db($con,'SportReservation');
	
	$outcome=$_GET['outcome'];
	$id=$_GET['id'];
    
	echo $outcome;
	mysqli_query($con,"UPDATE `appointment` SET ifkppromise = '$outcome' WHERE id = '$id' ");
	mysqli_query($con,"set names utf8");
	mysqli_close($con);
?>