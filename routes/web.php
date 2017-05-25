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
Route::match(["get","post"],'/login', 'AuthController@login')->name("login");
Route::get("/logout","AuthController@logout")->name("logout");
// Admin stuff
Route::get("/admin",function (){
    return view("admin.master",["panel"=>"user"]);
})->name("admin")->middleware('auth');
Route::get("/admin/group","GroupController@index")->name("allGroups");
Route::post("/admin/group","GroupController@store")->name("storeGroup");
Route::get("/admin/group/{group}","GroupController@detail")->name("group");
Route::post("/admin/group/{group}","GroupController@update")->name("updateGroup");
Route::get("/admin/user","UserController@index")->name("allUsers");
Route::get("/admin/user/{user}","UserController@show")->name("profile");
Route::post("/admin/user/{user}","UserController@update")->name("updateUser");
Route::post("/user","UserController@store")->name("storeUser");
Route::get('/maintainable','MaintainableController@showAll')->name("allMaintainables");;
Route::get('/maintainable/{maintainable}','MaintainableController@show')->name("maintainable");
Route::get('/maintainable/{maintainable}/delete', 'MaintainableController@delete')->name("deleteMaintainable");
Route::post("/application","ApplicationController@store")->name("storeApplication");
Route::post("/application/{application}","ApplicationController@update")->name("updateApplication");
Route::post("/application/{application}/dependency","ApplicationController@addDependency")->name("addDependency");
Route::get("/application/{application}/{dependency}","ApplicationController@removeDependency")->name("removeDependency");
Route::post("/host","HostController@store")->name("storeHost");
Route::post("/host/{host}","HostController@update")->name("updateHost");
Route::get("/maintenance/calendar", "CalendarController@index")->name("calendar");
Route::get("/maintenance/calendar/feed", "CalendarController@maintenanceFeed")->name("calendarFeed");
Route::get('/maintenance', 'MaintenanceController@showAll');
Route::post("/maintenance","MaintenanceController@store")->name("storeMaintenance");
Route::get("/maintenance/batch","MaintenanceController@batch")->name("batchMaintenance");
Route::get('/maintenance/{maintenance}', 'MaintenanceController@show')->name("maintenance");
Route::get('/maintenance/{maintenance}/transit', 'MaintenanceController@transit')->name("maintenanceTransit");
Route::post("/maintenance/{maintenance}/comment", "MaintenanceController@comment")->name("commentMaintenance");
Route::get("/maintenance/{maintenance}/message", "MaintenanceController@showMessage")->name("maintenanceMessage");

Route::post("/search","SearchController@search")->name("search");
Route::post("/option", "OptionController@update")->name("updateOptions");
