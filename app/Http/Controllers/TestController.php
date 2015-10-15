<?php

namespace App\Http\Controllers;

use App\OrderDetailsModel;
use App\OrderModel;
use Faker\Factory;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    //
    public function index()
    {
        $order = new OrderModel();

        //$order->addOrderDetails(1030,5);
        $order->setAttribute('order_id',500);

        $order_details = new OrderDetailsModel($order->order_id);

        $faker = Factory::create();



        dd($faker->randomElement($array = array ('draft','unprocessed','processed')));
    }

    public function get()
    {
        $orders = new OrderModel();

        return $orders->all();
    }
    
    public function sample()
    {
        $req = array
        (
            'order_id' => 'OD77778989',
            'customer_id' => 'M-238',
            'sales_rep' => 'jdube@mbc.co.zw',
            'order_status' => 'draft',
            'sync_status' => 'draft',
            'order_details' => array
            (
                1030 => 89,
                2030 => 67,
                6080 => 29,
                1090 => 890,
            )
        );

        $orders [] = $req;
        $orders [] = $req;

        return json_encode($orders);
    }

    public static function genError($error_type,$error_desc)
    {
        return response()->json(['error' => $error_type,'error_description' => $error_desc]);
    }

}
