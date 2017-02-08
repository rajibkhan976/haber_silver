<?php

    Route::get('video-master', [
        'as' => 'admin.index.video.master',
        'uses' => 'VideoMasterController@index'
    ]);
    Route::any('store-video-master', [
            'as' => 'admin.store.video.master',
            'uses' => 'VideoMasterController@store_video_master'
        ]);    
    Route::any('view-video-master/{id}', [
        'as' => 'admin.view.video.master',
        'uses' => 'VideoMasterController@show'
    ]);
    Route::get('edit-video-master/{id}', [
        'as' => 'admin.edit.video.master',
        'uses' => 'VideoMasterController@edit'
    ]);
    Route::any('update-video-master/{id}', [
        'as' => 'admin.update.video.master',
        'uses' => 'VideoMasterController@update'
    ]);
    Route::get('delete-video-master/{id}', [
        'as' => 'admin.delete.video.master',
        'uses' => 'VideoMasterController@destroy'
    ]);
    Route::get('video-master-search', [
        'as' => 'admin.video.master.search',
        'uses' => 'VideoMasterController@search_video_master'
    ]);
    Route::any('show-video-master/{id}', [
        'as' => 'admin.show.video.master',
        'uses' => 'VideoMasterController@show_video'
    ]);
    ////////////end video master/////////////
    Route::get('company-user', [
        'as' => 'admin.index.company.user',
        'uses' => 'CompanyUserController@index'
    ]);
  /*  Route::any('store-company-user', [
            'as' => 'admin.store.company.user',
            'uses' => 'CompanyUserController@store_company_user'
        ]);    
    Route::any('view-company-user/{id}', [
        'as' => 'admin.view.company.user',
        'uses' => 'CompanyUserController@show'
    ]);
    Route::get('edit-company-user/{id}', [
        'as' => 'admin.edit.company.user',
        'uses' => 'CompanyUserController@edit'
    ]);
    Route::any('update-company-user/{id}', [
        'as' => 'admin.update.company.user',
        'uses' => 'CompanyUserController@update'
    ]);
    Route::get('delete-company-user/{id}', [
        'as' => 'admin.delete.video.master',
        'uses' => 'CompanyUserController@destroy'
    ]);*/
    Route::get('company-user-search', [
        'as' => 'admin.company.user.search',
        'uses' => 'CompanyUserController@search_company_user'
    ]);
     ////////////end company user/////////////

    Route::get('product-image', [
        'as' => 'admin.index.product.image',
        'uses' => 'ProductImageController@index'
    ]);
    Route::any('store-product-image', [
            'as' => 'admin.store.product.image',
            'uses' => 'ProductImageController@store_product_image'
        ]);    
    Route::any('view-product-image/{id}', [
        'as' => 'admin.view.product.image',
        'uses' => 'ProductImageController@show'
    ]);
    Route::get('edit-product-image/{id}', [
        'as' => 'admin.edit.product.image',
        'uses' => 'ProductImageController@edit'
    ]);
    Route::any('update-product-image/{id}', [
        'as' => 'admin.update.product.image',
        'uses' => 'ProductImageController@update'
    ]);
    Route::get('delete-product-image/{id}', [
        'as' => 'admin.delete.product.image',
        'uses' => 'ProductImageController@destroy'
    ]);
    Route::get('product-image-search', [
        'as' => 'admin.product.image.search',
        'uses' => 'ProductImageController@search_product_image'
    ]);  

    Route::any('view-product-image-details/{id}', [
        'as' => 'admin.view.product.image.details',
        'uses' => 'ProductImageController@show'
    ]);  

  /*  Route::get('edit-image-product-image/{id}', [
        'as' => 'admin.edit.image.product.image',
        'uses' => 'ProductImageController@edit_image'
    ]);
    Route::any('update-image-product-image/{id}', [
        'as' => 'admin.update.image.product.image',
        'uses' => 'ProductImageController@update_image'
    ]);*/

    ////////////end product image/////////////
    Route::get('product', [
        'as' => 'admin.index.product',
        'uses' => 'ProductController@index'
    ]);
    Route::post('store-product', [
            'as' => 'admin.store.product',
            'uses' => 'ProductController@store_product'
    ]);    
    Route::any('view-product/{id}', [
        'as' => 'admin.view.product',
        'uses' => 'ProductController@show'
    ]);
    Route::get('edit-product/{id}', [
        'as' => 'admin.edit.product',
        'uses' => 'ProductController@edit'
    ]);
    Route::any('update-product/{id}', [
        'as' => 'admin.update.product',
        'uses' => 'ProductController@update'
    ]);
    Route::get('delete-product/{id}', [
        'as' => 'admin.delete.product',
        'uses' => 'ProductController@destroy'
    ]);
    Route::get('product-search', [
        'as' => 'admin.product.search',
        'uses' => 'ProductController@search_product'
    ]);
    ////////////end product/////////////

    Route::get('menu-panel', [
        'as' => 'admin.index.menu.panel',
        'uses' => 'MenuPanelController@index'
    ]);

   


    
