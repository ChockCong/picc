<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::any('test', 'Test\TestController@test');
//    Route::any('login', 'LoginController@login');
//    Route::any('check', 'LoginController@check');
Route::group(['middleware'=>['web']],function (){
    //登陆
    Route::any('login', 'LoginController@login');
    Route::any('loginout', 'LoginoutController@loginout');
    Route::any('check', 'LoginController@check');
    //经营单位
    Route::any('jydwmain', 'Pz\JydwController@main');
    Route::any('logo', 'Pz\JydwController@logo');
    Route::any('jydw', 'Pz\JydwController@show');
    Route::any('jydwsearchall', 'Pz\JydwController@searchall');
    Route::any('jinfo', 'Pz\JydwController@info');
    Route::any('refer', 'Pz\JydwController@refer');
    Route::any('consearch', 'Pz\JydwController@consearch');
    Route::any('detail/{order}','Pz\JydwController@detail');
    Route::any('rejected','Pz\JydwController@rejected');
    Route::any('rejectedetails/{order}','Pz\JydwController@rejectedetails');
    Route::any('alterject','Pz\JydwController@alterject');
    Route::any('downloadfile/{filename}/{name}','Pz\JydwController@downloadfile');
    //经营单位经理室
    Route::any('jydwjlsmain','Pz\JydwjlsController@main');
    Route::any('jydwjlssearchx','Pz\JydwjlsController@searchx');
    Route::any('jydwjlssearchy','Pz\JydwjlsController@searchy');
    Route::any('jydwjlsdetailx/{order}','Pz\JydwjlsController@detailx');
    Route::any('jydwjlsdetaily/{order}','Pz\JydwjlsController@detaily');
    Route::any('jydwjlsconsearch','Pz\JydwjlsController@consearch');
    Route::any('jydwjlsconsearched','Pz\JydwjlsController@consearched');
    Route::any('jydwjlspass','Pz\JydwjlsController@pass');
    Route::any('jydwjlsrejected','Pz\JydwjlsController@rejected');
    Route::any('jydwjlsrejectedetails/{order}','Pz\JydwjlsController@rejectedtails');
    Route::any('jydwjlsalterrejected','Pz\JydwjlsController@alterrejected');
    //销售部综合岗
    Route::any('xsbmain','Pz\XsbController@main');
    Route::any('xsbsearchx','Pz\XsbController@searchx');
    Route::any('xsbsearchy','Pz\XsbController@searchy');
    Route::any('xsbconsearch','Pz\XsbController@consearch');
    Route::any('xsbconsearched','Pz\XsbController@consearched');
    Route::any('xsbdetailx/{order}','Pz\XsbController@detailx');
    Route::any('xsbdetaily/{order}','Pz\XsbController@detaily');
    Route::any('xsbpass','Pz\XsbController@pass');
    Route::any('xsbrejected','Pz\XsbController@rejected');
    Route::any('xsbrejectedetails/{order}','Pz\XsbController@rejectedtails');
    Route::any('xsbalterrejected','Pz\XsbController@alterrejected');
    //车险部经理
    Route::any('cxbjlmain','Pz\CxbjlController@main');
    Route::any('cxbjlsearchx','Pz\CxbjlController@searchx');
    Route::any('cxbjlsearchy','Pz\CxbjlController@searchy');
    Route::any('cxbjlconsearch','Pz\CxbjlController@consearch');
    Route::any('cxbjlconsearched','Pz\CxbjlController@consearched');
    Route::any('cxbjldetailx/{order}','Pz\CxbjlController@detailx');
    Route::any('cxbjldetaily/{order}','Pz\CxbjlController@detaily');
    Route::any('cxbjlpass','Pz\CxbjlController@pass');
    Route::any('cxbjlrejected','Pz\CxbjlController@rejected');
    Route::any('cxbjlrejectedetails/{order}','Pz\CxbjlController@rejectedtails');
    Route::any('cxbjlalterrejected','Pz\CxbjlController@alterrejected');

    //财务中心主任
    Route::any('cwzxzrmain','Pz\CwzxzrController@main');
    Route::any('cwzxzrsearchx','Pz\CwzxzrController@searchx');
    Route::any('cwzxzrdetailx/{order}','Pz\CwzxzrController@detailx');
    Route::any('cwzxzrsearchy','Pz\CwzxzrController@searchy');
    Route::any('cwzxzrdetaily/{order}','Pz\CwzxzrController@detaily');
    Route::any('cwzxzrrejected','Pz\CwzxzrController@rejected');
    Route::any('cwzxzrrejectedetails/{order}','Pz\CwzxzrController@rejectedtails');
    Route::any('cwzxzrconsearch','Pz\CwzxzrController@consearch');
    Route::any('cwzxzrconsearched','Pz\CwzxzrController@consearched');
    Route::any('cwzxzrpass','Pz\CwzxzrController@pass');
    Route::any('cwzxzralterrejected','Pz\CwzxzrController@alterrejected');



    //分管副总经理
    Route::any('fgfzjlmain','Pz\FgfzjlController@main');
    Route::any('fgfzjlsearchx','Pz\FgfzjlController@searchx');
    Route::any('fgfzjldetailx/{order}','Pz\FgfzjlController@detailx');
    Route::any('fgfzjlsearchy','Pz\FgfzjlController@searchy');
    Route::any('fgfzjldetaily/{order}','Pz\FgfzjlController@detaily');
    Route::any('fgfzjlrejected','Pz\FgfzjlController@rejected');
    Route::any('fgfzjlrejectedetails/{order}','Pz\FgfzjlController@rejectedtails');
    Route::any('fgfzjlconsearch','Pz\FgfzjlController@consearch');
    Route::any('fgfzjlconsearched','Pz\FgfzjlController@consearched');
    Route::any('fgfzjlpass','Pz\FgfzjlController@pass');
    Route::any('fgfzjlalterrejected','Pz\FgfzjlController@alterrejected');
    //总经理
    Route::any('zjlmain','Pz\ZjlController@main');
    Route::any('zjlsearchx','Pz\ZjlController@searchx');
    Route::any('zjlsearchy','Pz\ZjlController@searchy');
    Route::any('zjlconsearch','Pz\ZjlController@consearch');
    Route::any('zjldetailx/{order}','Pz\ZjlController@detailx');
    Route::any('zjlconsearched','Pz\ZjlController@consearched');
    Route::any('zjldetaily/{order}','Pz\ZjlController@detaily');
    Route::any('zjlpass','Pz\ZjlController@pass');
});