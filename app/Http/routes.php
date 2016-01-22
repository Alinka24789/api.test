<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
 */


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Profile routes
Route::get('/', 'WelcomeController@index');


// Api routes 
Route::group(['prefix' => '/v1', 'middleware' => 'oauth'], function() {

    Route::group(['prefix' => '/categories'], function() {

        Route::get('/', 'v1\CategoryController@all');
        Route::get('/{id}', 'v1\CategoryController@show');
        Route::post('/', 'v1\CategoryController@add');
        Route::put('/{id}', 'v1\CategoryController@update');
        Route::delete('/{id}', 'v1\CategoryController@delete');
    });

    Route::group(['prefix' => '/products'], function() {

        Route::get('/', 'v1\ProductController@all');
        Route::get('/{id}', 'v1\ProductController@show');
        Route::post('/', 'v1\ProductController@add');
        Route::put('/{id}', 'v1\ProductController@update');
        Route::delete('/{id}', 'v1\ProductController@delete');
    });

    Route::get('/categories/{id}/products', 'v1\ProductController@showByCategory');
});

// Get access token routes
Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});


//Register test user
Route::get('/register', function() {
    $user = new App\User();
    $user->name = "test user";
    $user->email = "test@test.com";
    $user->password = \Illuminate\Support\Facades\Hash::make("password");
    $user->save();
    
    return response()->json(['User created' => ['email' => 'test@test.com', 'password' => 'password']]);
});



