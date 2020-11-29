<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('following', function (Blueprint $table) {
//            $table->id();
//            $table->timestamps();

            $table->unsignedBigInteger('leading_user_id')->nullable();
            $table->foreign('leading_user_id')->references('id')->on('users');

            $table->unsignedBigInteger('following_user_id')->nullable();
            $table->foreign('following_user_id')->references('id')->on('users');

            $table->primary(['leading_user_id', 'following_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('following');
    }
}
