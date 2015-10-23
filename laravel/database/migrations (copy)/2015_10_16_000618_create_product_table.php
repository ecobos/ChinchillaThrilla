<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('prod_id');
            $table->string('prod_name');
            $table->string('prod_model');

            $table->integer('prod_brand')->unsigned();
            $table->foreign('prod_brand')->references('brand_id')->on('brand');

            $table->integer('prod_category')->unsigned();
            $table->foreign('prod_category')->references('category_id')->on('category');

            $table->text('prod_description');
            $table->integer('overall_rating');
            $table->string('prod_img_path');


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
        Schema::drop('product');
    }
}
