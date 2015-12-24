<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Intersect\Api\Response\Json;

class JsonMiddleware
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

        if($request->isJson())
        {
            return $next($request);
        }
        else
        {
            return Json::response(['error'=>true,'message_info' => 'invalid input format, make sure your requests are in json'],Response::HTTP_BAD_REQUEST);
        }

    }
}
