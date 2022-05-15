<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            // trueをつけると自動でコンプリメント
            $table->unsignedBigInteger('id', true);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('menu_id');
            $table->string('image');
            $table->integer('price');
            $table->longText('content');
            $table->unsignedTinyInteger('thickness');
            $table->unsignedTinyInteger('intensity');
            $table->unsignedTinyInteger('price_value');
            $table->unsignedTinyInteger('look');
            $table->unsignedTinyInteger('all');
            $table->unsignedTinyInteger('atmosphere');
            $table->unsignedTinyInteger('hospitality');
            $table->unsignedTinyInteger('access');

            // 論理削除
            $table->softDeletes();
            $table->timestamps();
            
            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('shop_id')->references('id')->on('shops')->cascadeOnDelete();
            $table->foreign('menu_id')->references('id')->on('menus')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
