<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankSoal extends Model
{
    use HasFactory;
    public $table = "bank_soal";
    
    public function bank_soal_jawaban()
    {
        return $this->hasMany(BankSoalJawaban::class,"bank_soal_id","id");
    }
}
