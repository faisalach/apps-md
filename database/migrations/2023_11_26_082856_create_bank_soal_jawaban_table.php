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
        Schema::create('bank_soal_jawaban', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bank_soal_id')->unsigned();
            $table->string("jawaban",255);
            $table->enum("type",["visual","auditory","kinestetik"]);
            $table->foreign("bank_soal_id")->references("id")->on("bank_soal")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_soal_jawaban');
    }
};
