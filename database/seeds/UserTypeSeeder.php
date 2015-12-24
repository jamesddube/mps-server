<?php

use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_types')->insert([
            'name'     => 'Sales Representative',
        ]);

        DB::table('user_types')->insert([
            'name'     => 'Manager',
        ]);

        DB::table('user_types')->insert([
            'name'     => 'Administrator',
        ]);
    }
}
