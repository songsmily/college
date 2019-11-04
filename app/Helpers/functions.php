<?php

use Illuminate\Support\Facades\DB;

function dump_list(){
//    $objExcel=new \PHPExcel();//new一个excel工作表
//    $objSheet=$objExcel->getActiveSheet();
//    $objSheet->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//设置所有文字居中显示
//    $objSheet->getStyle("A2:J2")->getFont()->setName("华文中宋")->setSize(13)->setBold(True);
//    $objSheet->getStyle("A1:J1")->getFont()->setName("华文中宋")->setSize(18)->setBold(True);
//
//
//    $objSheet->setCellValue("A1","数学与信息工程学院")->mergeCells('A1:F1');
//    $objSheet->setCellValue("A2","获得发明专利、实用新型专利、外观设计专利和软件著作权")->mergeCells('A2:F2');
//
//
//    $objSheet->setCellValue("A3","序号")->setCellValue("B3","学号")->setCellValue("C3","姓名")->setCellValue("D3","专业班级")->setCellValue("E3","成果类别")->setCellValue("F3","成果名称");
//    $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
//    header('Content-Type: application/vnd.ms-excel');
//    header('Content-Disposition: attachment;filename="重庆第二师范学院教职工思想政治调查信息统计（数信学院）.xls"');
//    header('Cache-Control: max-age=0');
//    header('Cache-Control: max-age=1');
//    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
//    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
//    header ('Cache-Control: cache, must-revalidate');
//    header ('Pragma: public'); // HTTP/1.0
//    $objWriter->save('php://output');
//    dump(111);
}





/*
 * 公共函数,返回编号对应的数据表名
 */
function getTableNameByItemNo($itemNo){
    $table = null;
    switch ($itemNo){
        case 1001 :
            $table = "study_xslw";
        case 1002 :
            $table = "study_xszz";
        case 1003 :
            $table = "study_fbzp";
        case 1004 :
            $table = "study_kylx";
        case 1005 :
            $table = "study_fmzl";
        case 1006 :
            $table = "study_jnjs";
        case 1007 :
            $table = "study_etc";
        case 1008 :
            $table = "study_tem";
        case 1009 :
            $table = "study_pretco";
        case 1010 :
            $table = "study_ncre";
        case 1011 :
            $table = "study_shufa";
        case 1012 :
            $table = "study_jnzs";
        case 1013 :
            $table = "study_other";

        case 2001 :
            $table = "attr_shfw";
        case 2002 :
            $table = "attr_xjjt";
        case 2003 :
            $table = "attr_wmqs";
        case 2004 :
            $table = "attr_xjwmqs";
        case 2005 :
            $table = "attr_hsz";
        case 2006 :
            $table = "attr_qsby";
        case 2007 :
            $table = "attr_shxs";
        case 2008 :
            $table = "attr_xjgr";
        case 2009 :
            $table = "attr_jthd";
        case 2010 :
            $table = "attr_zyfw";;
        case 2011 :
            $table = "attr_gfzyfw";
        case 2012 :
            $table = "attr_ganbu";;
        case 2013 :
            $table = "attr_other";

        case 3001 :
            $table = "compare_ysbs";
        case 3002 :
            $table = "compare_stbs";
        case 3003 :
            $table = "compare_tyjs";
        case 3004 :
            $table = "compare_dopric";
        case 3005 :
            $table = "compare_xszz";
        case 3006 :
            $table = "compare_other";
    }
    return $table;
}
/*
 * 公共函数,将结果集转换为数组
 */
function objectToArray($object){
    return json_decode(json_encode($object), true);
}
/*
 * 公共函数,将结果集对象转换为结果集数组,并返回
 */
function objectToArrayAndGetData($object){
    $array =  json_decode(json_encode($object), true);
    return $array['data'];
}


function reloadSession($sno){
    $result = objectToArray( DB::table("student")->where("sno",$sno)->get());
    if ($result != null){
        session(["shetuan" => $result[0]['shetuan']]);
    }
}




