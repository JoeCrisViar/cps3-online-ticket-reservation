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

// UI ROUTE

Route::get('/', 'HomeController@index')->name('home');

Route::get('/checkout/{theatre_id}/movie/{movie_id}/screen/{screen_id}', 'HomeController@checkout')->name('checkout');

Route::get('/transaction', 'TransactionsController@index')->name('transaction.index');

Route::post('/transaction', 'TransactionsController@save')->name('save');
// Route::get('/checkout/{theatre_id}/{movie_id}', 'HomeController@checkout2')->name('checkout2');    
Route::get('/transaction_sucess', 'TransactionsController@success')->name('success');

// Admin
Route::resource('/users', 'UsersController');

Route::get('/users/{user_id}/change_password', 'UsersController@edit_password')->name('change_password');

Route::get('/myaccount', 'UsersController@myaccount')->name('myaccount');

// Moives Route
Route::resource('/movies', 'MoviesController');


// THEATRE ROUTES

Route::resource('/theatres', 'TheatresController');


// THEATRE SUBDOCS ROUTES

// Index Theatre SCREEN
Route::get('/theatres/{theatre_id}/screen', 'TheatresController@index_screen')->name('screen.index');

// Create Theatre SCREEN
Route::get('/theatres/{theatre_id}/screen/create', 'TheatresController@create_screen')->name('screen.create');

// Store Theatre SCREEN
Route::post('/theatres/{theatre_id}/screen', 'TheatresController@store_screen')->name('screen.store');

// Edit Theatre SCREEN
Route::get('/theatres/{theatre_id}/screen/{screen_id}/edit', 'TheatresController@edit_screen')->name('screen.edit');

// Update Theatre SCREEN
Route::put('/theatres/{theatre_id}/screen/{screen_id}', 'TheatresController@update_screen')->name('screen.update');

// Delete Theatre SCREEN
Route::delete('/theatres/{theatre_id}/screen/{screen_id}/delete', 'TheatresController@delete_screen')->name('screen.delete');




// Index Theatre SCHEDULE
Route::get('/theatres/{theatre_id}/schedule', 'TheatresController@index_schedule')->name('schedule.index');

// Create Theatre SCHEDULE
Route::get('/theatres/{theatre_id}/schedule/create/{movie_id}', 'TheatresController@create_schedule')->name('schedule.create');

// Store Theatre SCHEDULE
Route::post('/theatres/{theatre_id}/schedule', 'TheatresController@store_schedule')->name('schedule.store');

// Delete Theatre SCHEDULE
Route::delete('/theatres/{theatre_id}/schedule/{schedule_id}/delete', 'TheatresController@delete_schedule')->name('schedule.delete');



// Index Theatre SEATS
Route::get('/theatres/{seat_id}/seat', 'TheatresController@index_seat')->name('seat.index');




Route::get('/login', 'AuthController@login')->name('login');

Route::get('/admin_login', 'AuthController@admin_login')->name('dashboard');

Route::post('/auth', 'AuthController@auth')->name('auth');

Route::get('/logout', 'AuthController@logout')->name('logout');