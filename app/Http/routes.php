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

Route::get('/', function () {
    return view('pages.index');
});

Route::get('/login',function(){
    return view('auth.login');
});

Route::get('user',function(){
    return view('users.create');
});

Route::get('/test','TestController@req');
Route::get('/test/sample','TestController@gen');

Route::resource('order','OrderController');

/*
* Oauth 2 server
*/
App::singleton('oauth2',function(){
    $storage = new OAuth2\Storage\Pdo(array('dsn' => 'mysql:dbname=it;host=localhost', 'username' => 'root', 'password' => 'sead2301'));
    $server = new OAuth2\Server($storage);

    $server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));
    $server->addGrantType(new OAuth2\GrantType\UserCredentials($storage));

    return $server;
});




Route::group(['prefix' => 'api'],function()
{
    Route::post('oauth/token', function(){

        $bridgedRequest = OAuth2\HttpFoundationBridge\Request::createFromRequest(Request::instance());
        $bridgedResponse = new OAuth2\HttpFoundationBridge\Response();

        $bridgedResponse = App::make('oauth2')->handleTokenRequest($bridgedRequest,$bridgedResponse);

        return $bridgedResponse;
    });

    Route::group(['middleware' => 'oauth'],function()
    {
        Route::resource('orders','Api/OrderController');
        Route::resource('order_details','Api/OrderDetailsController');
        Route::resource('users','Api/UserController');

        Route::get('/',function(){

            return response()->json(['message' => "welcome to the mps api"],200);
        });

        Route::any('/{id}',function($id){
            return \App\Http\Controllers\Api::genMessage("invalid or non existent api route, $id",true,"invalid route");
        });
      });
});
