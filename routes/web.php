<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('admin.dashboard');
});

Route::get('admin', 'Admin\AdminController@index');
Route::resource('admin/roles', 'Admin\RolesController');
Route::resource('admin/permissions', 'Admin\PermissionsController');
Route::resource('admin/users', 'Admin\UsersController');
Route::resource('admin/pages', 'Admin\PagesController');
Route::resource('admin/activitylogs', 'Admin\ActivityLogsController')->only([
    'index', 'show', 'destroy'
]);
Route::resource('admin/settings', 'Admin\SettingsController');
Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('admin/asset-group', 'Admin\AssetGroupController');

Route::resource('admin/sub-asset-group', 'Admin\SubAssetGroupController');

Route::resource('admin/asset-master', 'Admin\AssetMasterController');
Route::get('admin/asset-master/js/{id}', 'Admin\AssetMasterController@getJs');

Route::resource('admin/pop-master', 'Admin\PopMasterController');

Route::resource('admin/pm-pop', 'Admin\PmPopController');
Route::get('admin/pm-pop/js/{id}', 'Admin\PmPopController@getJsasset');