<?php
use Illuminate\Support\Facades\DB;
/*
 *公共函数,用于图片上传并返回图片名称字符串
*/



function uploadImgAndReturnFileNameString($files){

    $fileNameArray = array();
    $i = 0;
    foreach ($files as $file) {

        $newName = MD5($file->getClientOriginalName().time()).".".$file->extension();

        $file->move(base_path().'/uploads',$newName);

        $fileNameArray[$i] = $newName;

        $i++;

    }
    return $fileNameArray;
}
/*
 * 公共函数,用于插入数据失败后图片删除
 */
function deleteImgAfterFaileInsert($fileNameArray){
    foreach ($fileNameArray as $fileName){
        unlink(base_path()."/uploads/".$fileName);
    }
}
/*
 * 当用户提交单项数据时,向所有数据表插入一条记录
 */
function insertToAllData($data,$itemno){
    $postData["itemid"] = $data['itemid'];
    $postData["itemno"] = $itemno;
    $postData["sno"] = $data['sno'];
    $postData["posttime"] = $data['posttime'];
    $postData["ispass"] = $data['ispass'];
    $studentInfo =  objectToArray( DB::table('student')->where('sno',$data['sno'])->get(["class","depart"]));
    $postData = array_merge($postData,$studentInfo[0]);
//    $result = DB::table('allData')->insert($postData);
//    return 0;
    DB::beginTransaction();
    try{
        $result = DB::table('allData')->insert($postData);

        if ($result){
            Db::commit();
            return true;
        }
    } catch (\Exception $e) {
        Db::rollback();

        return false;
    }


}
/*
 * 用户固定格式上传数据的保存
 */
function add_post_public(\Illuminate\Http\Request $request,$table,$itemno){
    $files = $request->file();
    $fileNameArray = uploadImgAndReturnFileNameString($files['file']);
    $postData = $request->all();
    unset($postData['file']);
    unset($postData['itemid']);
    unset($postData['hisImg']);
    $itemid = MD5(rand(10,99).time());

    $postData['sno'] = session('sno');
    $postData['pic'] = implode("/",$fileNameArray);
    $postData['itemid'] = $itemid;
    $postData['ispass'] = 'no';
    $postData['posttime'] = date('Y-m-d');
//    $result = DB::table($table)->insert($postData);
//    return 0;
    DB::beginTransaction();
    try{
        $result = DB::table($table)->insert($postData);

        if ($result && insertToAllData($postData,$itemno) ){
            Db::commit();
            return 1;
        }
    } catch (\Exception $e) {
        Db::rollback();
        deleteImgAfterFaileInsert($fileNameArray);
        return 0;
    }
}
/*
 * 用户固定格式并带有历史图片数据的数据的保存
 */
function add_post_public_withHisImg(\Illuminate\Http\Request $request,$table,$itemno){
    $files = $request->file();//获取所有新上传文件
    $hisImg = $request->get('hisImg');//获取base64历史图片
    $hisImg =  base64StrToArray($hisImg);//转换为数组格式
    $hisImgFileNameArray = array();//历史文件名数组
    /*
     * base64存储并获得文件名
     */
    foreach ($hisImg as $item) {
        $imgFileName =  base64_image_save($item,'uploads/');
        array_push($hisImgFileNameArray,$imgFileName);
    }
    $fileNameArray = array();//新文件名数组
    if ($files){
        $fileNameArray = uploadImgAndReturnFileNameString($files['file']);//保存新图片并返回文件名
    }
    $fileNameArray =  array_merge($hisImgFileNameArray,$fileNameArray);//组合历史文件名和新文件名
    $postData = $request->all();//获取提交数据
    unset($postData['hisImg']);//去除历史图片数据
    if ($files){
        unset($postData['file']);//如果存在新文件,删除
    }
    $itemid = MD5(rand(10,99).time());//创建itemID
    $hisitemid = $postData['itemid'];//获取历史itemid
    $hisData = objectToArray( DB::table($table)->where('itemid',$hisitemid)->get('pic'));//查询历史数据
    unset($postData['itemid']);//去除提交数据中的itemID
    /*
     * 组装数据
     */
    $postData['sno'] = session('sno');
    $postData['pic'] =  implode("/",$fileNameArray);
    $postData['itemid'] = $itemid;
    $postData['ispass'] = 'no';
    $postData['posttime'] = date('Y-m-d');

    DB::beginTransaction();
    try{
        $result = DB::table($table)->insert($postData);//插入新的数据
        $result1 = DB::table($table)->where('itemid',$hisitemid)->delete();//删除历史数据
        $result2 = DB::table("allData")->where('itemid',$hisitemid)->delete();//删除alldata数据表中的历史数据
        if ($result && $result1 && $result2 && insertToAllData($postData,$itemno) ){//判断所有数据是否插入成功
            Db::commit();//插入成功后提交事务
            $hisPicArrray = explode("/",$hisData[0]['pic']);//得到历史图片名
            deleteImgAfterFaileInsert($hisPicArrray);//删除所有历史图片
            return 1;
        }
    } catch (\Exception $e) {
        Db::rollback();//捕捉异常后回滚事务
        deleteImgAfterFaileInsert($fileNameArray);//事务回滚后删除已保存的图片文件
        return 0;
    }
}
/*
@desc：获取图片真实后缀
@param   name    文件名
@return  suffix  文件后缀
*/
function getimgsuffix($name) {
    $info = getimagesize($name);
    $suffix = false;
    if($mime = $info['mime']){
        $suffix = explode('/',$mime)[1];
    }
    return $suffix;
}

/*
 * 将Base64图片转换为本地图片并保存
 * @param  $base64_image_content 要保存的Base64
 * @param  $path 要保存的路径
 */
function base64_image_save($base64_image_content,$path){
    //匹配出图片的格式
    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
        //后缀
        $type = $result[2];
        //创建文件夹，以年月日
        $new_file = $path;
        if(!file_exists($new_file)){
            //检查是否有该文件夹，如果没有就创建，并给予最高权限
            mkdir($new_file, 0700);
        }
        $fileName = md5(rand(1,100).time()).".{$type}";
        $new_file = $new_file.$fileName;	//图片名以时间命名
        //保存为文件
        if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
            //返回这个图片的路径
            return $fileName;
        }else{
            return null;
        }
    }else{
        return null;
    }
}
/*
 * 将base64历史图片数据拆分成数组,重新提交
 */
function base64StrToArray($baseStr){
    $baseArray =explode("data",$baseStr);
    unset($baseArray[0]);
    for ($i = 1 ; $i <= count($baseArray) ; $i++){
        $baseArray[$i] ="data" . $baseArray[$i];
    }
    return $baseArray;
}