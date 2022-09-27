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
        
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->text('visi');
            $table->text('misi');
            $table->text('deskripsi');
            $table->string('no_contact');
            $table->text('alamat');
            $table->string('email');
            $table->string('ig_url');
            $table->string('twitter_url');
            $table->string('fb_url');
            $table->string('youtube_url');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->timestamps();
        });
        
        Schema::create('keunggulan', function (Blueprint $table) {
            $table->id();
            $table->text('keunggulan');
            $table->string('url_metafor');
            $table->unsignedBigInteger('about_us_id');
            $table->unsignedBigInteger('users_id');
            $table->foreign('about_us_id')->references('id')->on('about_us')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users');
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
        Schema::dropIfExists('tabel_about_us');
        Schema::dropIfExists('tabel_keunggulan');
    }
};
