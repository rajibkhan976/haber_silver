<?php
/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 10/31/16
 * Time: 6:26 PM
 */


Route::get('web', function () {
    #return view('welcome');
    return "Web Module is working !";
});


Route::Group(['namespace'=>'Modules\Web\Controllers'],function() {

    /*
     * Web Index
     */
    Route::any('web/index', [
        'as' => 'web/index',
        'uses' => 'WebController@index'
    ]);


    //demo

    Route::any('web/html', [
        'as' => 'web.html',
        'uses' => 'WebController@web_home_page'
    ]);
    Route::any('web/html/category', [
        'as' => 'web.html.category',
        'uses' => 'WebController@web_category_list'
    ]);
    Route::any('web/html/products', [
        'as' => 'web.html.products',
        'uses' => 'WebController@web_product_list'
    ]);
    Route::any('web/html/products/detail', [
        'as' => 'web.html.products.detail',
        'uses' => 'WebController@web_product_detail'
    ]);




});
