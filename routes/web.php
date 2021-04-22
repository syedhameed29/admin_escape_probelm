<?php

use Illuminate\Support\Facades\Route;

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
//admin
Route::get('/','Admin\DashboardController@index');
Route::resource('/category','Admin\CategoryController');
Route::resource('/subcategory','Admin\SubCategoryController');
Route::resource('/service','Admin\ServiceController');
Route::resource('/country','Admin\CountryController');
Route::resource('/state','Admin\StateController');
Route::resource('/district','Admin\DistrictController');
Route::resource('/manager','Admin\ManagerController');
Route::resource('/partner','Admin\PartnerController');
Route::resource('/payment_method','Admin\PaymentController');
Route::resource('/customer','Admin\CustomerController');
Route::get('/appointment','Admin\AppointmentController@index');
Route::get('/contact','Admin\ContactController@index');

// Route::get('/selectcountry','Admin\AjaxController@country');
// Route::get('/selectstate','Admin\AjaxController@state');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/partner/reset',function(){
//     return view()
// })->name('partner.password.reset');