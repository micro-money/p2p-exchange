<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('recover', 'AuthController@recover');
Route::get('login/google',array('as'=>'glogin','uses'=>'AuthController@googleLogin')) ;
Route::get('login/facebook', 'AuthController@redirectToFacebook');
Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('logout', 'AuthController@logout');

    Route::resource('assets',              'AssetController');
    Route::resource('asset_types',         'AssetTypeController');
    Route::resource('banks',               'BankController');
    Route::resource('currencies',          'CurrencyController');
    Route::resource('deals',               'DealController');
    Route::resource('deal_histories',      'DealHistoryController');
    Route::resource('deal_stages',         'DealStageController');
    Route::resource('favorite_currencies', 'FavoriteCurrencyController');
    Route::resource('market_histories',    'MarketHistoryController');
    Route::resource('notifications',       'NotificationController');
    Route::resource('orders',              'OrderController');
    Route::resource('rate_sources',        'RateSourceController');
    Route::resource('callbacks',           'CallbackController');
    Route::resource('settings',            'SettingsController')
        ->only(['show', 'update']);

    Route::post('orders/filter','OrderController@filter');
    Route::post('deals/{deal}/pay', 'DealController@pay');
    Route::post('deals/{deal}/release', 'DealController@release');
});






Route::get('user/verify/{verification_code}', 'AuthController@verifyUser');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.request');
Route::post('password/reset', 'AuthController@resetPassword')->name('password.reset');

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//Route::resource('banks', 'BankController');

