<?php

namespace App\Http\Controllers;

use App\Models\HasilTes;
use Illuminate\Http\Request;
use ZipArchive;

class HasilTesController extends Controller
{
    public function get($kode_angka){
        return HasilTes::where("kode_angka",$kode_angka)->first();
    }
    public function update(Request $request,$kode_angka){
        $hasil_tes  = HasilTes::where("kode_angka",$kode_angka)->first();

        if(!empty($request->file("file_zip"))){
            $file = $request->file('file_zip');

            $zip = new ZipArchive;
            $zip_open   = $zip->open($file->getPathName(), ZipArchive::CREATE);

            // reset folder
            $pathFolder     = "pdf_file/kode_".$kode_angka;
            if(file_exists($pathFolder)){
                $scanFile   = scandir($pathFolder);
                foreach($scanFile as $sFile){
                    if(is_file("$pathFolder/$sFile")){
                        unlink("$pathFolder/$sFile");
                    }
                }
                rmdir($pathFolder);
            }
            if(!file_exists($pathFolder)){
                mkdir($pathFolder);
            }

            $pdf_file_arr = [];
            if($zip_open){
                $zip->extractTo($pathFolder);
                for( $i = 0; $i < $zip->numFiles; $i++ ){ 
                    $stat = $zip->statIndex( $i ); 
                    $pdf_file_arr[]     = $stat["name"];
                }                
            }

            sort($pdf_file_arr);
            
            if(!empty($pdf_file_arr)){
                $hasil_tes->file_pdf = json_encode($pdf_file_arr);
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
