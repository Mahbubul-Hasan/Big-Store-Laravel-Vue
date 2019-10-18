<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('category_id');

            $table->string('name', 60)->unique();
            $table->string('slug', 60)->unique();
            $table->string('code', 60)->unique();
            $table->decimal('price', 10, 2);
            $table->decimal('offer_price', 10, 2)->default(0.00);
            $table->text('short_description');
            $table->text('long_description');
            $table->tinyInteger('stock')->default(1);
            $table->tinyInteger('popular')->default(0);
            $table->tinyInteger('active')->default(1);
            $table->string('photo');

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
