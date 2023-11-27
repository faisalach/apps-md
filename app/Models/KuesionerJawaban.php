<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuesionerJawaban extends Model
{
    use HasFactory;
    public $table = "kuesioner_jawaban";

    public function bank_soal()
    {
        return $this->belongsTo(BankSoal::class,"bank_soal_id","id");
    }
    public function bank_soal_jawaban()
    {
        return $this->hasOne(BankSoalJawaban::class,"bank_soal_jawaban_id","id");
    }
    public function kuesioner()
    {
        return $this->belongsTo(Kuesioner::class,"kuesioner_id","id");
    }
}
