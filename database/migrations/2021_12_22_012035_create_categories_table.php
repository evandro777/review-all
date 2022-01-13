<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->json('fields_params')->nullable();
            $table->unsignedBigInteger('category_parent_id')->nullable();
            $table->unsignedBigInteger('created_user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_parent_id')->references('id')->on('categories');
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
        Schema::dropIfExists('categories');
    }
}
