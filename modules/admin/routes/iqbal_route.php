<?php
/*  product_category */
Route::any('store-product-category-image', [
'as' => 'admin.store.product.category.image',
'uses' => 'ProductCategoryImageController@store_product_category_image'
]);

Route::any('edit-product-category-image/{id}', [
'as' => 'admin.edit.product.category.image',
'uses' => 'ProductCategoryImageController@edit'
]);
Route::any('update-product-category-image/{id}', [
'as' => 'admin.update.product.category.image',
'uses' => 'ProductCategoryImageController@update'
]);

Route::get('delete-product-category-image/{id}', [
'as' => 'admin.delete.product.category.image',
'uses' => 'ProductCategoryImageController@destroy'
]);
/*------------------------------------*/

/*  product_sub_category */
Route::get('product-sub-category', [
    'as' => 'admin.index.product.sub.category',
    'uses' => 'ProductSubCategoryController@index'
]);

Route::any('store-product-sub-category', [
    'as' => 'admin.store.product.sub.category',
    'uses' => 'ProductSubCategoryController@store_product_sub_category'
]);

Route::any('view-product-sub-category-details/{id}', [
    'as' => 'admin.view.product.sub.category.details',
    'uses' => 'ProductSubCategoryController@show'
]);
Route::any('edit-product-sub-category/{id}', [
    'as' => 'admin.edit.product.sub.category',
    'uses' => 'ProductSubCategoryController@edit'
]);
Route::any('update-product-sub-category/{id}', [
    'as' => 'admin.update.product.sub.category',
    'uses' => 'ProductSubCategoryController@update'
]);

Route::get('delete-product-sub-category/{id}', [
    'as' => 'admin.delete.product.sub.category',
    'uses' => 'ProductSubCategoryController@destroy'
]);
Route::get('product-sub-category-search', [
    'as' => 'admin.product.sub.category.search',
    'uses' => 'ProductSubCategoryController@search_product_sub_category'
]);
/*------------------------------------*/


/*  product_sub_category_image */
Route::any('store-product-sub-category-image', [
    'as' => 'admin.store.product.sub.category.image',
    'uses' => 'ProductSubCategoryImageController@store_product_sub_category_image'
]);

Route::any('edit-product-sub-category-image/{id}', [
    'as' => 'admin.edit.product.sub.category.image',
    'uses' => 'ProductSubCategoryImageController@edit'
]);
Route::any('update-product-sub-category-image/{id}', [
    'as' => 'admin.update.product.sub.category.image',
    'uses' => 'ProductSubCategoryImageController@update'
]);

Route::get('delete-product-sub-category-image/{id}', [
    'as' => 'admin.delete.product.sub.category.image',
    'uses' => 'ProductSubCategoryImageController@destroy'
]);
/*------------------------------------*/



/* menu_panel*/
Route::any('menu-panel', [
    'as' => 'admin.menu.panel',
    'uses' => 'MenuPanelController@index'
]);
Route::any('view-menu-panel/{id}', [
    'as' => 'admin.view.menu.panel',
    'uses' => 'MenuPanelController@show'
]);
Route::get('menu-panel-search', [
    'as' => 'admin.menu.panel.search',
    'uses' => 'MenuPanelController@search'
]);


Route::any('store-menu-panel', [
    'as' => 'admin.store.menu.panel',
    'uses' => 'MenuPanelController@store_menu_panel'
]);

Route::any('edit-menu-panel/{id}', [
    'as' => 'admin.edit.menu.panel',
    'uses' => 'MenuPanelController@edit'
]);
Route::any('update-menu-panel/{id}', [
    'as' => 'admin.update.menu.panel',
    'uses' => 'MenuPanelController@update'
]);



Route::get('delete-menu-panel/{id}', [
    'as' => 'admin.delete.menu.panel',
    'uses' => 'MenuPanelController@destroy'
]);
/*------------------------------------*/