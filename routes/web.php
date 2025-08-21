<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

define('PAGINATION_COUNT', 10);

//DbSchemaManager::getTableNames1();
Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
});
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web']], function () {

    Route::group(['namespace' => 'App\Http\Controllers'], function () {
        Route::get('/', 'HomeController@index');
        Route::get('/', 'HomeController@index')->name('home.index');
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
        Route::get('search', 'GeneralController@search')->name('admin.search');

    });
    Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => 'permission'], function () {
        /**
         * Department Routes
         */
        Route::group(['prefix' => 'services'], function () {
            Route::get('/', 'ServiceController@index')->name('services.index');

            Route::get('/create', 'ServiceController@create')->name('services.create');
            Route::post('/create', 'ServiceController@store')->name('services.store');
            Route::get('/{service}/show', 'ServiceController@show')->name('services.show');
            Route::get('/{service}/edit', 'ServiceController@edit')->name('services.edit');
            Route::post('/{service}/update', 'ServiceController@update')->name('services.update');
            Route::delete('/{service}/delete', 'ServiceController@destroy')->name('services.destroy');
            Route::get('/status/{id}/{status}', 'ServiceController@changeStatus')->name('services.status');
        });
        /**
         *
         * Department Routes
         */
        Route::group(['prefix' => 'departments'], function () {
            Route::get('/', 'DepartmentController@index')->name('departments.index');

            Route::get('/create', 'DepartmentController@create')->name('departments.create');
            Route::post('/create', 'DepartmentController@store')->name('departments.store');
            Route::get('/{department}/show', 'DepartmentController@show')->name('departments.show');
            Route::get('/{department}/edit', 'DepartmentController@edit')->name('departments.edit');
            Route::post('/{department}/update', 'DepartmentController@update')->name('departments.update');
            Route::delete('/{department}/delete', 'DepartmentController@destroy')->name('departments.destroy');
            Route::get('/status/{id}/{status}', 'DepartmentController@changeStatus')->name('departments.status');
        });
        /**
         * Branch Routes
         */
        Route::group(['prefix' => 'branch'], function () {
            Route::get('/', 'BranchController@index')->name('branch.index');

            Route::get('/create', 'BranchController@create')->name('branch.create');
            Route::post('/create', 'BranchController@store')->name('branch.store');
            Route::get('/{branch}/show', 'BranchController@show')->name('branch.show');
            Route::get('/{branch}/edit', 'BranchController@edit')->name('branch.edit');
            Route::post('/{branch}/update', 'BranchController@update')->name('branch.update');
            Route::delete('/{branch}/delete', 'BranchController@destroy')->name('branch.destroy');

            Route::post('status', 'BranchController@changeStatusAjax')->name('branch.status');
        });
        Route::group(['prefix' => 'city'], function () {

            Route::get('/', 'CityController@index')->name('city.index');
            Route::get('/add', 'CityController@add')->name('city.add');
            Route::post('/store', 'CityController@store')->name('city.store');
            Route::get('/edit/{id}', 'CityController@edit')->name('city.edit');
            Route::put('/update/{id}', 'CityController@update')->name('city.update');
            Route::get('/delete/{id}', 'CityController@destroy')->name('city.delete');
        });
        Route::group(['prefix' => 'nationality'], function () {

            Route::get('/', 'NationalityController@index')->name('nationality.index');
            Route::get('/add', 'NationalityController@add')->name('nationality.add');
            Route::post('/store', 'NationalityController@store')->name('nationality.store');
            Route::get('/edit/{id}', 'NationalityController@edit')->name('nationality.edit');
            Route::put('/update/{id}', 'NationalityController@update')->name('nationality.update');
            Route::get('/delete/{id}', 'NationalityController@destroy')->name('nationality.delete');
        });
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UserController@index')->name('users.index');
            Route::get('/delete/{id}', 'UserController@destroy')->name('users.delete');
            Route::get('/viewdelete/{id}', 'UserController@destroy')->name('users.destroy');
            Route::get('/show/{id}', 'UserController@view')->name('users.view');
            Route::get('/edit/{id}', 'UserController@editUser')->name('users.edit');
            Route::put('/update/{id}', 'UserController@update')->name('users.update');
            Route::get('/add', 'UserController@addUser')->name('users.add');
            Route::post('/store', 'UserController@storeUser')->name('users.store');
            Route::post('status', 'UserController@changeStatusAjax')->name('users.status');
        });
        Route::group(['prefix' => 'nickname'], function () {

            Route::get('/', 'NicknameController@index')->name('nickname.index');
            Route::get('/add', 'NicknameController@add')->name('nickname.add');
            Route::post('/store', 'NicknameController@store')->name('nickname.store');
            Route::get('/edit/{id}', 'NicknameController@edit')->name('nickname.edit');
            Route::put('/update/{id}', 'NicknameController@update')->name('nickname.update');
            Route::get('/delete/{id}', 'NicknameController@destroy')->name('nickname.delete');
        });
        Route::group(['prefix' => 'specification'], function () {
            Route::get('/', 'SpecificationController@index')->name('specification.index');

            Route::get('/add', 'SpecificationController@add')->name('specification.add');
            Route::post('/store', 'SpecificationController@store')->name('specification.store');
            Route::get('/edit/{id}', 'SpecificationController@edit')->name('specification.edit');
            Route::put('/update/{id}', 'SpecificationController@update')->name('specification.update');
            Route::get('/delete/{id}', 'SpecificationController@destroy')->name('specification.delete');
        });
        Route::group(['prefix' => 'doctor'], function () {
            Route::get('/', 'DoctorController@index')->name('doctor.index');
            Route::get('/show/{id}', 'DoctorController@view')->name('doctor.view');
            Route::get('/create', 'DoctorController@create')->name('doctor.add');
            Route::post('/store', 'DoctorController@store')->name('doctor.store');
            Route::get('/edit/{id}', 'DoctorController@edit')->name('doctor.edit');
            Route::post('/update/{id}', 'DoctorController@update')->name('doctor.update');
            Route::get('/delete/{id}', 'DoctorController@destroy')->name('doctor.delete');
            Route::get('/status/{id}/{status}', 'DoctorController@changeStatus')->name('doctor.status');
        });
        Route::group(['prefix' => 'patients'], function () {
            Route::get('/', 'PatientController@index')->name('patients.index');
            Route::get('/create', 'PatientController@create')->name('patients.create');
            Route::post('create', 'PatientController@store')->name('patients.store');
            Route::get('/{patient}/show', 'PatientController@show')->name('patients.show');
            Route::get('/{patient}/edit', 'PatientController@edit')->name('patients.edit');
            Route::post('update', 'PatientController@update')->name('patients.update');
            Route::get('/{patient}/delete', 'PatientController@destroy')->name('patients.destroy');
            Route::post('search', 'PatientController@search')->name('patients.search');
        });
        Route::group(['prefix' => 'drugs'], function () {
            Route::get('/', 'DrugsController@index')->name('drugs.index');
            Route::get('/create', 'DrugsController@create')->name('drugs.create');
            Route::post('/create', 'DrugsController@store')->name('drugs.store');
            Route::get('/{drug}/show', 'DrugsController@show')->name('drugs.show');
            Route::get('/{drug}/edit', 'DrugsController@edit')->name('drugs.edit');
            Route::post('/{drug}/update', 'DrugsController@update')->name('drugs.update');
            Route::get('/{drug}/delete', 'DrugsController@destroy')->name('drugs.destroy');
            Route::get('/status/{id}/{status}', 'DrugsController@changeStatus')->name('drugs.status');
        });
        Route::group(['prefix' => 'lab_tests'], function () {
            Route::get('/', 'LabTestController@index')->name('lab_tests.index');
            Route::get('/create', 'LabTestController@create')->name('lab_tests.create');
            Route::post('/create', 'LabTestController@store')->name('lab_tests.store');
            Route::get('/{lab_test}/show', 'LabTestController@show')->name('lab_tests.show');
            Route::get('/{lab_test}/edit', 'LabTestController@edit')->name('lab_tests.edit');
            Route::post('/{lab_test}/update', 'LabTestController@update')->name('lab_tests.update');
            Route::get('/{lab_test}/delete', 'LabTestController@destroy')->name('lab_tests.destroy');
            Route::get('/status/{id}/{status}', 'LabTestController@changeStatus')->name('lab_tests.status');
        });
        Route::group(['prefix' => 'xrays'], function () {
            Route::get('/', 'XrayController@index')->name('xrays.index');
            Route::get('/create', 'XrayController@create')->name('xrays.create');
            Route::post('/create', 'XrayController@store')->name('xrays.store');
            Route::get('/{xray}/show', 'XrayController@show')->name('xrays.show');
            Route::get('/{xray}/edit', 'XrayController@edit')->name('xrays.edit');
            Route::post('/{xray}/update', 'XrayController@update')->name('xrays.update');
            Route::get('/{xray}/delete', 'XrayController@destroy')->name('xrays.destroy');
            Route::get('/status/{id}/{status}', 'XrayController@changeStatus')->name('xrays.status');
        });
    });
});
