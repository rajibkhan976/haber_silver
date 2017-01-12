<?php
/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 10/31/16
 * Time: 6:26 PM
 */



    Route::get('user', function () {
        #return view('welcome');
        return "User Management Module is working !";
    });



    /*------------------------------------*/
    /*
     * User Reset Password
     */
    Route::get('user/form-reset-password', [
        'as' => 'user.form.reset.password',
        'uses' => 'UserController@reset_password_form'
    ]);
    Route::post('user/reset-password', [
        'as' => 'user.reset.password',
        'uses' => '\App\Http\Controllers\Auth\ForgotPasswordController@reset_password'
    ]);
    Route::get('user/update-reset-password/{token}', [
        'as' => 'user.update.reset.password',
        'uses' => '\App\Http\Controllers\Auth\ForgotPasswordController@update_reset_password'
    ]);
    Route::post('user/set-new-password}', [
        'as' => 'user.set.new.password',
        'uses' => '\App\Http\Controllers\Auth\ForgotPasswordController@set_new_password'
    ]);




/*------------*/
// middleware
Route::Group(['namespace'=>'Modules\User\Controllers', 'middleware' => 'web'],function() {

    /*------------------------------------*/
    /*
    * Users
    */
    Route::get('user/lists', [
        'middleware' => 'acl_access:user/lists',
        'as' => 'user.lists',
        'uses' => 'UserController@index'
    ]);

    Route::get('user/site-user-list', [
        'middleware' => 'acl_access:user/site-user-list',
        'as' => 'user.site.user',
        'uses' => 'UserController@index_site_user'
    ]);
    Route::get('user/cms-user-list', [
        'middleware' => 'acl_access:user/cms-user-list',
        'as' => 'user.cms.user',
        'uses' => 'UserController@index_cms_user'
    ]);

    Route::post('user/store', [
        'middleware' => 'acl_access:user/store',
        'as' => 'user.store',
        'uses' => 'UserController@store_user'
    ]);
    Route::get('user/search', [
        'middleware' => 'acl_access:user/search',
        'as' => 'user.search',
        'uses' => 'UserController@search_user'
    ]);
    Route::get('user/show/{id}', [
        'middleware' => 'acl_access:user/show/{id}',
        'as' => 'user.show',
        'uses' => 'UserController@show_user'
    ]);
    Route::get('user/edit/{id}', [
        'middleware' => 'acl_access:user/edit/{id}',
        'as' => 'user.edit',
        'uses' => 'UserController@edit_user'
    ]);
    Route::any('user/update/{id}', [
        'middleware' => 'acl_access:user/update/{id}',
        'as' => 'user.update',
        'uses' => 'UserController@update_user'
    ]);
    Route::get('user/delete/{id}', [
        'middleware' => 'acl_access:user/delete/{id}',
        'as' => 'user.delete',
        'uses' => 'UserController@destroy_user'
    ]);
    Route::get('user/profile', [
        'middleware' => 'acl_access:user/profile',
        'as' => 'user.profile',
        'uses' => 'UserController@user_profile'
    ]);
    Route::post('user/profile/image', [
        'middleware' => 'acl_access:user/profile/image',
        'as' => 'user.profile.image',
        'uses' => 'UserController@post_profile_image'
    ]);
    Route::get('user/profile/edit', [
        'middleware' => 'acl_access:user/profile/edit',
        'as' => 'user.profile.edit',
        'uses' => 'UserController@edit_profile_per_user'
    ]);
    Route::any('user/profile/update', [
        'middleware' => 'acl_access:user/profile/update',
        'as' => 'user.profile.update',
        'uses' => 'UserController@update_profile_per_user'
    ]);


    /*------------------------------------*/
    /*
     * User Logout
     */
    Route::any('user/logout', [
        'middleware' => 'acl_access:user/logout',
        'as' => 'user.logout',
        'uses' => 'UserController@user_logout'
    ]);


    /*------------------------------------*/
    /*Role */
    Route::get('user/role', [
        'middleware' => 'acl_access:user/role',
        'as' => 'user.role',
        'uses' => 'RoleController@index'
    ]);
    Route::any('user/store-role', [
        'middleware' => 'acl_access:user/store-role',
        'as' => 'user.store.role',
        'uses' => 'RoleController@store_role'
    ]);
    Route::any('user/view-role/{slug}', [
        'middleware' => 'acl_access:user/view-role/{slug}',
        'as' => 'user.view.role',
        'uses' => 'RoleController@show'
    ]);
    Route::any('user/edit-role/{slug}', [
        'middleware' => 'acl_access:user/edit-role/{slug}',
        'as' => 'user.edit.role',
        'uses' => 'RoleController@edit'
    ]);
    Route::any('user/update-role/{slug}', [
        'middleware' => 'acl_access:user/update-role/{slug}',
        'as' => 'user.update.role',
        'uses' => 'RoleController@update'
    ]);

    Route::get('user/delete-role/{slug}', [
        'middleware' => 'acl_access:user/delete-role/{slug}',
        'as' => 'user.delete.role',
        'uses' => 'RoleController@destroy'
    ]);
    Route::get('user/role-search', [
        'middleware' => 'acl_access:user/role-search',
        'as' => 'user.role.search',
        'uses' => 'RoleController@search_role'
    ]);


    /*------------------------------------*/
    /*Permission */
    Route::get('user/permission', [
        'middleware' => 'acl_access:user/permission',
        'as' => 'user.index.permission',
        'uses' => 'PermissionController@index'
    ]);
     /* Store Permission */
    Route::any('user/store-permission', [
        'middleware' => 'acl_access:user/store-permission',
        'as' => 'user.store.permission',
        'uses' => 'PermissionController@store'
    ]);
    /* View Permission */
    Route::get('user/view-permission/{id}', [
        'middleware' => 'acl_access:user/view-permission/{id}',
        'as' => 'user.view.permission',
        'uses' => 'PermissionController@show'
    ]);
    /* Edit Permission */
    Route::get('user/edit-permission/{id}', [
        'middleware' => 'acl_access:user/edit-permission/{id}',
        'as' => 'user.edit.permission',
        'uses' => 'PermissionController@edit'
    ]);
    /* Update Permission */
    Route::any('user/update-permission/{id}', [
        'middleware' => 'acl_access:user/update-permission/{id}',
        'as' => 'user.update.permission',
        'uses' => 'PermissionController@update'
    ]);
    /* Delete Permission */
    Route::get('user/delete-permission/{id}', [
        'middleware' => 'acl_access:user/delete-permission/{id}',
        'as' => 'user.delete.permission',
        'uses' => 'PermissionController@destroy'
    ]);
    Route::get('user/route-in-permission', [
        'middleware' => 'acl_access:user/route-in-permission',
        'as' => 'route.in.permission',
        'uses' => 'PermissionController@route_in_permission'
    ]);
    Route::get('user/permission-search', [
        'middleware' => 'acl_access:user/permission-search',
        'as' => 'user.permission.search',
        'uses' => 'PermissionController@search_permission'
    ]);




    /*------------------------------------*/

    /*Permission */
    Route::get('user/role-permission', [
        'middleware' => 'acl_access:user/role-permission',
        'as' => 'user.index.role.permission',
        'uses' => 'RolePermissionController@index'
    ]);
    /* Store Permission */
    Route::any('user/store-role-permission', [
        'middleware' => 'acl_access:user/store-role-permission',
        'as' => 'user.store.role.permission',
        'uses' => 'RolePermissionController@store'
    ]);
    /* View Permission */
    Route::any('user/view-role-permission/{id}', [
        'middleware' => 'acl_access:user/view-role-permission/{id}',
        'as' => 'user.view.role.permission',
        'uses' => 'RolePermissionController@show'
    ]);

    /* Edit Permission */
    Route::get('user/edit-role-permission/{id}', [
        'middleware' => 'acl_access:user/edit-role-permission/{id}',
        'as' => 'user.edit.role.permission',
        'uses' => 'RolePermissionController@edit'
    ]);

    /* Update Permission */
    Route::any('user/update-role-permission/{id}', [
        'middleware' => 'acl_access:user/update-role-permission/{id}',
        'as' => 'user.update.role.permission',
        'uses' => 'RolePermissionController@update'
    ]);

    /* Delete Permission */
    Route::get('user/delete-role-permission/{id}', [
        'middleware' => 'acl_access:user/delete-role-permission/{id}',
        'as' => 'user.delete.role.permission',
        'uses' => 'RolePermissionController@destroy'
    ]);
    /* search Role Permission */
    Route::get('user/search-role-permission', [
        'middleware' => 'acl_access:user/search-role-permission',
        'as' => 'user.search.role.permission',
        'uses' => 'RolePermissionController@search_permission_role'
    ]);


    /*------------------------------------*/
    /* View Activity */
    Route::get('user/activity', [
        'middleware' => 'acl_access:user/activity',
        'as' => 'user.view.activity',
        'uses' => 'UserActivityController@login_history'
    ]);

     Route::get('user/search-activity', [
        'middleware' => 'acl_access:user/search-activity',
        'as' => 'user.search.activity',
        'uses' => 'UserActivityController@search_user_history'
    ]);






    /*------------------------------------*/
    //permission role route
    Route::any('user/index-permission-role', [
        'middleware' => 'acl_access:user/index-permission-role',
        'as' => 'user.index.permission.role',
        'uses' => 'RolePermissionController@index'

    ]);

    Route::post('user/add-permission-role', [
        'middleware' => 'acl_access:user/add-permission-role',
        'as' => 'user.add.permission.role',
        'uses' => 'RolePermissionController@create'
    ]);

    Route::any('user/store-permission-role', [
        'middleware' => 'acl_access:user/store-permission-role',
        'as' => 'user.store.permission.role',
        'uses' => 'RolePermissionController@store'
    ]);

    Route::any('user/view-permission-role/{id}', [
        'middleware' => 'acl_access:user/view-permission-role/{id}',
        'as' => 'user.view.permission.role',
        'uses' => 'RolePermissionController@show'
    ]);

    Route::any('user/edit-permission-role/{id}', [
        'middleware' => 'acl_access:user/edit-permission-role/{id}',
        'as' => 'user.edit.permission.role',
        'uses' => 'RolePermissionController@edit'
    ]);

    Route::any('user/update-permission-role/{id}', [
        'middleware' => 'acl_access:user/update-permission-role/{id}',
        'as' => 'user.update.permission.role',
        'uses' => 'RolePermissionController@update'
    ]);

    Route::any('user/delete-permission-role/{id}', [
        'middleware' => 'acl_access:user/delete-permission-role/{id}',
        'as' => 'user.delete.permission.role',
        'uses' => 'RolePermissionController@destroy'
    ]);

    Route::get('user/search-permission-role', [
        'middleware' => 'acl_access:user/search-permission-role',
        'as' => 'user.search.permission.role',
        'uses' => 'RolePermissionController@search_permission_role'
    ]);


   /*------------------------------------*/


    /*------------------------------------*/


    /*------------------------------------*/








});