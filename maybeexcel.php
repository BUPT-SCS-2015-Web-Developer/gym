

<?php  
error_reporting(E_ALL);  
date_default_timezone_set('Europe/London');  
/** PHPExcel */  
require_once 'C:/xampp/htdocs/gym/Classes/PHPExcel.php';  
  
// Create new PHPExcel object  
$objPHPExcel = new PHPExcel();  

  
// Set properties  
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")  
                             ->setLastModifiedBy("Maarten Balliauw")  
                             ->setTitle("Office 2007 XLSX Test Document")  
                             ->setSubject("Office 2007 XLSX Test Document")  
                             ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")  
                             ->setKeywords("office 2007 openxml php")  
                             ->setCategory("Test result file");  
$objPHPExcel->getActiveSheet()->mergeCells('A1:G1');  
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);  
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);  
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);  
  

  
  
$objPHPExcel->setActiveSheetIndex(0)  
            ->setCellValue('A2', '序号')  
            ->setCellValue('B2', '学号')  
            ->setCellValue('C2', '姓名')  
            ->setCellValue('D2', '学院')  
            ->setCellValue('E2', '预约日期')  
            ->setCellValue('F2', '预约时间')  
            ->setCellValue('G2', '赴约情况');     

  
//数据库连接  
$db = mysqli_connect("localhost", "root", "jmy5zhentan5");  
mysqli_select_db($db,"SportReservation");  //选择数据库，这里为"ywcl"。  
mysqli_query($db,"SET appointment UTF8"); //设定编码方式为UTF8  

  
$sqlgroups="select * from appointment order by id";  
$resultgroups=mysqli_query($db,$sqlgroups);  
    $numrows=mysqli_num_rows($resultgroups); 

    if ($numrows>0)  
    {  
        $count=2;  
        while($data=mysqli_fetch_array($resultgroups))  
        {  

            $count+=1;  
            $l1="A"."$count";  
            $l2="B"."$count";  
            $l3="C"."$count";  
            $l4="D"."$count";  
            $l5="E"."$count";  
            $l6="F"."$count";  
            $l7="G"."$count"; 			
            $objPHPExcel->setActiveSheetIndex(0)              
                        ->setCellValue($l1, $data['id'])  
                        ->setCellValue($l2, $data['number'])  
                        ->setCellValue($l3, $data['name'])  
                        ->setCellValue($l4, $data['institution'])  
                        ->setCellValue($l5, $data['date'])  
                        ->setCellValue($l6, $data['time'])  
                        ->setCellValue($l7, $data['ifkppromise']);  
        }  
    }          
  
// Rename sheet  
$objPHPExcel->getActiveSheet()->setTitle('AppointmentInformation');  

  
// Set active sheet index to the first sheet, so Excel opens this as the first sheet  
$objPHPExcel->setActiveSheetIndex(0);  
  

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="AppointmentInformation.xlsx"');
header('Cache-Control: max-age=0');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
$objWriter->save('AppointmentInformation.xlsx');  
exit;  
?>
