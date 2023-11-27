<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankSoalJawaban extends Model
{
    use HasFactory;
    public $table = "bank_soal_jawaban";

    public function bank_soal()
    {
        return $this->belongsTo(BankSoal::class,"bank_soal_id","id");
    }
}
