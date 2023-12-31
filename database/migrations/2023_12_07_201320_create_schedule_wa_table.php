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
        Schema::create('schedule_wa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor_wa',20);
            $table->text('isi_pesan');
            $table->string('url_media',200);
            $table->timestamp('waktu_pengiriman');
            $table->string('status_pengiriman',20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_wa');
    }
};
