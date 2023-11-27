<?php

namespace App\Http\Controllers;

use App\Models\BankSoal;
use Illuminate\Http\Request;

class KuesionerController extends Controller
{
    public function form(Request $request){
        $bank_soal  = BankSoal::with(["bank_soal_jawaban"])->orderBy("no_urut","ASC")->get();

        $data   = [];
        $data["bank_soal"]  = $bank_soal;
        return view("kuesioner.form",$data);
    }

    public function form_store(Request $request){
        
    }
}
