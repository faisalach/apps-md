<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		// \App\Models\User::factory(10)->create();

		// \App\Models\User::factory()->create([
		//     'name' => 'Test User',
		//     'email' => 'test@example.com',
		// ]);

		\App\Models\User::create([
			'username' => 'admin_account',
			'password' => Hash::make("admin123456"),
		]);

		$bank_soal_arr  = [
			[
				"no_urut"       => 1,
				"pertanyaan"    => "kalau ada orang yang meminta petunjuk jalan biasanya saya akan",
				"jawaban"       => [
					[
						"jawaban"   => "menggambar peta jalan pada sebuah kertas",
						"type"      => "visual"
					],
					[
						"jawaban"   => "memberitahu secara lisan (melalui ucapan)",
						"type"      => "auditory"
					],
					[
						"jawaban"   => "mencoba memberitahu dengan isyarat tangan atau langsung mengantarkannya",
						"type"      => "kinestetik"
					],
					
				]
			],
			[
				"no_urut"       => 2,
				"pertanyaan"    => "saya paling suka permainan",
				"jawaban"       => [
					[
						"jawaban"   => "kata bergambar",
						"type"      => "visual"
					],
					[
						"jawaban"   => "acak kata",
						"type"      => "auditory"
					],
					[
						"jawaban"   => "pantomim",
						"type"      => "kinestetik"
					],
				]
			],
			[
				"no_urut"       => 3,
				"pertanyaan"    => "saya ingin sekali menonton film di bioskop karena",
				"jawaban"       => [
					[
						"jawaban"   => "melihat cover iklannya yang menarik",
						"type"      => "visual"
					],
					[
						"jawaban"   => "membaca sypnosis ceritanya",
						"type"      => "auditory"
					],
					[
						"jawaban"   => "menonton potongan filmnya",
						"type"      => "kinestetik"
					],
				]
			],
			[
				"no_urut"       => 4,
				"pertanyaan"    => "saya punya guru favorit. saat mengajar, ia selalu menggunakan",
				"jawaban"       => [
					[
						"jawaban"   => "ceramah, diskusi dan debat",
						"type"      => "visual"
					],
					[
						"jawaban"   => "diagram, bagan alur dan slide",
						"type"      => "auditory"
					],
					[
						"jawaban"   => "trial, uji coba dan praktik test",
						"type"      => "kinestetik"
					],
				]
			],
			[
				"no_urut"       => 5,
				"pertanyaan"    => "ketika bicara, biasanya saya paling suka",
				"jawaban"       => [
					[
						"jawaban"   => "suka berbicara perlahan dan jelas tapi tidak suka mendengarkan terlalu lama",
						"type"      => "visual"
					],
					[
						"jawaban"   => "suka mendengarkan orang lain bicara terlebih dahulu baru kemudian berbicara",
						"type"      => "auditory"
					],
					[
						"jawaban"   => "berbicara dengan menggunakan bahasa tubuh dan gerakan yang banyak",
						"type"      => "kinestetik"
					],
				]
			],
			[
				"no_urut"       => 6,
				"pertanyaan"    => "sebelum mengerjakan sesuatu, saya biasanya",
				"jawaban"       => [
					[
						"jawaban"   => "membaca instruksinya terlebih dahulu",
						"type"      => "visual"
					],
					[
						"jawaban"   => "mendengarkan instruksinya dari orang lain baru kemudian mengerjakannya",
						"type"      => "auditory"
					],
					[
						"jawaban"   => "langsung melakukan uji coba",
						"type"      => "kinestetik"
					],
				]
			],
			[
				"no_urut"       => 7,
				"pertanyaan"    => "ketika lupa sesuatu, biasanya saya",
				"jawaban"       => [
					[
						"jawaban"   => "berusaha mengingat dari gambaran bentuk, warna atau cirinya",
						"type"      => "visual"
					],
					[
						"jawaban"   => "berusaha mengingatnya dari ciri suaranya",
						"type"      => "auditory"
					],
					[
						"jawaban"   => "berusaha mengingat apa yang di lakukan dan penggunaanya",
						"type"      => "kinestetik"
					],
				]
			],
			[
				"no_urut"       => 8,
				"pertanyaan"    => "hal yang paling bisa saya ingat dari seseorang adalah",
				"jawaban"       => [
					[
						"jawaban"   => "ekspresi wajah yang menawan",
						"type"      => "visual"
					],
					[
						"jawaban"   => "suara yang khas",
						"type"      => "auditory"
					],
					[
						"jawaban"   => "gerakan tubuh yang memukau",
						"type"      => "kinestetik"
					],
				]
			],
			[
				"no_urut"       => 9,
				"pertanyaan"    => "saat berkomunikasi, saya suka kalau",
				"jawaban"       => [
					[
						"jawaban"   => "bertemu secara langsung",
						"type"      => "visual"
					],
					[
						"jawaban"   => "bicara melalui telepon",
						"type"      => "auditory"
					],
					[
						"jawaban"   => "bertemu dalam sebuah kegiatan aktif",
						"type"      => "kinestetik"
					],
				]
			],
			[
				"no_urut"       => 10,
				"pertanyaan"    => "kemampuan yang saya bisa dan paling saya sukai",
				"jawaban"       => [
					[
						"jawaban"   => "menggambar, melukis atau mewarnai",
						"type"      => "visual"
					],
					[
						"jawaban"   => "bernyanyi atau bermain alat musik",
						"type"      => "auditory"
					],
					[
						"jawaban"   => "menari atau beladiri",
						"type"      => "kinestetik"
					],
				]
			],
			[
				"no_urut"       => 11,
				"pertanyaan"    => "ketika santai yang biasa saya lakukan",
				"jawaban"       => [
					[
						"jawaban"   => "membaca novel atau buku",
						"type"      => "visual"
					],
					[
						"jawaban"   => "mendengarkan musik atau radio",
						"type"      => "auditory"
					],
					[
						"jawaban"   => "berolah raga atau bermain",
						"type"      => "kinestetik"
					],
				]
			],
			[
				"no_urut"       => 12,
				"pertanyaan"    => "saat marah, saya biasanya",
				"jawaban"       => [
					[
						"jawaban"   => "lebih memilih untuk diam saja",
						"type"      => "visual"
					],
					[
						"jawaban"   => "memaki dan berkata-kata secara emosional",
						"type"      => "auditory"
					],
					[
						"jawaban"   => "membanting barang atau memukul",
						"type"      => "kinestetik"
					],
				]
			],
			[
				"no_urut"       => 13,
				"pertanyaan"    => "konsentrasi saya terganggu jika",
				"jawaban"       => [
					[
						"jawaban"   => "kondisi ruangan yang berantakan dan tidak rapi",
						"type"      => "visual"
					],
					[
						"jawaban"   => "bising dan suara gaduh",
						"type"      => "auditory"
					],
					[
						"jawaban"   => "gerakan yang ada di sekitar",
						"type"      => "kinestetik"
					],
				]
			],
			[
				"no_urut"       => 14,
				"pertanyaan"    => "saat belajar, saya biasanya",
				"jawaban"       => [
					[
						"jawaban"   => "membuat catatan atau rangkuman dari materi",
						"type"      => "visual"
					],
					[
						"jawaban"   => "menghafal sambil menggunakan suara",
						"type"      => "auditory"
					],
					[
						"jawaban"   => "melakukan praktik atau simulasi dari pelajaran",
						"type"      => "kinestetik"
					],
				]
			],
			[
				"no_urut"       => 15,
				"pertanyaan"    => "saat membaca sesuatu saya biasanya",
				"jawaban"       => [
					[
						"jawaban"   => "menyukai bacaan yang bercerita tentang detail peristiwa",
						"type"      => "visual"
					],
					[
						"jawaban"   => "menyukai bacaan yang memiliki banyak percakapan antar tokoh",
						"type"      => "auditory"
					],
					[
						"jawaban"   => "menyukai bacaan yang melibatkan aksi dari tokohnya",
						"type"      => "kinestetik"
					],
				]
			],
		];

		foreach($bank_soal_arr as $row) {
			$bank_soal = \App\Models\BankSoal::create([
				'pertanyaan' => $row["pertanyaan"],
				'no_urut' => $row["no_urut"],
			]);

			foreach($row["jawaban"] as $jwb){
				\App\Models\BankSoalJawaban::create([
					'bank_soal_id' => $bank_soal->id,
					'jawaban' => $jwb["jawaban"],
					'type' => $jwb["type"],
				]);
			}
		}

		for ($i=1; $i < 10; $i++) { 
			\App\Models\HasilTes::create([
				'kode_angka' => $i,
				'title' => "Multitalent",
				'file_pdf' => "",
			]);
		}
	}
}
