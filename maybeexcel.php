<?php

    session_start();
    date_default_timezone_set('Asia/Shanghai');
    $nowDate = date("m月d日");

    include "assets/API/db_config.php";
    include "assets/API/config.php";
//    include "assets/API/dcon.php";
    $db = new mysqli($db_host,$db_user,$db_password,$db_database);
    if (!$db)
      {
      die('Could not connect: ' . mysql_error());
      }
    $db->query("set names 'utf8'");

    require_once 'Classes/PHPExcel.php';

    $nowPeople = array();
    for ($j = 1; $j<=3;$j++){
      $sql_query = "SELECT * FROM `gym_reserve` WHERE date ='". $nowDate."' AND time = '".$j."'";
      $result = $db->query($sql_query);
      $nowPeople[$j] = $result->num_rows;
    }

    $objPHPExcel=new PHPExcel();
    $objPHPExcel->getProperties()->setCreator('Bupt')
            ->setLastModifiedBy('Bupt')
            ->setTitle('Office 2007 XLSX Document')
            ->setSubject('Office 2007 XLSX Document')
            ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('Result file');
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1','三个时段人数：')
                ->setCellValue('B1',$nowPeople[1]."/".$peopleLimit)
                ->setCellValue('C1',$nowPeople[2]."/".$peopleLimit)
                ->setCellValue('D1',$nowPeople[3]."/".$peopleLimit)
                ->setCellValue('A2','学号')
                ->setCellValue('B2','姓名')
                ->setCellValue('C2','日期')
                ->setCellValue('D2','时间')
                ->setCellValue('E2','到达');

    $sql_query = "SELECT * FROM `gym_reserve` WHERE `date` = '".$nowDate."' order by `date`, `time`";//查询语句
    $result = $db->query($sql_query);
    
    $i = 3;
    foreach($result as $v){
      if ($v['time'] == 1)
      {
        $showTime = "18:00-19:00";
      }
      elseif ($v['time'] == 2) {
        $showTime = "19:00-20:00";
      }
      elseif ($v['time'] == 3){
        $showTime = "20:00-21:00";
      }
     $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,$v['schoolID'])
                ->setCellValue('B'.$i,$v['name'])
                ->setCellValue('C'.$i,$v['date'])
                ->setCellValue('D'.$i,$showTime);
                $i++;
    }
    $objPHPExcel->getActiveSheet()->setTitle('Sheet1');
    $objPHPExcel->setActiveSheetIndex(0);
    $filename=urlencode('健身房').'_'.date('Y-m-dHis');

/*
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
*/
    /*
    *生成xls文件*/
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

    $objWriter->save('php://output');
    //exit;

 ?>
