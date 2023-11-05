<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web', function (Blueprint $table) {
            $table->id();
            $table->text("seo_keyword")->nullable(); 

            $table->text("hero_title")->nullable(); 
            $table->text("hero_subtitle")->nullable(); 
            $table->text("hero_picture")->nullable(); 

            $table->text("layanan_title")->nullable(); 

            $table->text("solusi_title")->nullable(); 
            $table->text("solusi_subtitle")->nullable(); 

            $table->text("testimonial_title")->nullable(); 

            $table->text("about_detail_title")->nullable(); 
            $table->text("about_detail_subtitle")->nullable(); 
            $table->text("about_detail_picture")->nullable(); 

            $table->text("pricing_title")->nullable(); 
            $table->text("pricing_subtitle")->nullable(); 

            $table->text("pricing_detail_title")->nullable(); 
            $table->text("pricing_detail_subtitle")->nullable(); 
            $table->text("pricing_detail_picture")->nullable(); 

            $table->text("faq_title")->nullable(); 

            $table->text("cta_title")->nullable(); 
            $table->text("cta_subtitle")->nullable(); 

            $table->text("footer_desc")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('web');
    }
};
