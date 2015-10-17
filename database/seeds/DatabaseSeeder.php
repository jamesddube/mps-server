<?php

use App\OrderModel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        //$this->call(UserTableSeeder::class);
        //factory(App\User::class, 4)->create();
        factory(App\User::class, 2)->create()->each(function($u)
        {
                $order = factory(App\OrderModel::class)->make();
                $id = $order->order_id;
                $u->orders()->save($order);
                $order_detail = factory(App\OrderDetailsModel::class, 1)->create();
                $order = OrderModel::find($id);
                $order->lineItems()->save($order_detail);
        });
        //factory(App\OrderModel::class, 10)->create();
        //factory(App\OrderDetailsModel::class, 50)->create();



        Model::reguard();
    }
}
