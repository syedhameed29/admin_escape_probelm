 <?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routesics
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'customer'],function(){
    Route::post('register','Customer\CustomerController@register');
    Route::post('login','Customer\CustomerController@login');
    Route::post('password/email', 'Customer\ForgetPasswordController@SendResetLinkEmail');
    Route::post('password/reset','Customer\ResetPasswordController@reset');
    //unauthenticated routes for customers here 
       Route::get('/country','Customer\CustomerController@country');  
    // authenticated customer routes here          
    Route::group( ['middleware' => ['auth:customer','scope:customer'] ],function(){
       Route::get('logout','Customer\CustomerController@logout');
       Route::get('profile','Customer\CustomerController@profile');
       Route::post('editprofile','Customer\CustomerController@editprofile');
       Route::get('allappointment','Customer\AppointmentController@allappointment');     
       Route::get('service/subcategory={id}','Customer\AppointmentController@service');
       Route::get('payment_methods','Customer\PaymentMethodController@index');
       Route::get('payment/{id}','Customer\PaymentMethodController@payment');
       Route::post('appointment/create','Customer\AppointmentController@appointment');  
       Route::post('address/create','Customer\AddressController@create');   
       Route::post('address/edit','Customer\AddressController@editAddress'); 
       Route::post('address/delete','Customer\AddressController@deleteAddress'); 
       Route::get('address/{id}','Customer\AddressController@showAddress'); 
    });
});
Route::group(['prefix' => 'partner'],function(){
    Route::post('register','Partner\PartnerController@register');
    Route::post('login','Partner\PartnerController@login');
    Route::post('password/email', 'Partner\ForgetPasswordController@SendResetLinkEmail');
    Route::post('password/reset','Partner\ResetPasswordController@reset');
    //unauthenticated routes for customers here 
         
    // authenticated customer routes here          
    Route::group( ['middleware' => ['auth:partner','scope:partner'] ],function(){
       Route::get('logout','Partner\PartnerController@logout');
       Route::get('profile','Partner\PartnerController@profile');
       Route::post('profile/editprofile','Partner\PartnerController@editprofile');
       Route::get('/category','Partner\CategoryController@category');
       Route::get('/selectedcategory','Partner\CategoryController@selectedcategory');
       Route::post('/addcategory','Partner\CategoryController@addcategory');
       Route::get('/appointment','Partner\AppointmentController@index');
       Route::post('/editappointment','Partner\AppointmentController@update');
       Route::post('/requestwallet','Partner\WalletController@wallet');
       Route::get('/readnotification','Partner\PartnerController@readnotification');
       Route::get('/unreadnotification','Partner\PartnerController@unreadnotification');
       Route::get('/markasread/notification={id}','Partner\PartnerController@markasread');
    });
});
Route::group(['prefix' => 'manager'],function(){
    Route::post('login','Manager\ManagerController@login');
    //Route::post('password/email', 'Manager\ForgetPasswordController@SendResetLinkEmail');
    //Route::POST ('password/reset','Manager\ResetPasswordController@reset');
    //unauthenticated routes for customers here 
        //   
    // authenticated customer routes here          
    Route::group( ['middleware' => ['auth:manager','scope:manager'] ],function(){
       Route::get('logout','Manager\ManagerController@logout');
       Route::get('/managershow','Manager\ManagerController@show');
       Route::get('/category','Manager\CategoryController@category');
       Route::get('/selectedcategory','Manager\CategoryController@selectedcategory');
       Route::post('/addcategory','Manager\CategoryController@editcategory');
       Route::get('/partner','Manager\PartnerController@index');
       Route::post('/editpartner','Manager\PartnerController@update');
       Route::get('/selectedpartner/{id}','Manager\AppointmentController@partser');
       Route::get('/appointment','Manager\AppointmentController@index');
       Route::post('/editappointment','Manager\AppointmentController@update');
       Route::post('/updatewallet','Manager\PartnerController@wallet');
       Route::get('/readnotification','Manager\ManagerController@readnotification');
       Route::get('/unreadnotification','Manager\ManagerController@unreadnotification');
       Route::get('/markasread/notification={id}','Manager\ManagerController@markasread');
    });
});
Route::group(['prefix' => 'frontend'],function(){
    Route::get('/category/{slug}','FrontendController@category');
    Route::get('/subcategory/category={id}','FrontendController@subcategory');
    Route::get('service/subcategory={id}','FrontendController@service');
    Route::get('singleservice/{id}','FrontendController@selectservice');
    Route::get('/country','FrontendController@country');  
    Route::get('/selectedstate/{slug}','FrontendController@selectedstate');
    Route::get('/selecteddistrict/{slug}','FrontendController@selecteddistrict');
    Route::get('/district','FrontendController@district');
    Route::post('/contact','FrontendController@contact');
});