<?php
Route::redirect('/', 'admin/home');

Auth::routes(['register' => false]);

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::delete('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
    
    Route::resource('roles', 'Admin\RolesController');
    Route::delete('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');

    Route::resource('users', 'Admin\UsersController');
    Route::get('users_createbytype/{id}', 'Admin\UsersController@createbytype')->name('users_createbytype');
    Route::get('users_createbygroup/{id}', 'Admin\UsersController@createbygroup')->name('users_createbygroup');
    Route::get('users_getdata', 'Admin\UsersController@getdata')->name('users_getdata');
    Route::post('users_store_group', 'Admin\UsersController@store_group')->name('users_store_group');
    Route::delete('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');

    Route::resource('company', 'Admin\CompanyController');
    Route::delete('company_mass_destroy', 'Admin\CompanyController@massDestroy')->name('company.mass_destroy');
    
});
