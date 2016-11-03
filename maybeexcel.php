<?php
    
    session_start();
    date_default_timezone_set('Asia/Shanghai');
    $nowDate = date("m月d日");

    include "assets/API/db_config.php";
//    include "assets/API/dcon.php";
    $db = new mysqli($db_host,$db_user,$db_password,$db_database);
    if (!$db)
      {
      die('Could not connect: ' . mysql_error());
      }
    $db->query("set names 'utf8'");

    $sql_query = "SELECT * FROM `gym_reserve` WHERE `date` <= '".$nowDate."' order by `date`, `time`";//查询语句
    $result = $db->query($sql_query);

    require_once 'Classes/PHPExcel.php';


    $objPHPExcel=new PHPExcel();
    $objPHPExcel->getProperties()->setCreator('Bupt')
            ->setLastModifiedBy('Bupt')
            ->setTitle('Office 2007 XLSX Document')
            ->setSubject('Office 2007 XLSX Document')
            ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('Result file');
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1','学号')
                ->setCellValue('B1','姓名')
                ->setCellValue('C1','日期')
                ->setCellValue('D1','时间')
                ->setCellValue('E1','到达');
    $i = 2;
    foreach($result as $v){
     $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,$v['schoolID'])
                ->setCellValue('B'.$i,$v['name'])
                ->setCellValue('C'.$i,$v['date'])
                ->setCellValue('D'.$i,$v['time']);
                $i++;
    }
    $objPHPExcel->getActiveSheet()->setTitle('Sheet1');
    $objPHPExcel->setActiveSheetIndex(0);
    $filename=urlencode('信息统计').'_'.date('Y-m-dHis');

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
