<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followings', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->unsignedBigInteger('user_id')->comment('ユーザーID'); 
            $table->unsignedBigInteger('following_user_id')->comment('フォローしている人のID'); 

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete(); 
            $table->foreign('following_user_id')->references('id')->on('users')->cascadeOnDelete(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followings');
    }
}
