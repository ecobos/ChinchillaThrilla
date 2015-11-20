<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->integer('feature_id')->unsigned();
            $table->foreign('feature_id')->references('feature_id')->on('features');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('user');

            $table->integer('prod_id')->unsigned();
            $table->foreign('prod_id')->references('prod_id')->on('product');

            $table->primary(['feature_id', 'user_id', 'prod_id']);  // composite PK

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tags');
    }
}
