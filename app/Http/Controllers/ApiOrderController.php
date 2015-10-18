<?php

namespace App\Http\Controllers;

use App\OrderDetailsModel;
use App\OrderModel;
use App\User;
use App\vwOrdersModel;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiOrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $orders = vwOrdersModel::all()
            ->each(function(vwOrdersModel $o)
            {
                $o->lineItems;
            });

        return $orders;

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
     * @var OrderModel $model
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**@var OrderModel $model*/

        $orderArray = Api::sample(new OrderModel());

        try
        {
            $objArray = Api::getObject($orderArray);

            $models_o = Api::getModelsFromJson($objArray,new OrderModel());

            foreach($models_o as $model)
            {
                $model->save();
            }

            return Api::genMessage("orders saved");
        }
        catch(Exception $e)
        {
            return Api::genMessage($e->getMessage(),true,"order processing error");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        /** @var OrderModel $results */
        $results = vwOrdersModel::find($id);
        is_object($results) ? $results->lineItems : null;
        return !is_null($results) ? $results : Api::genMessage
        (
            'the requested order could not be found or does not exist',
            true,
            'order not found'
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}