<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use PHPExcel;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Writer_Excel5;

class AdminController extends Controller
{
    public function admin()
    {
        $resp =  objectToArray(DB::table('resp')->first())['resp'];
        session(['resp'=>$resp]);
        return view("admin");

    }
    public function changeQues(){
        $value = Input::get('value');
        DB::beginTransaction();
        try{
            $check = DB::table('resp')->update(['resp'=>$value]);
            if ($check){
                DB::commit();
                session(['resp'=>$value]);
                return 1;
            }else{
                DB::rollBack();
                return 0;
            }
        }catch (Exception $exception){
            DB::rollBack();
            return 0;
        }
    }

    public function outScore()
    {
        $objExcel=new PHPExcel();
        $objExcel->setActiveSheetIndex(0);
        $objSheet=$objExcel->getActiveSheet();
        $objSheet->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objSheet->getStyle("A1:E1")->getFont()->setName("华文中宋")->setSize(18)->setBold(True);
        $objSheet->getStyle("A2:E2")->getFont()->setName("华文中宋")->setSize(13);
        $objSheet->setCellValue("A1","数信学院党建考试成绩汇总" )->mergeCells('A1:E1');
        $objSheet->setCellValue("A2","序号")->setCellValue("B2","学年")->setCellValue("C2","姓名")->setCellValue("D2","支部")->setCellValue("E2","得分");

        $objExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
        $objExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objExcel->getActiveSheet()->getColumnDimension('C')->setWidth(21);
        $objExcel->getActiveSheet()->getColumnDimension('D')->setWidth(31);
        $objExcel->getActiveSheet()->getColumnDimension('E')->setWidth(21);
        $result = objectToArray(DB::table('user')->where('count',">",0)->get());
        for ($i = 0;$i<count($result);$i++){
            $score = DB::table('score')->where('username',$result[$i]['username'])->max('score');
            $result[$i]['score'] = $score;
        }
        $pos = 2;
        for ($i = 0 ; $i < count($result) ; $i++) {
            $pos++;

            $objSheet->setCellValue("A".$pos,$i+1)->setCellValue("B".$pos,"2019学年")->setCellValue("C".$pos,$result[$i]['username'])->setCellValue("D".$pos,$result[$i]['zhibu'])->setCellValue("E".$pos,$result[$i]['score']);

        }

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                ),
            ),
        );
        $objExcel->getActiveSheet()->getStyle('A1:E'.$pos)->applyFromArray($styleArray);
        $objWriter = new PHPExcel_Writer_Excel5($objExcel);
        ob_end_clean();
        $outputFileName = "数信学院党建考试成绩汇总.xls";
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition:inline;filename="'.$outputFileName.'"');
        header("Content-Transfer-Encoding: binary");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        $objWriter->save('php://output');
    }
    public function outTimes()
    {
        $objExcel=new PHPExcel();
        $objExcel->setActiveSheetIndex(0);
        $objSheet=$objExcel->getActiveSheet();
        $objSheet->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objSheet->getStyle("A1:E1")->getFont()->setName("华文中宋")->setSize(18)->setBold(True);
        $objSheet->getStyle("A2:E2")->getFont()->setName("华文中宋")->setSize(13);
        $objSheet->setCellValue("A1","数信学院党建考试次数汇总" )->mergeCells('A1:F1');
        $objSheet->setCellValue("A2","序号")->setCellValue("B2","学年")->setCellValue("C2","姓名")->setCellValue("D2","支部")->setCellValue("E2","次数")->setCellValue("F2","得分");

        $objExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
        $objExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objExcel->getActiveSheet()->getColumnDimension('C')->setWidth(21);
        $objExcel->getActiveSheet()->getColumnDimension('D')->setWidth(31);
        $objExcel->getActiveSheet()->getColumnDimension('E')->setWidth(21);
        $objExcel->getActiveSheet()->getColumnDimension('F')->setWidth(21);
        $result = objectToArray(DB::table('score')
            ->join('user', 'user.username', '=', 'score.username')
            ->select('score.username', 'user.zhibu', 'score.times','score.score')->orderBy("score.username")->orderByDesc("score.score")
            ->get());
        $pos = 2;
        for ($i = 0 ; $i < count($result) ; $i++) {
            $pos++;

            $objSheet->setCellValue("A".$pos,$i+1)->setCellValue("B".$pos,"2019学年")->setCellValue("C".$pos,$result[$i]['username'])->setCellValue("D".$pos,$result[$i]['zhibu'])->setCellValue("E".$pos,$result[$i]['times'])->setCellValue("F".$pos,$result[$i]['score']);

        }

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                ),
            ),
        );
        $objExcel->getActiveSheet()->getStyle('A1:F'.$pos)->applyFromArray($styleArray);
        $objWriter = new PHPExcel_Writer_Excel5($objExcel);
        ob_end_clean();
        $outputFileName = "数信学院党建考试次数汇总.xls";
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition:inline;filename="'.$outputFileName.'"');
        header("Content-Transfer-Encoding: binary");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        $objWriter->save('php://output');
    }
    public function logout()
    {
        Session()->flush();
        return 1;
    }

}
