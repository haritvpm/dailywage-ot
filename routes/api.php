<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');

    // Category
    Route::apiResource('categories', 'CategoryApiController');

    // Designation
    Route::apiResource('designations', 'DesignationApiController');

    // Section
    Route::apiResource('sections', 'SectionApiController');

    // Daily Wage Employee
    Route::apiResource('daily-wage-employees', 'DailyWageEmployeeApiController');

    // Session
    Route::apiResource('sessions', 'SessionApiController', ['except' => ['destroy']]);

    // Calender
    Route::apiResource('calenders', 'CalenderApiController');

    // Duty Form
    Route::get('duty-forms/{id}/routes', 'DutyFormApiController@routes');
    Route::post('duty-forms/{id}/route', 'DutyFormApiController@route');
    Route::apiResource('duty-forms', 'DutyFormApiController');
});
