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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    $api->get('protected', function() {
        return response()->json([
            'message' => 'Access to protected resources granted! You are seeing this text as you provided the token correctly.'
        ]);
    });

    $api->get('refresh', [
        'middleware' => 'jwt.refresh',
        function() {
            return response()->json([
                'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
            ]);
        }
    ]);

    $api->post("user/register",'App\\Api\\V1\\Controllers\\UserController@register');
    $api->post("user/login",'App\\Api\\V1\\Controllers\\UserController@login');
});

$api->version('v2', function ($api) {

    $api->get('protected', function() {
        return response()->json([
            'message' => 'Access to protected resources granted! You are seeing this text as you provided the token correctly.'
        ]);
    });

    $api->get('refresh', [
        'middleware' => 'jwt.refresh',
        function() {
            return response()->json([
                'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
            ]);
        }
    ]);

    $api->post("user/register",'App\\Api\\V2\\Controllers\\UserController@register');
    $api->post("user/login",'App\\Api\\V2\\Controllers\\UserController@login');
});


/*
Route::post('user/register', 'APIRegisterController@register');
Route::post('user/login', 'APILoginController@login');

Route::middleware('jwt.auth')->get('users', function(Request $request) {
    return auth()->user();
});
Route::group(['middleware' => 'jwt.auth'], function(){
    Route::get('user/logout', 'APILoginController@logout');
});
*/