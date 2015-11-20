<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewUsefulnessVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_usefulness_votes', function (Blueprint $table) {
            $table->integer('this_user_id')->unsigned();
            $table->foreign('this_user_id')->references('user_id')->on('user');

            $table->integer('other_user_id')->unsigned();
            $table->foreign('other_user_id')->references('user_id')->on('user');

            $table->primary(['this_user_id', 'other_user_id']);  // composite PK
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
        Schema::drop('review_usefulness_votes');
    }
}
