<?php
/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 10/31/16
 * Time: 6:26 PM
 */


Route::get('admin', function () {
    #return view('welcome');
    return "Admin Module is working !";
});

/*Route::Group(['modules'=>'admin','namespace'=>'Modules\Admin\Controllers','middleware'=>'auth'],function() {
    Route::any('admin/central-settings', [
        'middleware' => 'acl_access::admin/central-settings',
        'as' => 'central-settings',
        'uses' => 'CentralSettingsController@index'
    ]);
});*/


Route::Group(['prefix'=>'admin', 'namespace'=>'Modules\Admin\Controllers', 'middleware' => 'web'],function() {

    /*
     * Admin Index
     */

    Route::any('dashboard', [
        'as' => 'admin/dashboard',
        'uses' => 'AdminController@index'
    ]);
      /*------------------------------------*/


    /*admin/company */
    Route::get('company', [
        'as' => 'admin.index.company',
        'uses' => 'CompanyController@index'        
    ]);

    Route::any('store-company', [
        'as' => 'admin.store.company',
        'uses' => 'CompanyController@store_company'
    ]);

    Route::any('view-company/{id}', [
        'as' => 'admin.view.company',
        'uses' => 'CompanyController@show'
    ]);
    Route::any('edit-company/{id}', [
        'as' => 'admin.edit.company',
        'uses' => 'CompanyController@edit'
    ]);
    Route::any('update-company/{id}', [
        'as' => 'admin.update.company',
        'uses' => 'CompanyController@update'
    ]);

    Route::get('delete-company/{id}', [
        'as' => 'admin.delete.company',
        'uses' => 'CompanyController@destroy'
    ]);
    Route::get('company-search', [
        'as' => 'admin.company.search',
        'uses' => 'CompanyController@search_company'
    ]);
    /*------------------------------------*/

     /*admin/company-product */
    Route::get('company-product', [
        'as' => 'admin.index.company_product',
        'uses' => 'CompanyProductController@index'        
    ]);

    Route::any('store-company-product', [
        'as' => 'admin.store.company_product',
        'uses' => 'CompanyProductController@store_company_product'
    ]);

    Route::any('view-company-product/{id}', [
        'as' => 'admin.view.company_product',
        'uses' => 'CompanyProductController@show'
    ]);
    Route::any('edit-company-product/{id}', [
        'as' => 'admin.edit.company_product',
        'uses' => 'CompanyProductController@edit'
    ]);
    Route::any('update-company-product/{id}', [
        'as' => 'admin.update.company_product',
        'uses' => 'CompanyProductController@update'
    ]);

    Route::get('delete-company-product/{id}', [
        'as' => 'admin.delete.company_product',
        'uses' => 'CompanyProductController@destroy'
    ]);
    Route::get('company-product-search', [
        'as' => 'admin.company_product.search',
        'uses' => 'CompanyProductController@search_company_product'
    ]);
    /*------------------------------------*/


    /*admin/customer */
    Route::get('customer', [
        'as' => 'admin.index.customer',
        'uses' => 'CustomerController@index'        
    ]);

    Route::any('store-customer', [
        'as' => 'admin.store.customer',
        'uses' => 'CustomerController@store_customer'
    ]);

    Route::any('view-customer/{id}', [
        'as' => 'admin.view.customer',
        'uses' => 'CustomerController@show'
    ]);
    Route::any('edit-customer/{id}', [
        'as' => 'admin.edit.customer',
        'uses' => 'CustomerController@edit'
    ]);
    Route::any('update-customer/{id}', [
        'as' => 'admin.update.customer',
        'uses' => 'CustomerController@update'
    ]);

    Route::get('delete-customer/{id}', [
        'as' => 'admin.delete.customer',
        'uses' => 'CustomerController@destroy'
    ]);
    Route::get('customer-search', [
        'as' => 'admin.customer.search',
        'uses' => 'CustomerController@search_customer'
    ]);
    /*------------------------------------*/

    /*admin/company-users */
    Route::get('company-users', [
        'as' => 'admin.index.company_users',
        'uses' => 'CompanyUserController@index'        
    ]);

    Route::any('view-company-users/{id}', [
        'as' => 'admin.view.company_users',
        'uses' => 'CompanyUserController@show'
    ]);
    /*------------------------------------*/


   /*  product_category */
    Route::get('product-category', [
        'as' => 'admin.index.product.category',
        'uses' => 'ProductCategoryController@index'
    ]);

    Route::any('store-product-category', [
        'as' => 'admin.store.product.category',
        'uses' => 'ProductCategoryController@store_product_category'
    ]);

    Route::any('view-product-category-details/{id}', [
        'as' => 'admin.view.product.category.details',
        'uses' => 'ProductCategoryController@show'
    ]);
    Route::any('edit-product-category/{id}', [
        'as' => 'admin.edit.product.category',
        'uses' => 'ProductCategoryController@edit'
    ]);
    Route::any('update-product-category/{id}', [
        'as' => 'admin.update.product.category',
        'uses' => 'ProductCategoryController@update'
    ]);

    Route::get('delete-product-category/{id}', [
        'as' => 'admin.delete.product.category',
        'uses' => 'ProductCategoryController@destroy'
    ]);
    Route::get('product-category-search', [
        'as' => 'admin.product.category.search',
        'uses' => 'ProductCategoryController@search_product_category'
    ]);
    /*------------------------------------*/

    include('anwar_route.php');
    include('iqbal_route.php');
    include('mizan_route.php');
    include('rajib_route.php');



    include('elastic_search_route.php');




});

