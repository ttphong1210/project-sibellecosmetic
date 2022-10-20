<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->Increments('prod_id');
            $table->string('prod_name');
            $table->string('prod_slug');
            $table->float('prod_price');
            $table->string('prod_img');
            $table->text('prod_des');
            $table->string('prod_promotion');
            $table->tinyInteger('prod_status');
            $table->tinyInteger('prod_featured');
            $table->integer('prod_cate')->unsigned();
            $table->foreign('prod_cate')
                    ->references('cate_id')
                    ->on('categories')
                    ->onDelete('cascade');
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
