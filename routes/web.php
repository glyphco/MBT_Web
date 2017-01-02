<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */
Route::get('/', function () {
	return view('welcome');
});
Route::get('/redirect/{service}', 'SocialAuthController@redirect');
Route::get('/callback/{service}', 'SocialAuthController@callback');
Route::get('/gettoken/{service}', 'JWTAuthController@gettoken');
Route::get('/test', 'TestController@test');
//Route::get ( '/servetoken/{service}', 'JWTController@gettoken' );

Route::get('/home', 'HomeController@home');
