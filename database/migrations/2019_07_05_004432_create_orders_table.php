<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');

//            $table->unsignedBigInteger('user_id');

            $table->string('customer_name', 50);
            $table->string('customer_email', 50)->nullable();
            $table->string('customer_phone', 50);
            $table->decimal('delivery', 10, 2);
            $table->string('customer_address', 100);

            $table->decimal('total_price', 10, 2);
            $table->decimal('discount_price', 10, 2)->default(0.00);

            $table->string('payment_method', 20)->default("Cash On Delivery");
            $table->string('status', 10)->default("Pending");
            $table->timestamps();

//            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
