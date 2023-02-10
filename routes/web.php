<?php

Route::view('/', 'welcome');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Category
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoryController');

    // Daily Wage Employee
    Route::delete('daily-wage-employees/destroy', 'DailyWageEmployeeController@massDestroy')->name('daily-wage-employees.massDestroy');
    Route::post('daily-wage-employees/parse-csv-import', 'DailyWageEmployeeController@parseCsvImport')->name('daily-wage-employees.parseCsvImport');
    Route::post('daily-wage-employees/process-csv-import', 'DailyWageEmployeeController@processCsvImport')->name('daily-wage-employees.processCsvImport');
    Route::resource('daily-wage-employees', 'DailyWageEmployeeController');

    // Designation
    Route::delete('designations/destroy', 'DesignationController@massDestroy')->name('designations.massDestroy');
    Route::post('designations/parse-csv-import', 'DesignationController@parseCsvImport')->name('designations.parseCsvImport');
    Route::post('designations/process-csv-import', 'DesignationController@processCsvImport')->name('designations.processCsvImport');
    Route::resource('designations', 'DesignationController');

    // Session
    Route::resource('sessions', 'SessionController', ['except' => ['destroy']]);

    // Calender
    Route::delete('calenders/destroy', 'CalenderController@massDestroy')->name('calenders.massDestroy');
    Route::resource('calenders', 'CalenderController');

    // Session Duty Item
    Route::delete('session-duty-items/destroy', 'SessionDutyItemController@massDestroy')->name('session-duty-items.massDestroy');
    Route::resource('session-duty-items', 'SessionDutyItemController');

    // Session Duty
    Route::delete('session-duties/destroy', 'SessionDutyController@massDestroy')->name('session-duties.massDestroy');
    Route::resource('session-duties', 'SessionDutyController');

    // Single Day Duty
    Route::delete('single-day-duties/destroy', 'SingleDayDutyController@massDestroy')->name('single-day-duties.massDestroy');
    Route::resource('single-day-duties', 'SingleDayDutyController');

    // Single Day Duty Item
    Route::delete('single-day-duty-items/destroy', 'SingleDayDutyItemController@massDestroy')->name('single-day-duty-items.massDestroy');
    Route::resource('single-day-duty-items', 'SingleDayDutyItemController');

    // Section
    Route::delete('sections/destroy', 'SectionController@massDestroy')->name('sections.massDestroy');
    Route::resource('sections', 'SectionController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Category
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoryController');

    // Daily Wage Employee
    Route::delete('daily-wage-employees/destroy', 'DailyWageEmployeeController@massDestroy')->name('daily-wage-employees.massDestroy');
    Route::resource('daily-wage-employees', 'DailyWageEmployeeController');

    // Designation
    Route::delete('designations/destroy', 'DesignationController@massDestroy')->name('designations.massDestroy');
    Route::resource('designations', 'DesignationController');

    // Session
    Route::resource('sessions', 'SessionController', ['except' => ['destroy']]);

    // Calender
    Route::delete('calenders/destroy', 'CalenderController@massDestroy')->name('calenders.massDestroy');
    Route::resource('calenders', 'CalenderController');

    // Session Duty Item
    Route::delete('session-duty-items/destroy', 'SessionDutyItemController@massDestroy')->name('session-duty-items.massDestroy');
    Route::resource('session-duty-items', 'SessionDutyItemController');

    // Session Duty
    Route::delete('session-duties/destroy', 'SessionDutyController@massDestroy')->name('session-duties.massDestroy');
    Route::resource('session-duties', 'SessionDutyController');

    // Single Day Duty
    Route::delete('single-day-duties/destroy', 'SingleDayDutyController@massDestroy')->name('single-day-duties.massDestroy');
    Route::resource('single-day-duties', 'SingleDayDutyController');

    // Single Day Duty Item
    Route::delete('single-day-duty-items/destroy', 'SingleDayDutyItemController@massDestroy')->name('single-day-duty-items.massDestroy');
    Route::resource('single-day-duty-items', 'SingleDayDutyItemController');

    // Section
    Route::delete('sections/destroy', 'SectionController@massDestroy')->name('sections.massDestroy');
    Route::resource('sections', 'SectionController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
