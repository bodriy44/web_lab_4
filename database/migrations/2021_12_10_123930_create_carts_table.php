<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->decimal('total',12,2)->default(0);
            $table->unsignedBigInteger('count')->default(1);
            $table->timestamps();
        });

        Schema::create('carts_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cartId');
            $table->unsignedBigInteger('productId');
            $table->unsignedBigInteger('count')->default(1);
            $table->timestamps();

            $table->foreign('productId')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('cartId')->references('id')->on('carts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts_products', function(Blueprint $table){
            $table->dropForeign(['productId', 'cartsId']);
        });
        Schema::dropIfExists('carts');
        Schema::dropIfExists('carts_products');
    }
}
