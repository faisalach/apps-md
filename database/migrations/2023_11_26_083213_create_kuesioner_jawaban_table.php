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
		Schema::create('kuesioner_jawaban', function (Blueprint $table) {
			$table->increments("id");
			$table->integer("bank_soal_id")->unsigned();
			$table->integer("bank_soal_jawaban_id")->unsigned();
			$table->integer("kuesioner_id")->unsigned();

			$table->foreign("kuesioner_id")->references("id")->on("kuesioner");
			$table->foreign("bank_soal_id")->references("id")->on("bank_soal");
			$table->foreign("bank_soal_jawaban_id")->references("id")->on("bank_soal_jawaban");
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('quisioner_jawaban');
	}
};
