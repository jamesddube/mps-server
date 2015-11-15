<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api;
use Closure;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Request;
use OAuth2\HttpFoundationBridge\Request as OauthRequest;

class OauthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
        if(!$request->has('access_token'))
        {
            return Api::genMessage('access token not found',true,"oauth error");
        }

        $req = Request::createFromGlobals();
        $brigedRequest = OauthRequest::createFromRequest($req);
        $brigedResponse = new \OAuth2\HttpFoundationBridge\Response();

        if(!$token = App::make('oauth2')->getAccessTokenData($brigedRequest,$brigedResponse))
        {
            $response = App::make('oauth2')->getResponse();

            if($response->isClientError() && $response->getParameter('error'))
            {
                if($response->getParameter('error') == 'expired_token')
                {
                    return Api::genMessage('the access token provided has expired',true);
                }

                return Api::genMessage('the access token provided is invalid',true,"oauth error");
            }
        }
        else
        {
            $request['user_id'] = $token['user_id'];
        }

        return $next($request);
    }
}
