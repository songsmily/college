<?php




Route::get('index', "IndexController@index");
Route::post('index', "IndexController@postIndex");
Route::post('login/logout', "Login\LoginController@logout");

Route::get('/', "IndexController@login");
Route::get('regist', "IndexController@regist");
Route::post('doregist', "IndexController@doRegist");
Route::post('login/doLogin', "Login\LoginController@doLogin");
Route::post('login/adminLogin', "Login\LoginController@adminLogin");
Route::any("validateSession",function (){
   Session()->flush();
});
Route::any('session',function(){
    dump(session('username'));
    dump(session('count'));
    dump(session('admin'));
});
Route::post('admin/logout', "AdminController@logout");


/*
 * 班级管理端路由
 */
Route::group(['middleware' => ['web','StudentLogin']], function () {
    Route::post('loadContent', "IndexController@loadContent");
    Route::post('loadNewContent', "IndexController@loadNewContent");
    Route::post('doAnswer', "IndexController@doAnswer");
    Route::any('index', "IndexController@index");

});
Route::group(['middleware' => ['web',"AdminLogin"]], function () {
    Route::get('admin', "AdminController@admin");
    Route::post('admin/changeQues', "AdminController@changeQues");
    Route::get('admin/outScore', "AdminController@outScore");
    Route::get('admin/outTimes', "AdminController@outTimes");

});


