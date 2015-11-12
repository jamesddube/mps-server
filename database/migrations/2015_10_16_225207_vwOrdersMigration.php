<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VwOrdersMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $statement =
            "CREATE

            VIEW `vw_orders` AS
                select
                    `orders`.`order_id` AS `order_id`,
                    `orders`.`customer_id` AS `customer_id`,
                    `orders`.`sales_rep` AS `sales_rep_id`,
                    concat(`users`.`name`,' ', `users`.`surname`) AS `sales_rep`,
                    `orders`.`order_status` AS `order_status`,
                    `sync_status`.`status` AS `status`
                from
                    ((`orders`
                    left join `users` ON ((`orders`.`sales_rep` = `users`.`user_code`)))
                    left join `sync_status` ON ((`sync_status`.`id` = `orders`.`sync_status`)))";

        DB::statement($statement);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $statement = "DROP VIEW `mps`.`vw_orders`";

        DB::statement($statement);
    }
}
