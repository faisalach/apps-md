<?php

namespace App\Http\Controllers;

use App\Models\HasilTes;
use Illuminate\Http\Request;

class HasilTesController extends Controller
{
    public function update(Request $request,$kode_angka){
        $hasil_tes  = HasilTes::where("kode_angka",$kode_angka)->first();

        if(!empty($request->file("file_pdf"))){
            $file = $request->file('file');
            $filename   = "pdf_".time().".".$file->getClientOriginalExtension();
            if($file->move("/pdf_file/",$filename)){
                $hasil_tes->file_pdf = $filename;
            }
        }

        $hasil_tes->title   = $request->input("title");

        if($hasil_tes->save()){
            return back()->with([
                "success"   => "Successfuly update"
            ]);
        }else{
            return back()->with([
                "error"   => "Failed, please try again"
            ]);
        }
    }
}
