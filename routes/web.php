<?php

// Route::view('/', 'welcome');
Route::redirect('/', '/login');
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

    // Designation
    Route::delete('designations/destroy', 'DesignationController@massDestroy')->name('designations.massDestroy');
    Route::post('designations/parse-csv-import', 'DesignationController@parseCsvImport')->name('designations.parseCsvImport');
    Route::post('designations/process-csv-import', 'DesignationController@processCsvImport')->name('designations.processCsvImport');
    Route::resource('designations', 'DesignationController');

    // Section
    Route::delete('sections/destroy', 'SectionController@massDestroy')->name('sections.massDestroy');
    Route::resource('sections', 'SectionController');

    // Daily Wage Employee
    Route::delete('daily-wage-employees/destroy', 'DailyWageEmployeeController@massDestroy')->name('daily-wage-employees.massDestroy');
    Route::post('daily-wage-employees/parse-csv-import', 'DailyWageEmployeeController@parseCsvImport')->name('daily-wage-employees.parseCsvImport');
    Route::post('daily-wage-employees/process-csv-import', 'DailyWageEmployeeController@processCsvImport')->name('daily-wage-employees.processCsvImport');
    Route::resource('daily-wage-employees', 'DailyWageEmployeeController');

    // Session
    Route::resource('sessions', 'SessionController', ['except' => ['destroy']]);

    // Calender
    Route::delete('calenders/destroy', 'CalenderController@massDestroy')->name('calenders.massDestroy');
    Route::resource('calenders', 'CalenderController');

    // Duty Form
    Route::get('duty-forms/download', 'DutyFormController@download')->name('duty-forms.download');
    Route::resource('duty-forms', 'DutyFormController');

    // Duty Form Item
    //Route::delete('duty-form-items/destroy', 'DutyFormItemController@massDestroy')->name('duty-form-items.massDestroy');
    Route::resource('duty-form-items', 'DutyFormItemController');

    //Routings
    Route::resource('routings', 'RoutingController');
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
   
  //  Route::view('/{any}', 'frontend.home')->where('any', '.*');
    Route::get('/home', 'HomeController@index')->name('home');
   // Route::view('/duty', 'frontend.main')->name('main');;
    Route::get('/duty-forms',  'DutyFormController@main')->name('main');;

/* 
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

    // Designation
    Route::delete('designations/destroy', 'DesignationController@massDestroy')->name('designations.massDestroy');
    Route::resource('designations', 'DesignationController');

    // Section
    Route::delete('sections/destroy', 'SectionController@massDestroy')->name('sections.massDestroy');
    Route::resource('sections', 'SectionController');

    // Daily Wage Employee
    Route::delete('daily-wage-employees/destroy', 'DailyWageEmployeeController@massDestroy')->name('daily-wage-employees.massDestroy');
    Route::resource('daily-wage-employees', 'DailyWageEmployeeController');

    // Session
    Route::resource('sessions', 'SessionController', ['except' => ['destroy']]);

    // Calender
    Route::delete('calenders/destroy', 'CalenderController@massDestroy')->name('calenders.massDestroy');
    Route::resource('calenders', 'CalenderController');

    // Duty Form
    Route::delete('duty-forms/destroy', 'DutyFormController@massDestroy')->name('duty-forms.massDestroy');
    Route::resource('duty-forms', 'DutyFormController');

    // Duty Form Item
    Route::delete('duty-form-items/destroy', 'DutyFormItemController@massDestroy')->name('duty-form-items.massDestroy');
    Route::resource('duty-form-items', 'DutyFormItemController');
*/
    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password'); 
});
