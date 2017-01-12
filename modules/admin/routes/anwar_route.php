<?php

/*Image-slider */

Route::get('image-slider', [
//        'middleware' => 'acl_access:image-slider',
    'as' => 'admin.image.slider',
    'uses' => 'ImageSliderController@index'
]);
Route::any('store-image-slider', [
//        'middleware' => 'acl_access:admin/image-slider',
    'as' => 'admin.store.image.slider',
    'uses' => 'ImageSliderController@store_image_slider'
]);
Route::any('view-image-slider/{slug}', [
//        'middleware' => 'acl_access:admin/image-slider/{slug}',
    'as' => 'admin.view.image.slider',
    'uses' => 'ImageSliderController@show'
]);
Route::any('edit-image-slider/{slug}', [
//        'middleware' => 'acl_access:admin/edit-image-slider/{slug}',
    'as' => 'admin.edit.image.slider',
    'uses' => 'ImageSliderController@edit'
]);
Route::any('update-image-slider/{slug}', [
//        'middleware' => 'acl_access:admin/update-image-slider/{slug}',
    'as' => 'admin.update.image.slider',
    'uses' => 'ImageSliderController@update'
]);

Route::get('delete-image-slider/{slug}', [
//        'middleware' => 'acl_access:admin/delete-image-slider/{slug}',
    'as' => 'admin.delete.image.slider',
    'uses' => 'ImageSliderController@destroy'
]);
Route::get('image-slider-search', [
//        'middleware' => 'acl_access:admin/image-slider-search',
    'as' => 'admin.image.slider.search',
    'uses' => 'ImageSliderController@search_image_slider'
]);


/* Reconditioning */

Route::get('reconditioning', [
//        'middleware' => 'acl_access:reconditioning',
    'as' => 'admin.reconditioning',
    'uses' => 'ReconditioningController@index'
]);
Route::any('store-reconditioning', [
//        'middleware' => 'acl_access:admin/reconditioning',
    'as' => 'admin.store.reconditioning',
    'uses' => 'ReconditioningController@store_reconditioning'
]);
Route::any('view-reconditioning/{slug}', [
//        'middleware' => 'acl_access:admin/reconditioning/{slug}',
    'as' => 'admin.view.reconditioning',
    'uses' => 'ReconditioningController@show'
]);
Route::any('edit-reconditioning/{slug}', [
//        'middleware' => 'acl_access:admin/reconditioning/{slug}',
    'as' => 'admin.edit.reconditioning',
    'uses' => 'ReconditioningController@edit'
]);
Route::any('update-reconditioning/{slug}', [
//        'middleware' => 'acl_access:admin/update-reconditioning/{slug}',
    'as' => 'admin.update.reconditioning',
    'uses' => 'ReconditioningController@update'
]);

Route::get('delete-reconditioning/{slug}', [
//        'middleware' => 'acl_access:admin/delete-reconditioning/{slug}',
    'as' => 'admin.delete.reconditioning',
    'uses' => 'ReconditioningController@destroy'
]);
Route::get('reconditioning-search', [
//        'middleware' => 'acl_access:admin/reconditioning-search',
    'as' => 'admin.reconditioning.search',
    'uses' => 'ReconditioningController@search_reconditioning'
]);



/* Trade Show */

Route::get('trade-show', [
//        'middleware' => 'acl_access:trade-show',
    'as' => 'admin.trade.show',
    'uses' => 'TradeShowController@index'
]);
Route::any('store-trade-show', [
//        'middleware' => 'acl_access:admin/trade-show',
    'as' => 'admin.store.trade.show',
    'uses' => 'TradeShowController@store_trade_show'
]);
Route::any('view-trade-show/{slug}', [
//        'middleware' => 'acl_access:admin/trade-show/{slug}',
    'as' => 'admin.view.trade.show',
    'uses' => 'TradeShowController@show'
]);
Route::any('edit-trade-show/{slug}', [
//        'middleware' => 'acl_access:admin/trade-show/{slug}',
    'as' => 'admin.edit.trade.show',
    'uses' => 'TradeShowController@edit'
]);
Route::any('update-trade-show/{slug}', [
//        'middleware' => 'acl_access:admin/update-trade-show/{slug}',
    'as' => 'admin.update.trade.show',
    'uses' => 'TradeShowController@update'
]);

Route::get('delete-trade-show/{slug}', [
//        'middleware' => 'acl_access:admin/delete-trade-show/{slug}',
    'as' => 'admin.delete.trade.show',
    'uses' => 'TradeShowController@destroy'
]);
Route::get('trade-show-search', [
//        'middleware' => 'acl_access:admin/trade-show-search',
    'as' => 'admin.trade.show.search',
    'uses' => 'TradeShowController@search_trade_show'
]);



/* Page Content */

Route::get('page-content', [
//        'middleware' => 'acl_access:page-content',
    'as' => 'admin.page.content',
    'uses' => 'PageContentController@index'
]);
Route::any('store-page-content', [
//        'middleware' => 'acl_access:admin/page-content',
    'as' => 'admin.store.page.content',
    'uses' => 'PageContentController@store_page_content'
]);
Route::any('view-page-content/{slug}', [
//        'middleware' => 'acl_access:admin/page-content/{slug}',
    'as' => 'admin.view.page.content',
    'uses' => 'PageContentController@show'
]);
Route::any('edit-page-content/{slug}', [
//        'middleware' => 'acl_access:admin/page-content/{slug}',
    'as' => 'admin.edit.page.content',
    'uses' => 'PageContentController@edit'
]);
Route::any('update-page-content/{slug}', [
//        'middleware' => 'acl_access:admin/update-page-content/{slug}',
    'as' => 'admin.update.page.content',
    'uses' => 'PageContentController@update'
]);

Route::get('delete-page-content/{slug}', [
//        'middleware' => 'acl_access:admin/delete-page-content/{slug}',
    'as' => 'admin.delete.page.content',
    'uses' => 'PageContentController@destroy'
]);
Route::get('page-content-search', [
//        'middleware' => 'acl_access:admin/reconditioning-search',
    'as' => 'admin.page.content.search',
    'uses' => 'PageContentController@search_page_content'
]);