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
    'uses' => 'ProductSubCategoryController@search_product_category'
]);
/*------------------------------------*/


/*  product_sub_category_image */
Route::any('store-product-sub-category-image', [
    'as' => 'admin.store.product.sub.category.image',
    'uses' => 'ProductSubCategoryImageController@store_product_category_image'
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