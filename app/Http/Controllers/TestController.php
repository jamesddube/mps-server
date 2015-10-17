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
    
    public static function sample($number = 2)
    {
        $faker = Factory::create();
        for($i = 0 ; $i < $number ; $i++)
        {
            $order_id = $faker->numerify('OD-########');
            $Item[] = array
            (
                "order_id" => $order_id,
                "customer_id" => ucfirst($faker->randomLetter).$faker->numerify('-###'),
                "sales_rep" => strtolower($faker->firstName."@mbc.co.zw"),
                "order_status" => $faker->randomElement($array = array ('draft','unprocessed','processed')),
                "sync_status" =>1,
            );

            $lineItem[] = array
            (
                "order_details_id" => $order_id.$faker->numerify("-##"),
                "order_id" => $order_id,
                "product_id" => $faker->randomDigit.'0'.$faker->randomDigit.'0',
                "quantity" => $faker->randomNumber(2),
            );

        }

        return json_encode($Item);
    }

    public function req()
    {
        $m = new OrderDetailsModel();

        dd($m->exists('OD-100-00j'));


    }

    public function gen()
    {
       $s = self::sample(3);

      $orders = Api::getModelsFromJson($s);

      $user = User::find(2);

      return $orders = $user->orders()->save($orders[0]);


    }



}
