<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contact_peserta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor_contact',20);
            $table->integer('id_group_contact')->unsigned()->nullable();
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on("users")->onDelete("cascade");
            $table->foreign('id_group_contact')->references('id')->on("group_contact")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_peserta');
    }
};
