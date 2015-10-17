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
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $s = TestController::sample(2);

        try
        {
            $models = Api::getModelsFromJson($s,new OrderModel());


            foreach($models as $model)
            {
                $model->save();
            }

            return Api::genMessage("orders saved");
        }
        catch(Exception $e)
        {
            return Api::genError("order processing error",$e->getMessage());
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

        $results = vwOrdersModel::find($id);
        return count($results) > 0 ? $results : Api::genError
        (
            'invalid order',
            'the requested order could not be found or does not exist'
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
        //
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