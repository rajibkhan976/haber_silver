<?php 

/* Route of catalog*/ 

Route::get('catalog', [
        #'middleware' => 'acl_access:catalog',
        'as' => 'admin.catalog',
        'uses' => 'CatalogController@index'
    ]);

    Route::any('store-catalog', [
        #'middleware' => 'acl_access:store-catalog',
        'as' => 'admin.store.catalog',
        'uses' => 'CatalogController@store_catalog'
    ]);
    
    Route::any('view-catalog/{id}', [
        #'middleware' => 'acl_access:view-catalog/{slug}',
        'as' => 'admin.view.catalog',
        'uses' => 'CatalogController@show'
    ]);
    
    Route::any('edit-catalog/{id}', [
        #'middleware' => 'acl_access:edit-catalog/{slug}',
        'as' => 'admin.edit.catalog',
        'uses' => 'CatalogController@edit'
    ]);
    
    Route::any('update-catalog/{id}', [
        #'middleware' => 'acl_access:update-catalog/{slug}',
        'as' => 'admin.update.catalog',
        'uses' => 'CatalogController@update'
    ]);

    Route::get('delete-catalog/{id}', [
        #'middleware' => 'acl_access:delete-catalog/{slug}',
        'as' => 'admin.delete.catalog',
        'uses' => 'CatalogController@destroy'
    ]);
    
    Route::get('catalog-search', [
        #'middleware' => 'acl_access:catalog-search',
        'as' => 'admin.catalog.search',
        'uses' => 'CatalogController@search_catalog'
    ]);
    
    /* Route of settings */
    
    Route::get('setting', [
        #'middleware' => 'acl_access:user/role',
        'as' => 'admin.setting',
        'uses' => 'SettingController@index'
    ]);
    Route::any('store-setting', [
        #'middleware' => 'acl_access:user/store-role',
        'as' => 'admin.store.setting',
        'uses' => 'SettingController@store_setting'
    ]);
    Route::any('view-setting/{id}', [
        #'middleware' => 'acl_access:user/view-role/{slug}',
        'as' => 'admin.show.setting',
        'uses' => 'SettingController@show'
    ]);
    Route::any('edit-setting/{id}', [
        #'middleware' => 'acl_access:user/edit-role/{slug}',
        'as' => 'admin.edit.setting',
        'uses' => 'SettingController@edit'
    ]);
    Route::any('update-setting/{id}', [
        #'middleware' => 'acl_access:user/update-role/{slug}',
        'as' => 'admin.update.setting',
        'uses' => 'SettingController@update'
    ]);

    Route::get('delete-setting/{id}', [
        #'middleware' => 'acl_access:user/delete-role/{slug}',
        'as' => 'admin.delete.setting',
        'uses' => 'SettingController@destroy'
    ]);
    Route::get('setting-search', [
        #'middleware' => 'acl_access:user/role-search',
        'as' => 'admin.setting.search',
        'uses' => 'SettingController@search_setting'
    ]);