<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'API'], function () {
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::post('register', 'RegisterController');
        Route::post('forget-password','ForgetController');
        Route::post('forget-verify','ForgetVerifyController');
        Route::post('verify', 'VerifyController');
        Route::post('get-otp', 'GetOTPController');
        Route::post('login', 'LoginController');
        Route::get('me', 'MeController');
        Route::post('logout', 'LogoutController');
    });
    

    Route::get('teams', 'TeamController');
    Route::get('options', 'OptionController');
    Route::get('fixtures', 'FixtureController');
    Route::get('leaderboard', 'LeaderboardController');
    Route::get('home-data', 'HomeController');


    Route::middleware('auth:api')->group(function () {
        Route::post('prediction', 'PredictionController@postPrediction');
        Route::get('prediction', 'PredictionController@getPredictionList');

        Route::post('profile', 'ProfileController@uploadImage');
    });
});
