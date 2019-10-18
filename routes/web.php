<?php

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
Route::group(['namespace' => 'Auth'], function () {
    Route::get('/registration', "AuthController@showRegistrationForm")->name("registration");
    Route::post('/registration', "AuthController@registration")->name("registration");
    Route::get('/account-activate/{token}', "AuthController@accountActive")->name("account.activate");

    Route::get('/login', "AuthController@showLoginForm")->name("login");
    Route::post('/login', "AuthController@login")->name("login");

    // Socialite--------------------------------------------------

    Route::get('login/{socialite}', 'AuthController@redirectToProvider');
    Route::get('login/{socialite}/callback', 'AuthController@handleProviderCallback');

    Route::get('/logout', "AuthController@logout")->name("logout");
});

// front-------------------------------------------------
Route::group(["namespace" => "Front"], function () {
    Route::get("/", "HomeController@index");
    Route::get("/categories", "HomeController@categories");
    Route::get("/products", "HomeController@products");
    Route::get("/singleProduct/{id}", "HomeController@singleProduct");
    Route::get("/relatedProducts/{id}", "HomeController@relatedProducts");
    Route::get("/categoryProducts/{id}", "HomeController@categoryProducts");

    Route::get('/cartProducts', 'CartController@index');
    Route::post('/cart/{id}', 'CartController@store');
    Route::post('/cartUpdate/{id}', 'CartController@update');
    Route::delete('/cartRemove/{id}', 'CartController@remove');
    Route::delete('/cartRemoveAll', 'CartController@removeAll');

    Route::post('/checkout', 'CartController@checkout');
});


// Admin-------------------------------------------------
//Route::get("/admin/home", "Admin\HomeController@index");

Route::group(["prefix" => "admin", "namespace" => "Admin", "middleware" => ["auth", "admin"]], function(){
    Route::get("/home", "HomeController@index");

    Route::resources([
        "categories" => "CategoryController",
        "products" => "ProductController",
        "orders" => "OrderController",
    ]);
});

Route::get('/{anyPath}', 'Front\HomeController@index')->where("anyPath", ".*");
