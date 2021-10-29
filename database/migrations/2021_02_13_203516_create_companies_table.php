<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('fullname')->nullable();
            $table->string('shortname')->nullable();
            $table->string('email')->nullable();
            $table->string('email2')->nullable();
            $table->string('tel')->nullable();
            $table->string('tel2')->nullable();
            $table->string('tel3')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->text('shortdescrpt')->nullable();
            $table->text('fulldescrpt')->nullable();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->text('value')->nullable();
            $table->text('keywords')->nullable();
            $table->text('meta_descrpt')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('about')->nullable();
            $table->text('terms')->nullable();
            $table->text('privacy')->nullable();
            $table->string('currency')->nullable();
            $table->string('youtube_video')->nullable();
            $table->string('mail_host')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_secure')->nullable();
            $table->string('mail_debug')->nullable();
            $table->string('mail_auth')->nullable();
            $table->string('sms_host')->nullable();
            $table->string('sms_username')->nullable();
            $table->string('sms_password')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
