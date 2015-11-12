<?php

namespace App\Http\Controllers\Api;

use App\OrderDetailsModel;
use App\OrderModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders_details = new OrderDetailsModel();

        return $orders_details->all();
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

        $objectArray = Api::sample(new OrderDetailsModel());

        try
        {
            $objectArray = Api::getObject($objectArray);

            $models = Api::getModelsFromJson($objectArray,new OrderDetailsModel());

            foreach($models as $model)
            {
                $model->save();
            }

            return Api::genMessage("order details saved");
        }
        catch(\Exception $e)
        {
            return Api::genMessage($e->getMessage(),true);
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
        if($orders_details = OrderDetailsModel::find($id))
        {
            return $orders_details;
        }
        else{
            return response()->json(['message' => "order_detail $id not found"],200);
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
}
