<?php

namespace App\Http\Controllers;

use App\OrderDetailsModel;
use App\OrderModel;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiOrderController extends Controller
{
    /**
     * @desc An instance of the OrderModel Class
     * @var OrderModel
     */
    private  $apiOrder ;

    /**
     * @var OrderDetailsModel
     */
    private  $apiOrderDetails ;

    /**
     * @var array
     */
    private $orderAttributes;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = new OrderModel();

        return $orders->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $sample = new TestController();

        $sample = $sample->sample();

        if(json_decode($sample)){
            //json decoded

            $decoded_string = json_decode($sample);

            try
            {

                $this->init();

                $this->validateOrder($decoded_string[0]);

                //data sent in is ok

                $this->setAttributes($decoded_string[0]);

                $this->apiOrder->save();

            }
            catch(Exception $e)
            {
                return TestController::genError("order processing error",$e->getMessage());
            }
        }
        else
        {
            return TestController::genError("invalid json","we could no decode the json string");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if($orders = OrderModel::find($id))
        {
            return $orders;
        }
        else{
            return response()->json(['message' => "order $id not found"],200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /*
    |-------------------------------------------------------------------------
    | Custom Functions
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
   */

    public function validateOrder($string)
    {

        if($string)
        {
            foreach($this->orderAttributes as $attribute)
            {
                if(is_null(object_get($string,$attribute)))
                {
                    throw new Exception ("required order attribute $attribute, not found");
                }
            }
                if(is_null(object_get($string,'order_details') ) )
                {
                    throw new Exception ("required 'order_details' attribute not found or is not in the correct format");
                }
        }
    }

    /**
     * @param $order OrderModel
     */
    private function setAttributes($order)
    {
        foreach($this->orderAttributes as $attribute)
        {
            $this->apiOrder->setAttribute($attribute,$order->$attribute);
        }
    }

    private function init()
    {
        $this->apiOrder = new OrderModel();
        $this->apiOrderDetails = new OrderDetailsModel();
        $this->orderAttributes = $this->apiOrder->getFillable();
    }
}
