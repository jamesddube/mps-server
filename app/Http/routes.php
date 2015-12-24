        <?php


        /*
        |--------------------------------------------------------------------------
        | Regular Web Routes
        |--------------------------------------------------------------------------
        |
        | The web interface
        |
        */


        // Resource routes...
        Route::get('/','DashboardController@index');
        Route::resource('orders' , 'OrderController');
        Route::resource('users' , 'UserController');

        // Authentication routes...
        Route::get('auth/login', 'Auth\AuthController@getLogin');
        Route::post('auth/login', 'Auth\AuthController@postLogin');
        Route::get('auth/logout', 'Auth\AuthController@getLogout');

        // Registration routes...
        Route::get('auth/register', 'Auth\AuthController@getRegister');
        Route::post('auth/register', 'Auth\AuthController@postRegister');




        /*
        |--------------------------------------------------------------------------
        | API Routes
        |--------------------------------------------------------------------------
        |
        | These are all the routes registered for the API
        |
        */

        use App\Customer;
        use App\vwOrder;

        $api = app('Dingo\Api\Routing\Router');

        $api->version('v1', function ($api) {

                $api->resource('/orders', 'App\Http\Controllers\Api\OrderController');
                $api->resource('/users', 'App\Http\Controllers\Api\UserController');
                $api->resource('/products', 'App\Http\Controllers\Api\ProductController');
        });

        /*
        * Oauth 2 server
        */
        App::singleton('oauth2' , function ()
        {
            $storage = new OAuth2\Storage\Pdo(array('dsn' => 'mysql:dbname=it;host=localhost' , 'username' => 'root' , 'password' => 'sead2301'));
            $server = new OAuth2\Server($storage);

            $server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));
            $server->addGrantType(new OAuth2\GrantType\UserCredentials($storage));

            return $server;
        });


        /*============================== API ==================================*

        Route::group(['prefix' => 'api'] , function ()
        {


            Route::post('oauth/token' , function ()
            {

                $bridgedRequest = OAuth2\HttpFoundationBridge\Request::createFromRequest(Request::instance());
                $bridgedResponse = new OAuth2\HttpFoundationBridge\Response();

                $bridgedResponse = App::make('oauth2')->handleTokenRequest($bridgedRequest , $bridgedResponse);

                return $bridgedResponse;
            });



            Route::group(['middleware' => ['oauth','json']] , function ()
            {
                Route::resource('sales','Api\SalesController',['only' => ['index', 'show']]);
                Route::post('/test/sample' , 'DashboardController@gen');
                Route::post('/sync' , 'Api\SyncController@index');
                Route::post('orders/sync' , 'Api\OrderController@sync');
                Route::resource('orders' , 'Api\OrderController');
                Route::resource('order_details' , 'Api\OrderDetailController');
                Route::resource('customers' , 'Api\CustomerController');
                Route::resource('products' , 'Api\ProductController');
                Route::get('products/hey' , 'Api\ProductController@hey');
                Route::resource('users' , 'Api\UserController');


                Route::get('/' , function ()
                {

                    return response()->json(['message' => "welcome to the mps api"] , 200);
                });

                Route::any('/{id}' , function ($id)
                {
                    return \App\Http\Controllers\Api::genMessage("invalid or non existent api route, $id" , true , "invalid route");
                });
            });

        });
**/
