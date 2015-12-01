<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users');

            $table->integer('prod_id')->unsigned();
            $table->foreign('prod_id')->references('prod_id')->on('products');

            $table->primary(['user_id', 'prod_id']);  // composite PK

            $table->integer('total_usefulness')->default(0); // Running upvote and downvote count. Initial count for all is zero
            $table->smallInteger('overal_rating')->nullable();
            $table->string('review_text');  // string because review is limited to up to 254 chars
            $table->boolean('needsAdminReview')->default(false);
            $table->timestamps();  // same as date
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reviews');
    }
}
