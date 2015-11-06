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
        Schema::create('products', function (Blueprint $table) {
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

            // Defines if the product needs admin approval before being published onto the live site
            $table->boolean('isPublished')->default(false); // all new products need to be manually published by an admin

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
        Schema::drop('products');
    }
}
