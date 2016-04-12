<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// admin login
Route::get('/admin/login', 'IndexController@index');
Route::post('/admin/login', 'IndexController@login');

// admin dashboard
Route::get('/admin/dashboard', 'AdminController@index');

// admin client
Route::get('/admin/client', 'ClientController@index');
Route::post('/admin/client', 'ClientController@add');
Route::delete('/admin/client/{id}', 'ClientController@destroy');

// admin user
Route::get('/admin/user', 'UserController@index');
Route::post('/admin/user', 'UserController@add');

// user login
Route::get('/login', 'UserController@login');
Route::post('/login', 'UserController@verify');
Route::get('/profile', 'UserController@get');

// home
Route::get('/', function () {
    return view('welcome');
});

// OAuth 2
Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

// Route::get('oauth/authorize', ['as' => 'oauth.authorize.get', 'middleware' => ['check-authorization-params', 'auth'], function() {
Route::get('oauth/authorize', ['as' => 'oauth.authorize.get', 'middleware' => ['check-authorization-params'], function() {
    $authParams = Authorizer::getAuthCodeRequestParams();

    $formParams = array_except($authParams,'client');

    $formParams['client_id'] = $authParams['client']->getId();

    $formParams['scope'] = implode(config('oauth2.scope_delimiter'), array_map(function ($scope) {
        return $scope->getId();
    }, $authParams['scopes']));

    return View::make('oauth.authorization-form', ['params' => $formParams, 'client' => $authParams['client']]);
}]);

// Route::post('oauth/authorize', ['as' => 'oauth.authorize.post', 'middleware' => ['csrf', 'check-authorization-params', 'auth'], function() {
Route::post('oauth/authorize', ['as' => 'oauth.authorize.post', 'middleware' => ['csrf', 'check-authorization-params'], function() {

    $params = Authorizer::getAuthCodeRequestParams();
    $params['user_id'] = 0;//Auth::user()->id;
    $redirectUri = '/';

    // If the user has allowed the client to access its data, redirect back to the client with an auth code.
    if (Request::has('approve')) {
        $redirectUri = Authorizer::issueAuthCode('user', $params['user_id'], $params);
    }

    // If the user has denied the client to access its data, redirect back to the client with an error message.
    if (Request::has('deny')) {
        $redirectUri = Authorizer::authCodeRequestDeniedRedirectUri();
    }

    return Redirect::to($redirectUri);
}]);
