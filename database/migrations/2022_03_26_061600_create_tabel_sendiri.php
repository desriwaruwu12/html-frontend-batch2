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
        Schema::create('testimonial', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->string('jenis');
            $table->string('url_foto');
            $table->timestamps();
        });

        Schema::create('staff', function (Blueprint $table) {
            $table->id('id_staff');
            $table->string('nama');
            $table->string('posisi');
            $table->text('deskripsi');
            $table->string('url_foto');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('headline', function (Blueprint $table) {
            $table->id('id_headline');
            $table->string('url_foto');
            $table->string('url_get');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('tabel_sendiri');
    }
};
