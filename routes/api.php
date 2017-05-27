<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post("/maintainable/", "MaintainableApiController@showJSON")->name("apiMaintainables");
Route::get("/maintainable/html/{maintainable?}", "MaintainableApiController@showHTML")->name("apiMaintainableHTML");
Route::get("/option/get/{key}", "OptionController@get")->name("getOption");
Route::get("/option/clearCache", "OptionController@clearCache")->name("clearCache");
