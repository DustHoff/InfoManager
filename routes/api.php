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
Route::get("/option/i18n", "OptionController@localization")->name("i18n");
Route::get("/complete/email", "SearchController@email")->name("emailAutocomplete");
Route::get("/complete/maintainablegroup", "SearchController@maintainablegroup")->name("maintainablegroupAutocomplete");
Route::get("/complete/maintainable", "SearchController@maintainable")->name("maintainableAutocomplete");
Route::get("/jobs", "JobController@index")->name("jobs");
Route::post("/jobs/import/{host?}", "JobController@importJob")->name("HostImportJob");
Route::post("/jobs/{job}", "JobController@restart");
Route::delete("/jobs/{job}", "JobController@delete");

