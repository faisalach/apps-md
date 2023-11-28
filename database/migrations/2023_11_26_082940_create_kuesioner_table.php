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
        Schema::create('kuesioner', function (Blueprint $table) {
            $table->increments("id");
            $table->string("nama_lengkap",200);
            $table->string("tempat_lahir",200);
            $table->date("tanggal_lahir");
            $table->integer("number_tgl_lahir");
            $table->enum("golongan_darah",["A","B","AB","O"]);
            $table->string("agama",100);
            $table->enum("jenis_kelamin",["laki-laki","perempuan"]);
            $table->text("alamat");
            $table->string("email",100);
            $table->string("no_wa",100);
            $table->string("no_peserta",100);
            $table->integer("persentase_visual");
            $table->integer("persentase_auditory");
            $table->integer("persentase_kinestetik");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quisioner');
    }
};
