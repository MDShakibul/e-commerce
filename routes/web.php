<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');

//new category wise product here
Route::get('/product_by_category/{category_id}', 'HomeController@show_product_by_category');
Route::get('/product_by_manufacture/{manufacture_id}', 'HomeController@show_product_by_manufacture');
Route::get('/view_product/{product_id}', 'HomeController@product_details_by_id');

//cart
Route::post('/add-to-cart','CartController@add_to_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-from-cart/{id}','CartController@delete_from_cart');
Route::post('/update-cart','CartController@update_cart');

//checkout
Route::get('/login-check','CheckoutController@login_check');
Route::post('/customer_registration','CheckoutController@customer_registration');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save-shipping-details','CheckoutController@save_shipping_details');

//customer login & out
Route::post('/customer_login','CheckoutController@customer_login');
Route::get('/customer_logout','CheckoutController@customer_logout');
Route::post('/order-place','CheckoutController@order_place');

//manage order
Route::get('/manage-order','ManageOrderController@manage_order');
Route::get('/view-order/{order_id}','ManageOrderController@view_order');
Route::get('/delete-order/{order_id}','ManageOrderController@delete_order');
Route::get('/unactive_order/{ordery_id}', 'ManageOrderController@unactive_order');
Route::get('/active_order/{order_id}', 'ManageOrderController@active_order');






//payment
Route::get('/payment','CheckoutController@payment');




//Backend routes
Route::get('/logout', 'SuperAdminController@logout');
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard','SuperAdminController@index');
Route::post('/admin-dashboard','AdminController@dashboard');



//Category
Route::get('/add_category', 'CategoryController@index');
Route::get('/all_category', 'CategoryController@allcategory');
Route::post('/save-category', 'CategoryController@save_category');
Route::get('/unactive_category/{category_id}', 'CategoryController@unactive_category');
Route::get('/active_category/{category_id}', 'CategoryController@active_category');
Route::get('/edit_category/{category_id}', 'CategoryController@edit_category');
Route::post('/update_category/{category_id}', 'CategoryController@update_category');
Route::get('/delete_category/{category_id}', 'CategoryController@_category');

//manufacture
Route::get('/add_manufacture', 'ManufactureController@index');
Route::post('/save-manufacture', 'ManufactureController@save_manufacture');
Route::get('/all_manufacture', 'ManufactureController@allmanufacture');
Route::get('/delete_manufacture/{manufacture_id}', 'ManufactureController@delete_manufacture');
Route::get('/unactive_manufacture/{manufacture_id}', 'ManufactureController@unactive_manufacture');
Route::get('/active_manufacture/{manufacture_id}', 'ManufactureController@active_manufacture');
Route::get('/edit_manufacture/{manufacture_id}', 'ManufactureController@edit_manufacture');
Route::post('/update_manufacture/{manufacture_id}', 'ManufactureController@update_manufacture');


//product
Route::get('/add_product', 'ProductController@index');
Route::post('/save_product', 'ProductController@save_product');
Route::get('/all_product', 'ProductController@all_product');
Route::get('/unactive_product/{product_id}', 'ProductController@unactive_product');
Route::get('/active_product/{product_id}', 'ProductController@active_product');
Route::get('/delete_product/{product_id}', 'ProductController@delete_product');
Route::get('/edit_product/{product_id}', 'ProductController@edit_product');
Route::post('/update_product/{product_id}', 'ProductController@update_product');


//slider
Route::get('/add_slider', 'SliderController@index');
Route::post('/save_slider', 'SliderController@save_slider');
Route::get('/all_slider', 'SliderController@all_slider');
Route::get('/unactive_slider/{slider_id}', 'SliderController@unactive_slider');
Route::get('/active_slider/{slider_id}', 'SliderController@active_slider');
Route::get('/delete_slider/{slider_id}', 'SliderController@delete_slider');







