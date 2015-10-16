<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatureRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_rating', function (Blueprint $table) {

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('user');

            $table->integer('prod_id')->unsigned();
            $table->foreign('prod_id')->references('prod_id')->on('product');

            $table->integer('feature_id')->unsigned();
            $table->foreign('feature_id')->references('feature_id')->on('feature');

            $table->primary(['user_id', 'prod_id', 'feature_id']);  // composite PK

            $table->integer('rating')->default($value = 0);
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
        Schema::drop('feature_rating');
    }
}
