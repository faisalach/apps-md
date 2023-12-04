<?php

namespace App\Http\Controllers;

use App\Models\HasilTes;
use Illuminate\Http\Request;

class HasilTesController extends Controller
{
    public function settings(){
        $data   = HasilTes::orderBy('kode_angka',"ASC")->get();
        return view("hasil_test.settings",$data);
    }

    public function upload_file_pdf(Request $request){
        
    }
}
