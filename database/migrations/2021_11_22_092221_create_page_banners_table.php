<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_banners', function (Blueprint $table) {
            $table->id();
            $table->string('ncf_in_brief')->nullable();
            $table->string('vision_mission')->nullable();
            $table->string('milestone')->nullable();
            $table->string('governing_bodies')->nullable();
            $table->string('contact_us')->nullable();
            $table->string('habitat_foreign_green')->nullable();
            $table->string('habitat_marine_coastline')->nullable();
            $table->string('species')->nullable();
            $table->string('climate_change')->nullable();
            $table->string('environmental_education')->nullable();
            $table->string('policy_advocacy')->nullable();
            $table->string('our_community')->nullable();
            $table->string('e_library')->nullable();
            $table->string('news_update')->nullable();
            $table->string('other_resources')->nullable();
            $table->string('membership')->nullable();
            $table->string('bird_club')->nullable();
            $table->string('events')->nullable();
            $table->string('volunteer')->nullable();
            $table->string('support_nature')->nullable();
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
        Schema::dropIfExists('page_banners');
    }
}
