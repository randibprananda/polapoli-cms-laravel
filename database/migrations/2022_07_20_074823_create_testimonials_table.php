<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string("picture");
            $table->tinyInteger("status")->default(1)->comment("1: Active, 2: Nonactive");
            $table->string("title")->nullable(); 
            $table->string("designation")->nullable(); 
            $table->string("description")->nullable(); 
            
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testimonials');
    }
}
