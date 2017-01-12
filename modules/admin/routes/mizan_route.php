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
