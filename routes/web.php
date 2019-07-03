<?php

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

//模板继承的练习  搭建后台
Route::resource("/admin","Admin\AdminController");

//后台的用户模块
Route::resource("/adminusers","Admin\UsersController");


