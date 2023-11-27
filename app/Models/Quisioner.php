<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quisioner extends Model
{
    use HasFactory;
    public $table = "quisioner";

    public function quisioner_jawaban()
    {
        return $this->hasMany(QuisionerJawaban::class,"quisioner_id","id");
    }
}
