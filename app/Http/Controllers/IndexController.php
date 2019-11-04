<?php

namespace App\Http\Controllers;

use App\Jobs\trade;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Queue\Queue;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use PHPExcel;
use PHPExcel_Cell_DataValidation;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Writer_Excel5;

class IndexController extends Controller
{
    public function index()
    {
        if (session('count')>0){
            $maxScore = DB::table('score')->where('username',session('username'))->max('score');
        }else{
            $maxScore = 0;
        }
        session(['maxScore'=>$maxScore]);
        return view("index");
    }

    public function loadContent()
    {

        $questions = array();
        if (session("questions") == null){
            $resp = objectToArray(DB::table("resp")->first())["resp"];
            $result = objectToArray(DB::table("question")->where("resp",$resp)->get());
            $i = 0;
            $posArray = array();
            while(count($posArray) < 30){
                $pos = rand(0,count($result)-1);
                if (in_array($pos,$posArray)){
                    continue;
                }
                $questions = array_merge($questions,[$result[$pos]]);
                $posArray = array_merge($posArray,[$pos]);
            }
            session(["questions"=>$questions]);
        }else{
            $questions = session("questions");
        }

        return view("content",compact("questions"));

    }
    public function loadNewContent()
    {

        $questions = array();
        $resp = objectToArray(DB::table("resp")->first())["resp"];
        $result = objectToArray(DB::table("question")->where("resp",$resp)->get());
        $i = 0;
        $posArray = array();
        while(count($posArray) < 30){
            $pos = rand(0,count($result)-1);
            if (in_array($pos,$posArray)){
                continue;
            }
            $questions = array_merge($questions,[$result[$pos]]);
            $posArray = array_merge($posArray,[$pos]);
        }
        session(["questions"=>$questions]);
        return view("content",compact("questions"));

    }

    public function login(Request $request)
    {

        return view("login");
    }
    public function regist(Request $request)
    {
        return view("regist");
    }

    public function doAnswer()
    {
        $questions =session("questions");
        $result = Input::get("answer");
        $resultkeys= array_keys($result);
        $score = 0;
//        dump($questions);
//        dump($result);
        for ($j = 0;$j<count($resultkeys);$j++){
            $keys = $resultkeys[$j];
            for($i = 0; $i < count($questions) ;$i++){
                $question = $questions[$i];

                if (substr($keys,1) == $question['id']){
                    if ($result[$keys] == $question['answer']){
                        $score +=1;
                    }
                }
            }
        }
        $data['score'] = $score;
        $data['username'] = session('username');
        $data['times'] = session('count') + 1;

        DB::beginTransaction();
        try{
            $check1 =  DB::table('score')->insert($data);
            $check2 = DB::table('user')->where('username',$data['username'])->update(['count' =>$data['times']]);
            if ($check1 && $check2){
                DB::commit();
                session(['count'=>session('count') + 1]);
                $ajaxResult ['score'] = $score;
                $maxScore = DB::table('score')->where('username',$data['username'])->max('score');
                $ajaxResult ['maxScore'] = $maxScore;
                session(['maxScore'=>$maxScore]);
                session(['questions'=>null]);
                $ajaxResult ['count'] = session('count');
                $ajaxResult ['pos'] = 1;
                return $ajaxResult;
            }else{
                DB::rollBack();
                $ajaxResult ['pos'] = 0;
                return $ajaxResult;
            }
        }catch (Exception $exception){
            DB::rollBack();
            DB::rollBack();
            $ajaxResult ['pos'] = 0;
            return $ajaxResult;
        }
    }
    public function doRegist()
    {
        $result = Input::get();
        unset($result['repassword']);
        DB::beginTransaction();
        try{
            $check = DB::table("user")->insert($result);
            if ($check){
                DB::commit();
                session(['username'=>$result["username"]]);
                session(['count'=>0]);
                return 1;
            }else{
                return -1;
            }
        }catch(Exception $e){
            DB::rollBack();
            return -1;
        }
    }
    public function postIndex()
    {
        if (session('class') == null){
            $result =  DB::table("shetuan")->paginate("12");
        }else{
            $result =  DB::table("shetuan")->join("astrict","shetuan.shetuan","=","astrict.shetuan")->where("astrict.class","=",session("class"))->where("astrict.sum","!=",0)->paginate("12");
        }
        $links = $result->links();
        $data = objectToArrayAndGetData($result);
        reloadSession(session('sno'));
        return view("content",compact("links",'data'));
    }
    /*
     * 返回值
     * -1 人数已满
     * -2 人数已满或系统访问人数过多
     * 1 报名成功
     */
    public function doSend(Request $request)
    {
        $shetuan = $request->get('id');
        $sno = session('sno');

        $result = objectToArray(DB::table('astrict')->where('shetuan',$shetuan)->where("class",session("class"))->first());
        if ($result['count'] >= $result['sum']){
            return -1;
        }
        $stuResult = objectToArray(DB::table('student')->where('sno',$sno)->first());
        if ($stuResult['shetuan'] != '0'){
            DB::beginTransaction();
            try{
                $checkA = DB::table('student')->where('sno',$sno)->update(['shetuan' => '0','status' => 0]);
                $checkB = DB::table('astrict')->where('shetuan',$stuResult['shetuan'])->where("class",session("class"))->decrement('count');

                if ($checkA && $checkB){
                    DB::commit();
                }else{
                    return -1;
                }
            }catch (Exception $e){
                Db::rollback();//捕捉异常后回滚事务
                return -1;
            }

        }

        $data = array([
            'id' => $shetuan,
            'sno' => $sno,
            'shetuan' => session('shetuan'),
            "class" => session("class")
        ]);
        reloadSession($sno);
        $job =  new trade($data);
        $job->dispatch($job);
        return 1;
//        while(true){
//            sleep(3);
//            $status = objectToArray(DB::table('student')->where('sno',$sno)->get(['status']))[0]['status'];
//
//            if($status != 0){
//                if ($status != 1 && $status != 2){
//
//                    DB::table('student')->where('sno',$sno)->update(['status' => 0]);
//
//                }elseif (session('shetuan') != '0'){
//                    if ($status == 2){
//                        DB::table('student')->where('sno',$sno)->update(['status' => 1]);
//                        return 1;
//                    }
//                }else{
//                    return 1;
//                }
//            }
//        }
    }

    public function getStatus()
    {
        $sno = session('sno');
        $status = objectToArray(DB::table('student')->where('sno',$sno)->get(['status']))[0]['status'];

        if ($status ==1 ){
            return 1;
        }else{
            session(['status' => 0]);
            DB::table('student')->where('sno',$sno)->update(['status' =>0]);
        }
        
        return $status;
        
    }
    public function output()
    {
        $objExcel=new PHPExcel();
        $objExcel->setActiveSheetIndex(0);
        $objSheet=$objExcel->getActiveSheet();
        $objSheet->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objSheet->getStyle("A1:E1")->getFont()->setName("华文中宋")->setSize(18)->setBold(True);
        $objSheet->getStyle("A2:E2")->getFont()->setName("华文中宋")->setSize(13);
        $objSheet->setCellValue("A1","旅管学院2019级社团报名信息汇总" )->mergeCells('A1:G1');
        $objSheet->setCellValue("A2","序号")->setCellValue("B2","班级")->setCellValue("C2","学号")->setCellValue("D2","姓名")->setCellValue("E2","社团");

        $objExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
        $objExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
        $objExcel->getActiveSheet()->getColumnDimension('C')->setWidth(21);
        $objExcel->getActiveSheet()->getColumnDimension('D')->setWidth(21);
        $objExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
        $result = objectToArray(DB::table('student')->orderBy('class')->orderBy('sno')->get());
        $pos = 2;
        for ($i = 0 ; $i < count($result) ; $i++) {
            $pos++;
            if ($result[$i]['shetuan'] == '0'){
                $result[$i]['shetuan'] ='未报名';
            }
            $objSheet->setCellValue("A".$pos,$i+1)->setCellValue("B".$pos,$result[$i]['class'])->setCellValue("C".$pos,$result[$i]['sno'])->setCellValue("D".$pos,$result[$i]['username'])->setCellValue("E".$pos,$result[$i]['shetuan']);

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
        $outputFileName = "旅管学院2019级社团报名信息汇总.xls";
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

}
