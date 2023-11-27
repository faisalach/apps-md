<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuesioner extends Model
{
    use HasFactory;
    public $table = "kuesioner";

    public function kuesioner_jawaban()
    {
        return $this->hasMany(KuesionerJawaban::class,"kuesioner_id","id");
    }
}
