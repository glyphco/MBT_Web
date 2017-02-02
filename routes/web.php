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

//This is the callbacks for authentication
//Sends you to SocialAuth
Route::get('/redirect/{service}', 'SocialAuthController@redirect');
//Come back from SocialAuth
Route::get('/callback/{service}', 'SocialAuthController@callback');
//Go to the Auth Sever to get a JWT
//Route::get('/gettoken/{service}', 'JWTAuthController@gettoken');

//Route::get('/test', 'TestController@test');

Route::get('/login', 'LoginController');
Route::get('/logout', 'LogoutController');

Route::get('/location', function () {
    return view('location');
});

Route::get('/map', function () {
    return view('map');
});

Route::group(['middleware' => 'JWTCookieExists'], function () {

    Route::get('/mbt', function () {
        return view('layouts.mbt');
    })->name('testlayout');

    Route::get('/', 'HomepageController');
    Route::get('/me', 'MeController');

    Route::get('/event', 'EventController')->name('events');
    Route::get('/events', 'EventController')->name('events');
    Route::get('/event/{id}', 'EventController');

    Route::get('/venues', 'VenueController@index')->name('venues');
    Route::get('/venue/map', 'VenueController@map');
    Route::get('/venue', 'VenueController@index')->name('venue.index');
    Route::get('/venue/{id}', 'VenueController@show')->name('venue.show');
    Route::get('/venue/{id}/edit', 'VenueController@edit')->name('venue.edit');
    Route::get('/venue/create', 'VenueController@create')->name('venue.create');
    Route::post('/venue', 'VenueController@store')->name('venue.store');
    Route::put('/venue/{id}', 'VenueController@update')->name('venue.update');
    Route::delete('/venue/{id}', 'VenueController@destroy')->name('venue.destroy');

    Route::get('/venue/{id}/{name}', 'VenueController@show')->name('venue.showname');

    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/profiles', 'ProfileController@index')->name('profiles');
    Route::get('/profile/{id}', 'ProfileController@show');
    Route::get('/profile/{id}/{name}', 'ProfileController@show');

    Route::get('/newvenue', function () {
        return view('pages.newvenue');
    })->name('testlayout');

    Route::group(['prefix' => 'backstage'], function () {

        Route::get('/', 'backstage\IndexController');
        Route::post('sendsms', 'tests\TestSMSController@sendsms');
        Route::post('getfile', 'tests\TestGetFileController@getfile');
        Route::get('timezones', 'tests\TestTimezonesController@index');

    });

});
