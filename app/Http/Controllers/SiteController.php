<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use PHPExcel;
use PHPExcel_Style_NumberFormat;
use PHPExcel_Style_Border;
use PHPExcel_IOFactory;
use PHPExcel_Style_Alignment;
class SiteController extends Controller
{
    public function index(){
        $objExcel=new \PHPExcel();//new一个excel工作表
        $objSheet=$objExcel->getActiveSheet();
        $objSheet->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//设置所有文字居中显示
        $objSheet->getStyle("A2:J2")->getFont()->setName("华文中宋")->setSize(13)->setBold(True);
        $objSheet->getStyle("A1:J1")->getFont()->setName("华文中宋")->setSize(18)->setBold(True);

        
        $objSheet->setCellValue("A1","数学与信息工程学院")->mergeCells('A1:F1');
        $objSheet->setCellValue("A2","获得发明专利、实用新型专利、外观设计专利和软件著作权")->mergeCells('A2:F2');


        $objSheet->setCellValue("A3","序号")->setCellValue("B3","学号")->setCellValue("C3","姓名")->setCellValue("D3","专业班级")->setCellValue("E3","成果类别")->setCellValue("F3","成果名称");
        $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="重庆第二师范学院教职工思想政治调查信息统计（数信学院）.xls"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        header ('Cache-Control: cache, must-revalidate');
        header ('Pragma: public'); // HTTP/1.0
        $objWriter->save('php://output');
    }
}
