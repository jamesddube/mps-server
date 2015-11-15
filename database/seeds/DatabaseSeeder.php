<?php

use App\Http\Controllers\Api;
use App\OrderModel;
use App\User;
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

        //$this->all(1,5,5);
        //$this->call(SyncStatusSeeder::class);
        //$this->call(OrderStatusSeeder::class);
        //$this->call(UserTypeSeeder::class);

//        dd(factory(App\OrderDetail::class, 2)->make());
        factory(App\User::class, 2)->create();
        factory(App\Product::class, 2)->create();
        factory(App\Order::class, 200)->make()
            ->each(function($o){
            $id = $o->id;
            $o->save();
            $o = \App\Order::find($id);
            $o->lineItems()->save(factory(\App\OrderDetail::class)->make());
        });


        Model::reguard();

    }





    public function user()
    {
        $user = Api::sample(new User(),1);

        $user = Api::getObject($user);

        DB::table('users')->insert(get_object_vars($user[0]));
    }

    public function order()
    {
        $order = Api::sample(new OrderModel());

        $order = Api::getObject($order);

        DB::table('orders')->insert(get_object_vars($order[0]));


    }

    /**
     * @param int $user
     * @param int $orders
     * @param int $order_details
     * @throws Exception
     */
    public function all($user = 1,$orders = 1, $order_details = 2)
    {
        $user = Api::sample(new User(),$user);

        $user = Api::getObject($user);





        ///DB::table('users')->insert(get_object_vars($user[0]));

        foreach($user as $u)
        {
            DB::table('users')->insert(get_object_vars($u));

            $order = Api::sample(new OrderModel(),$orders);

            $order = Api::getObject($order);

            foreach($order as $o)
            {
                $o->sales_rep = $u->user_code;

                print_r("order: ".$o->order_id."\n");

                DB::table('orders')->insert(get_object_vars($o));

                echo "saved"."\n";

                $order_d = Api::sample(new \App\OrderDetailsModel(),$order_details);

                $order_d = Api::getObject($order_d);

                foreach($order_d as $line)
                {
                    $line->order_id = $o->order_id;
                    echo "lineItem : ".$line->order_details_id."\n";
                    DB::table('order_details')->insert(get_object_vars($line));

                }


            }

            echo "\n\n";

        }

die();


    }
}
