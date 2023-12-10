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
        Schema::create('group_contact', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_group');
            $table->integer('id_cabang')->unsigned()->nullable();
            $table->foreign('id_cabang')->references('id')->on('cabang')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_contact');
    }
};
