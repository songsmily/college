<?php
/*
 * 公共函数,用于查询项目的编号及标题,用于班级管理员端的列表项显示
 */

use Illuminate\Support\Facades\DB;

function getItemsItemnoAndTittle($itempos, $classOption, $ispass){

    $itemsData10 = array();
    $itemsData20 = array();
    $itemsData30 = array();
    if ($itempos == "all"){
        $itemsData10 = objectToArray( DB::table('items')->where('itemno','like','10%')->get(['tittle','itemno']));
        $itemsData20 = objectToArray( DB::table('items')->where('itemno','like','20%')->get(['tittle','itemno']));
        $itemsData30 = objectToArray( DB::table('items')->where('itemno','like','30%')->get(['tittle','itemno']));


    }elseif ($itempos == "10"){
        $itemsData10 = objectToArray( DB::table('items')->where('itemno','like','10%')->get(['tittle','itemno']));

    }elseif ($itempos == "20"){
        $itemsData20 = objectToArray( DB::table('items')->where('itemno','like','20%')->get(['tittle','itemno']));

    }else{
        $itemsData30 = objectToArray( DB::table('items')->where('itemno','like','30%')->get(['tittle','itemno']));

    }
    for ($i = 0 ; $i <count($itemsData10) ; $i++){
        $count = DB::table("allData")->whereIn("class",$classOption)->where('itemno',$itemsData10[$i]['itemno'])->where("ispass",$ispass)->count();


        $itemsData10[$i]['count'] = $count;
    }
    for ($i = 0 ; $i <count($itemsData20) ; $i++){
        $count = DB::table("allData")->whereIn("class",$classOption)->where('itemno',$itemsData20[$i]['itemno'])->where("ispass",$ispass)->count();

        $itemsData20[$i]['count'] = $count;
    }
    for ($i = 0 ; $i <count($itemsData30) ; $i++){
        $count = DB::table("allData")->whereIn("class",$classOption)->where('itemno',$itemsData30[$i]['itemno'])->where("ispass",$ispass)->count();

        $itemsData30[$i]['count'] = $count;
    }
    if ($itemsData10){
        array_multisort(array_column($itemsData10,'count'),SORT_DESC,$itemsData10);

    }
    if ($itemsData20){
        array_multisort(array_column($itemsData20,'count'),SORT_DESC,$itemsData20);

    }
    if ($itemsData30){
        array_multisort(array_column($itemsData30,'count'),SORT_DESC,$itemsData30);

    }

    $result["itemsData10"] = $itemsData10;
    $result["itemsData20"] = $itemsData20;
    $result["itemsData30"] = $itemsData30;
    return $result;
}
function unicode_decode($name)
{
    // 转换编码，将Unicode编码转换成可以浏览的utf-8编码
    $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
    preg_match_all($pattern, $name, $matches);
    if (!empty($matches))
    {
        $name = '';
        for ($j = 0; $j < count($matches[0]); $j++)
        {
            $str = $matches[0][$j];
            if (strpos($str, '\\u') === 0)
            {
                $code = base_convert(substr($str, 2, 2), 16, 10);
                $code2 = base_convert(substr($str, 4), 16, 10);
                $c = chr($code).chr($code2);
                $c = iconv('UCS-2', 'UTF-8', $c);
                $name .= $c;
            }
            else
            {
                $name .= $str;
            }
        }
    }
    return $name;
}

/*
 * 公共函数 ,组装数据,用于班级管理员按班级和大项目查询的数据组装
 */
function compactDataForOptionalClassItem($resultData){
    for ($i = 0 ; $i < count($resultData) ; $i++){
        $tableName = objectToArray( DB::table("items")->where("itemno",$resultData[$i]['itemno'])->get(["tittle","desc","tablename"]) );

        $posttime = objectToArray(DB::table($tableName[0]['tablename'])->where("itemid",$resultData[$i]['itemid'])->get(["posttime"]));

        $username = objectToArray(DB::table('student')->where('sno',$resultData[$i]['sno'])->get(['username']));
        $resultData[$i]['username'] = $username[0]['username'];
        $resultData[$i]['posttime'] = $posttime[0]['posttime'];

        $resultData[$i] = array_merge($resultData[$i],$tableName[0]);
    }
    return $resultData;
}

/*
 * 获取三级平台的平均数据
 */
function getAvgVal($classOptional,$depart,$term){
    $schoolCount =  DB::table('score')->distinct()->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','10%')->count('class');
    $schoolCount = $schoolCount == 0 ? 1 : $schoolCount;
    $complexData['schoolItemCount10'] = DB::table('score')->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','10%')->count();
    $complexData['schoolScoreCount10'] = round( DB::table('score')->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','10%')->avg("score"),2);
    $complexData['schoolItemCount10'] = round( $complexData['schoolItemCount10'] / $schoolCount,2);
    $complexData['schoolScoreCount10'] = round( $complexData['schoolScoreCount10'] / $schoolCount,2);

    $schoolCount =  DB::table('score')->distinct()->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','10%')->count('class');
    $schoolCount = $schoolCount == 0 ? 1 : $schoolCount;
    $complexData['schoolItemCount20'] = DB::table('score')->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','20%')->count();
    $complexData['schoolScoreCount20'] = round( DB::table('score')->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','20%')->avg("score"),2);
    $complexData['schoolItemCount20'] = round( $complexData['schoolItemCount20'] / $schoolCount,2);
    $complexData['schoolScoreCount20'] = round( $complexData['schoolScoreCount20'] / $schoolCount,2);

    $schoolCount =  DB::table('score')->distinct()->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','30%')->count('class');
    $schoolCount = $schoolCount == 0 ? 1 : $schoolCount;
    $complexData['schoolItemCount30'] = DB::table('score')->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','30%')->count();
    $complexData['schoolScoreCount30'] = round( DB::table('score')->where('itemno','like','30%')->avg("score"),2);
    $complexData['schoolItemCount30'] = round( $complexData['schoolItemCount30'] / $schoolCount,2);
    $complexData['schoolScoreCount30'] = round( $complexData['schoolScoreCount30'] / $schoolCount,2);

    $departCount =  DB::table('score')->distinct()->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','10%')->where('depart',$depart)->count('class');
    $departCount = $departCount == 0 ? 1 : $departCount;

    $complexData['departItemCount10'] = DB::table('score')->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','10%')->where('depart',$depart)->count();
    $complexData['departScoreCount10'] = round( DB::table('score')->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','10%')->where('depart',$depart)->avg("score"),2);
    $complexData['departItemCount10'] = round( $complexData['departItemCount10'] / $departCount,2);
    $complexData['departScoreCount10'] = round( $complexData['departScoreCount10'] / $departCount,2);

    $departCount =  DB::table('score')->distinct()->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','20%')->where('depart',$depart)->count('class');
    $departCount = $departCount == 0 ? 1 : $departCount;
    $complexData['departItemCount20'] = DB::table('score')->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','20%')->where('depart',$depart)->count();
    $complexData['departScoreCount20'] = round( DB::table('score')->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','20%')->where('depart',$depart)->avg("score"),2);
    $complexData['departItemCount20'] = round( $complexData['departItemCount20'] / $departCount,2);
    $complexData['departScoreCount20'] = round( $complexData['departScoreCount20'] / $departCount,2);

    $departCount =  DB::table('score')->distinct()->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','30%')->where('depart',$depart)->count('class');
    $departCount = $departCount == 0 ? 1 : $departCount;
    $complexData['departItemCount30'] = DB::table('score')->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','30%')->where('depart',$depart)->count();
    $complexData['departScoreCount30'] = round( DB::table('score')->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','30%')->where('depart',$depart)->avg("score"),2);
    $complexData['departItemCount30'] = round( $complexData['departItemCount30'] / $departCount,2);
    $complexData['departScoreCount30'] = round( $complexData['departScoreCount30'] / $departCount,2);


    $complexData['classItemCount10'] = DB::table('score')->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','10%')->whereIn('class',$classOptional)->count();
    $complexData['classScoreCount10'] = round( DB::table('score')->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','10%')->whereIn('class',$classOptional)->avg("score"),2);
    $complexData['classItemCount20'] = DB::table('score')->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','20%')->where('class',$classOptional)->count();
    $complexData['classScoreCount20'] = round( DB::table('score')->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','20%')->whereIn('class',$classOptional)->avg("score"),2);
    $complexData['classItemCount30'] = DB::table('score')->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','30%')->where('class',$classOptional)->count();
    $complexData['classScoreCount30'] = round( DB::table('score')->whereBetween('posttime',[$term['begin'],$term['end']])->where('itemno','like','30%')->whereIn('class',$classOptional)->avg("score"),2);
    return $complexData;
}