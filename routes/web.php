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

Route::get("/",function (){
    return redirect()->route("login");
});
Route::match(["get","post"],'/login', 'UserController@login')->name("login");
Route::get("/logout","UserController@logout")->name("logout");
Route::get("/user","UserController@showall")->name("allUsers");
Route::get("/user/{user}","UserController@show")->name("user");
Route::post("/user","UserController@store")->name("storeUser");
Route::get('/maintainable','MaintainableController@showAll')->name("allMaintainables");;
Route::get('/maintainable/{maintainable}','MaintainableController@show')->name("maintainable");
Route::post('/maintainable/{maintainable}','MaintainableController@update')->name("updateMaintainable");
Route::post("/application","ApplicationController@store")->name("storeApplication");
Route::post("/application/{application}","ApplicationController@addDependency")->name("addDependency");
Route::get("/application/{application}/{dependency}","ApplicationController@removeDependency")->name("removeDependency");
Route::post("/host","HostController@store")->name("storeHost");
Route::get('/maintenance', 'MaintenanceController@showAll');
Route::post("/maintenance","MaintenanceController@store")->name("storeMaintenance");
Route::get('/maintenance/{maintenance}', 'MaintenanceController@show')->name("maintenance");
Route::get('/maintenance/{maintenance}/transit', 'MaintenanceController@transit')->name("maintenanceTransit");
Route::post("/maintenance/{maintenance}/comment", "MaintenanceController@comment")->name("commentMaintenance");
Route::get("/maintenance/{maintenance}/message", "MaintenanceController@showMessage")->name("maintenanceMessage");

Route::post("/search","SearchController@search")->name("search");