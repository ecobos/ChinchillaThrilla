<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatureRatingTotalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_rating_totals', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('prod_id')->unsigned();
            $table->foreign('prod_id')->references('prod_id')->on('products');

            $table->integer('feature_id')->unsigned();
            $table->foreign('feature_id')->references('feature_id')->on('features');

            $table->primary(['prod_id', 'feature_id']);  // composite PK

            $table->bigInteger('score')->default(0); // values can be neg or pos
            $table->unsignedBigInteger('total_votes')->default(0);  // We assume that total votes can't be negative
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
        Schema::drop('feature_rating_totals');
    }
}
