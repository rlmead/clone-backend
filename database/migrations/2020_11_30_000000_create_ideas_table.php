<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('status');
            $table->string('image_url')->nullable();
            $table->unsignedBigInteger('ref_location_id')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('idea_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ref_idea_id');
            $table->unsignedBigInteger('ref_user_id');
            $table->string('user_role');
            $table->timestamps();

            $table->unique(['ref_idea_id', 'ref_user_id']);

            $table->foreign('ref_idea_id')->references('id')->on('ideas')->onDelete('cascade');
            $table->foreign('ref_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ideas');
    }
}