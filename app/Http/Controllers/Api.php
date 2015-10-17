<?php

namespace App\Http\Controllers;

use App\OrderDetailsModel;
use App\OrderModel;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class Api extends Controller
{
    //

    /**
     * @desc An instance of the OrderModel Class
     * @var OrderModel
     */
    private static $model = array();

    /**
     * @var \StdClass
     */
    private static $jsonObject;

    /**
     * @var array
     */
    private static $modelAttributes;

    public static function isJson($input)
    {
        if(is_string($input))
        {
            if(json_decode($input))
            {
                return true;
            }

        }

        throw new BadRequestHttpException ("invalid json string");

    }


    public static function validateOrder($string)
    {
        foreach (self::$modelAttributes as $attribute) {
                if (is_null(object_get($string, $attribute))) {
                    throw new Exception ("required order attribute $attribute, not found");
                }
            }
    }

    public static function hasLineItems($string)
    {
        if (is_null(object_get($string, 'order_details'))) {
            throw new Exception ("required 'order_details' attribute not found or is not in the correct format");
        }
    }

    /**
     * @param $order OrderModel
     * @param $model Model
     * @internal param $i
     */
    public static function setAttributes($order,$model)
    {
        foreach (self::$modelAttributes as $attribute)
        {
            $model->setAttribute($attribute, $order->$attribute);
        }

    }

    public static function init(Model $model_class)
    {
        self::$model[] =  new $model_class();
        self::$modelAttributes = self::$model[0]->getFillable();
    }

    public static function save()
    {
        self::$model->save();
    }


    /**
     * @param $error_type
     * @param $error_desc
     * @return \Illuminate\Http\JsonResponse
     */
    public static function genError($error_type,$error_desc)
    {
        return response()->json(['error' => $error_type,'error_description' => $error_desc]);
    }

    /**
     * @param $msg_desc
     * @return \Illuminate\Http\JsonResponse
     */
    public static function genMessage($msg_desc)
    {
        return response()->json(['error'=> false,'message' => $msg_desc]);
    }

    /**
     * @param $input_string
     * @param Model $model
     * @return OrderModel
     * @throws Exception
     */
    public static function getModelsFromJson($input_string, Model $model)
    {
        if(self::isJson($input_string))
        {
            $orders = json_decode($input_string);

            self::init($model);

            for($i = 0; $i<count($orders); $i++)
            {
                self::$model[$i] = new $model();

                self::validateOrder($orders[$i]);
                self::setAttributes($orders[$i],self::$model[$i]);
            }

            return self::$model;
        }
    }

    public static function getObject($input)
    {
        if(self::isJson($input))
        {
            return self::$jsonObject = json_decode($input);
        }
    }

    public static function getObjectAttribute($attribute)
    {
        try{
            return self::$jsonObject->$attribute;
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }

}
