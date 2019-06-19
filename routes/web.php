<?php

Auth::routes();


Route::group(['middleware' => ['auth', 'pinterest']], function(){

    /**
     * API Routes
     */

    Route::get('/', 'HomeController@index');

    Route::get('/user', 'HomeController@getAuthUser');

    Route::get('/pins', 'HomeController@getPins');

    Route::get('/boards', 'HomeController@getBoards');

    Route::post('/pin', 'HomeController@createPin');

    Route::post('/pin/edit', 'HomeController@editPin');

    Route::get('/following/users', 'HomeController@getFollowingUsers');

    Route::get('/following/boards', 'HomeController@getFollowingBoards');

    Route::get('/following/interest', 'HomeController@getFollowingInterests');

    Route::post('/follow/user', 'HomeControlloer@followUser');

    Route::post('/follow/board', 'HomeControlloer@followBoard');

    Route::post('/follow/interest', 'HomeControlloer@followInterest');

    Route::post('/unfollow/user', 'HomeControlloer@unfollowUser');

    Route::post('/unfollow/board', 'HomeControlloer@unfollowBoard');

    Route::post('/unfollow/interest', 'HomeControlloer@unfollowInterest');

    /**
     * Authorization Routes
     */
    Route::get('/login/pinterest', 'Auth\PinterestController@redirectToPinterestProvider');

    Route::get('/login/pinterest/callback', 'Auth\PinterestController@handlePinterestProviderCallback');
});





