<?php


Route::any('/', "SiteController@index");
Route::any('login', "Login\LoginController@index");
Route::get('showImage/{src}', "Index\WaitController@showImage");
Route::post('login/validateUser', "Login\LoginController@validateUser");

/*
 * 班级管理端路由
 */
Route::group(['middleware' => ['web','admin.login']], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('index', "Admin\IndexController@index"); //学生端主页
        Route::get('logout', "Admin\IndexController@logout"); //学生端主页
        Route::get('index/allaItemWithClass/{classVal}/{itemVal}', "Admin\IndexController@allaItemWithClass");
        Route::get('index/allaOptionalItemWithClass/{classVal}/{itemVal}/{optionalItem}', "Admin\IndexController@allaOptionalItemWithClass");
        Route::get('index/showAndDoPric/{itemid}/{itemno}/{tablename}', "Admin\IndexController@showAndDoPric");
        Route::post('index/postPass', "Admin\IndexController@postPass");

    });
});
/*
 * 学生端路由
 */
/*
 * 学生登陆状态验证
 */
Route::group(['middleware' => ['web','student.login']], function () {

    Route::get('index', "Index\IndexController@index"); //学生端主页
    Route::get('index/logout', "Index\IndexController@logout"); //学生端主页
    Route::group(['prefix' => 'index/Wait'], function () {
        Route::get('index', "Index\WaitController@index");
        Route::get('index_grid', "Index\WaitController@index_grid");
        Route::get('showContent/{itemid}/{itemno}/{tablename}', "Index\WaitController@showContent");

    });
    /*
     * 文体综合路由
    */
    Route::group(['prefix' => 'index/CompareAdd'], function () {

        /*
         * 数据提交处理路由
         */
        Route::post('compare_add_ysbs', "Index\CompareAddController@compare_add_ysbs");
        Route::post('compare_add_stbs', "Index\CompareAddController@compare_add_stbs");
        Route::post('compare_add_tyjs', "Index\CompareAddController@compare_add_tyjs");
        Route::post('compare_add_dopric', "Index\CompareAddController@compare_add_dopric");
        Route::post('compare_add_other', "Index\CompareAddController@compare_add_other");


        Route::get('compare_add_item', function (){
            return view("Index.compare_add.compare_add_item");
        });
        Route::get('compare_warning', function (){
            return view("Index.compare_add.compare_warning");
        });
        Route::get('compare_warning1', function (){
            return view("Index.compare_add.compare_warning1");
        });
        Route::get('compare_add', function (){
            return view("Index.compare_add.compare_add");
        });
        Route::get('compare_add1', function (){
            return view("Index.compare_add.compare_add1");
        });
        Route::get('compare_add2', function (){
            return view("Index.compare_add.compare_add2");
        });
        Route::get('compare_add3', function (){
            return view("Index.compare_add.compare_add3");
        });
        Route::get('compare_add4', function (){
            return view("Index.compare_add.compare_add4");
        });
        Route::get('compare_warning', function (){
            return view("Index.compare_add.compare_warning");
        });
    });
    /*
     * 品德行为表现路由
    */
    Route::group(['prefix' => 'index/AttrAdd'], function () {
        /*
         * 处理数据提交请求路由
         */
        Route::post('attr_add_shfw', "Index\AttrAddController@attr_add_shfw");
        Route::post('attr_add_xjjt', "Index\AttrAddController@attr_add_xjjt");
        Route::post('attr_add_wmqs', "Index\AttrAddController@attr_add_wmqs");
        Route::post('attr_add_xjwmqs', "Index\AttrAddController@attr_add_xjwmqs");
        Route::post('attr_add_hsz', "Index\AttrAddController@attr_add_hsz");
        Route::post('attr_add_qyby', "Index\AttrAddController@attr_add_qyby");
        Route::post('attr_add_shxs', "Index\AttrAddController@attr_add_shxs");
        Route::post('attr_add_xjgr', "Index\AttrAddController@attr_add_xjgr");
        Route::post('attr_add_jthd', "Index\AttrAddController@attr_add_jthd");
        Route::post('attr_add_zyfw', "Index\AttrAddController@attr_add_zyfw");
        Route::post('attr_add_gfzyfw', "Index\AttrAddController@attr_add_gfzyfw");
        Route::post('attr_add_ganbu', "Index\AttrAddController@attr_add_ganbu");
        Route::post('attr_add_other', "Index\AttrAddController@attr_add_other");


        Route::get('attr_add_item', function (){
            return view("Index.attr_add.attr_add_item");
        });
        Route::get('attr_warning', function (){
            return view("Index.attr_add.attr_warning");
        });
        Route::get('attr_warning1', function (){
            return view("Index.attr_add.attr_warning1");
        });
        Route::get('attr_add', function (){
            return view("Index.attr_add.attr_add");
        });
        Route::get('attr_add1', function (){
            return view("Index.attr_add.attr_add1");
        });
        Route::get('attr_add2', function (){
            return view("Index.attr_add.attr_add2");
        });
        Route::get('attr_add3', function (){
            return view("Index.attr_add.attr_add3");
        });
        Route::get('attr_add4', function (){
            return view("Index.attr_add.attr_add4");
        });
        Route::get('attr_add5', function (){
            return view("Index.attr_add.attr_add5");
        });
        Route::get('attr_add6', function (){
            return view("Index.attr_add.attr_add6");
        });
        Route::get('attr_add7', function (){
            return view("Index.attr_add.attr_add7");
        });
        Route::get('attr_add8', function (){
            return view("Index.attr_add.attr_add8");
        });
        Route::get('attr_add9', function (){
            return view("Index.attr_add.attr_add9");
        });
        Route::get('attr_add10', function (){
            return view("Index.attr_add.attr_add10");
        });
        Route::get('attr_add11', function (){
            return view("Index.attr_add.attr_add11");
        });
        Route::get('attr_add12', function (){
            return view("Index.attr_add.attr_add12");
        });
        Route::get('attr_add13', function (){
            return view("Index.attr_add.attr_add13");
        });
    });
    /*
     *  学业表现路由
     */
    Route::group(['prefix' => 'index/StudyAdd'], function () {
        /*
         * 处理数据提交请求路由
         */
        Route::post('study_add_xslwOrxszz', "Index\StudyAddController@study_add_xslwOrxszz");
        Route::post('study_add_fbzp', "Index\StudyAddController@study_add_fbzp");
        Route::post('study_add_kylx', "Index\StudyAddController@study_add_kylx");
        Route::post('study_add_fmzl', "Index\StudyAddController@study_add_fmzl");
        Route::post('study_add_jnjs', "Index\StudyAddController@study_add_jnjs");
        Route::post('study_add_etc', "Index\StudyAddController@study_add_etc");
        Route::post('study_add_tem', "Index\StudyAddController@study_add_tem");
        Route::post('study_add_pretco', "Index\StudyAddController@study_add_pretco");
        Route::post('study_add_ncre', "Index\StudyAddController@study_add_ncre");
        Route::post('study_add_shufa', "Index\StudyAddController@study_add_shufa");
        Route::post('study_add_jnzs', "Index\StudyAddController@study_add_jnzs");
        Route::post('study_add_other', "Index\StudyAddController@study_add_other");
        /*
         * 返回页面视图
         */
        Route::get('study_add_item', function (){
            return view("Index.study_add.study_add_item");
        });
        Route::get('study_add', function (){
            return view("Index.study_add.study_add");
        });
        Route::get('study_add1', function (){
            return view("Index.study_add.study_add1");
        });
        Route::get('study_add2', function (){
            return view("Index.study_add.study_add2");
        });
        Route::get('study_add3', function (){
            return view("Index.study_add.study_add3");
        });
        Route::get('study_add4', function (){
            return view("Index.study_add.study_add4");
        });
        Route::get('study_add5', function (){
            return view("Index.study_add.study_add5");
        });
        Route::get('study_add6', function (){
            return view("Index.study_add.study_add6");
        });
        Route::get('study_add7', function (){
            return view("Index.study_add.study_add7");
        });
        Route::get('study_add8', function (){
            return view("Index.study_add.study_add8");
        });
        Route::get('study_add9', function (){
            return view("Index.study_add.study_add9");
        });
        Route::get('study_add10', function (){
            return view("Index.study_add.study_add10");
        });
        Route::get('study_add11', function (){
            return view("Index.study_add.study_add11");
        });
        Route::get('study_add12', function (){
            return view("Index.study_add.study_add12");
        });
        Route::get('study_add13', function (){
            return view("Index.study_add.study_add13");
        });
        Route::get('study_warning', function (){
            return view("Index.study_add.study_warning");
        });
    });
});
Route::any('configs', function(){
    return view("Attribute.index");
});




