<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('created_user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('created_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_tags');
    }
}
