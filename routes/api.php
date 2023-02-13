<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Category
    Route::apiResource('categories', 'CategoryApiController');

    // Session
    Route::apiResource('sessions', 'SessionApiController', ['except' => ['destroy']]);

    // Calender
    Route::apiResource('calenders', 'CalenderApiController');

    // Duty Form
    Route::apiResource('duty-forms', 'DutyFormApiController');
});
