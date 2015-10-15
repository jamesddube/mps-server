<?php

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
        // $this->call(UserTableSeeder::class);
        //factory(App\User::class, 50)->create();
        factory(App\OrderModel::class, 10)->create();
        //factory(App\OrderDetailsModel::class, 50)->create();

        Model::reguard();
    }
}
