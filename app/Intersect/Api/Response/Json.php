<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 12/9/15
 * Time: 4:26 PM
 */

namespace Intersect\Api\Response;


class Json
{
    public static function response($input , $code = 200)
    {
        $response =
            [
                'error' => false ,
                'message_info' => null ,
                'message_data' => null
            ];

        foreach ($response as $key => $value)
        {
            $response[ $key ] = isset($input[ $key ]) ? $input[ $key ] : $response[ $key ];
        }

        $code = $response['error'] === true ? 501 : $code;

        return response()->json($response , $code);
    }

}