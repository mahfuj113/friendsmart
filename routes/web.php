<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\visitors\VisitorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SslCommerzPaymentController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin-logout', [App\Http\Controllers\HomeController::class, 'Logout'])->name('logout');
Route::controller(UserController::class)->group(function(){
    Route::get('/view-users','ViewUsers')->name('view_users');
    Route::post('/add-user','AddUser')->name('add_user');
    Route::post('/update-user','UpdateUser')->name('update_user');
    Route::get('/update-user-status/{status}/{id}','UpdateUserStatus')->name('update_user_status');
    Route::get('/delete-user/{id}','DeleteUser')->name('delete_user');
    Route::get('/my-profile','MyProfile')->name('my_profile');
    Route::post('/update-my-profile','UpdateMyProfile')->name('update_my_profile');
    Route::get('/change-password','ChangePassword')->name('change_password');
    Route::post('/change-password','UpdatePassword')->name('change_password');
});

Route::controller(CategoryController::class)->group(function(){
    Route::get('/category','CategoryView')->name('category');
    Route::post('/category','CategoryInsert')->name('category');
    Route::post('/category-update','CategoryUpdate')->name('category_update');
    Route::get('/category-status-update/{status}/{id}','CategoryStatusUpdate')->name('category_status_update');
    Route::get('/category-delete/{id}','CategoryDelete')->name('category_delete');
    //sub-category
    Route::get('/sub-category','SubCategoryView')->name('sub_category');
    Route::post('/sub-category','SubCategoryInsert')->name('sub_category');
    Route::post('/sub-category-update','SubCategoryUpdate')->name('sub_category_update');
    Route::get('/sub-category-status-update/{status}/{id}','SubCategoryStatusUpdate')->name('sub_category_status_update');
    Route::get('/sub-category-delete/{id}','SubCategoryDelete')->name('sub_category_delete');

    //logo
    Route::get('/admin-logo','AdminLogo')->name('admin_logo');
    Route::post('/admin-logo','AdminLogoInsert')->name('admin_logo');
    Route::get('/logo-delete/{id}','LogoDelete')->name('logo_delete');

    //json dependency
    Route::get('/get/sub_category/{category_id}','GetSubCategory');
});

Route::controller(OrderController::class)->group(function(){
    Route::get('/processing-order','Processing')->name('processing_orders');
    Route::get('/update-order/{status}/{id}','UpdateStatus')->name('update_order');
    Route::get('/on-the-way-order','OnTheWay')->name('on_the_way_orders');
    Route::get('/update-orde-status/{status}/{id}','UpdateStatus2')->name('update_order2');
    Route::get('/delevered-order','Delevered')->name('delevered_orders');

    //exchanges

    Route::get('/pending-exchange','PendingExchange')->name('pending_exchange');
    Route::get('/delete-exchange-admin/{id}','ExchangeDelete')->name('delete_exchange_admin');
    Route::get('/update-exchange-admin/{id}/{status}','ExchangeUpdate')->name('update_exchange_admin');
    Route::get('/update-exchange-admins/{id}/{status}','ExchangeUpdate1')->name('update_exchange_admin1');

    //
    Route::get('/accepted-exchange','AcceptedExchange')->name('accepted_exchange');
    Route::post('/accepted-exchange','AcceptedExchangeInsert')->name('accepted_exchange');
    Route::get('/completed-exchange','CompleteExchange')->name('completed_exchange');
    // Route::get('/delete-exchange-admin/{id}','ExchangeDelete')->name('delete_exchange_admin');
    // Route::get('/update-exchange-admin/{id}/{status}','ExchangeUpdate')->name('update_exchange_admin');
});

Route::controller(ProductController::class)->group(function(){
    Route::get('/add-product','AddProduct')->name('add_product');
    Route::post('/add-product','AddProductInsert')->name('add_product');
    Route::get('/view-product','ViewProduct')->name('view_product');
    Route::get('/update-product-status/{status}/{id}','UpdateProductStatus')->name('update_product_status');
    Route::get('/delete-product/{id}','DeleteProduct')->name('delete_product');
    Route::get('/edit-product/{id}','EditProduct')->name('edit_product');
    Route::post('/update-product','UpdateProduct')->name('update_product');
});


//visitors-part
Route::middleware('visitorlogout')->group(function(){
    Route::controller(VisitorController::class)->group(function(){
        Route::get('/visitor-register','VisitorRegister')->name('visitor_register');
        Route::post('/visitor-register','VisitorInsert')->name('visitor_register');
        Route::get('/visitor-login','VisitorLogin')->name('visitor_login');
        Route::post('/visitor-login','LogIn')->name('visitor_login');
    });
});

Route::controller(VisitorController::class)->group(function(){
    Route::get('/product-details/{product_id}','ProductDetails')->name('product_details');
    Route::get('/products/{category_id}','CategoryProducts')->name('category_product');
    Route::get('/product/{category_id}/{sub_category_id}','SubcategoryProducts')->name('sub_category_product');
});


Route::middleware('visitorlogin')->group(function(){
    Route::get('/visitor-logout',[VisitorController::class,'Logout'])->name('visitor_logout');
    Route::controller(VisitorController::class)->group(function(){
        Route::get('/add-to-cart/{product_id}','AddCart')->name('add_to_cart');
        Route::get('/cart','Cart')->name('cart');
        Route::post('/add-cart','AddCartInsert')->name('add_cart');
        Route::get('/delete-cart/{id}','DeleteCart')->name('delete_cart');
        Route::get('/update-cart/{cart_id}','UpdateCart');
        Route::get('/update-cart-minus/{cart_id}','UpdateCartMinus');
        Route::get('/check-out','CheckOut')->name('check_out');
        Route::get('/orders','Orders')->name('orders');
        Route::get('/exchange','Exchange')->name('exchange');
        Route::post('/exchange','ExchangeInsert')->name('exchange');
        Route::get('/delete-exchange/{id}','ExchangeDelete')->name('delete_exchange');
        Route::get('/update-exchange/{id}/{status}','ExchangeUpdate')->name('update_exchange');
    });

});

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END




