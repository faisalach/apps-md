<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;
    public $table = "cabang"; 

    public function users()
    {
        return $this->hasMany(User::class,"id_cabang","id");
    }
}
