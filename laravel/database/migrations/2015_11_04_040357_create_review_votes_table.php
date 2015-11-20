<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_votes', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->integer('prod_id')->unsigned();
            $table->foreign('prod_id')->references('prod_id')->on('products');

            $table->integer('this_uid')->unsigned();
            $table->foreign('this_uid')->references('user_id')->on('users');

            $table->integer('other_uid')->unsigned();
            $table->foreign('other_uid')->references('user_id')->on('users');

            $table->primary(['prod_id', 'this_uid', 'other_uid']);  // composite PK
            $table->integer('vote'); // upvote = 1 , downvote = -1
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('review_votes');
    }
}
