<?php

namespace App\Http\Controllers;

use App\Helpers\CustomHelper;
use App\Models\HasilTes;
use Illuminate\Http\Request;
use ZipArchive;

class HasilTesController extends Controller
{
    public function get($kode_angka){
        $data   = HasilTes::where("kode_angka",$kode_angka)->first();
        $file_pdf     = CustomHelper::get_pdf_hasil_tes($kode_angka);
        $data->file_pdf     = $file_pdf;
        return $data;
    }
    public function update(Request $request,$kode_angka){
        $hasil_tes  = HasilTes::where("kode_angka",$kode_angka)->first();

        if(!empty($request->file("file_zip"))){
            $file = $request->file('file_zip');
            $pdf_file_arr = [];

            if(strtolower($file->getClientOriginalExtension()) == "zip"){
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
    
                if($zip_open){
                    $zip->extractTo($pathFolder);
                    for( $i = 0; $i < $zip->numFiles; $i++ ){ 
                        $stat = $zip->statIndex( $i ); 
                        $pdf_file_arr[]     = $stat["name"];
                    }                
                }
    
                sort($pdf_file_arr);
            }else if(strtolower($file->getClientOriginalExtension()) == "jpg"){
                $pathFolder     = "pdf_file/kode_".$kode_angka;
                if($file->move($pathFolder,$file->getClientOriginalName())){
                    $pdf_file_arr[]     = $file->getClientOriginalName();
                }
            }
            
            if(!empty($pdf_file_arr)){
                $hasil_tes->file_pdf = json_encode($pdf_file_arr);
            }
        }

        $hasil_tes->title   = $request->input("title");

        if($hasil_tes->save()){
            return back()->with([
                "message_hasil_tes"   => "Successfuly update"
            ]);
        }else{
            return back()->with([
                "message_hasil_tes"   => "Failed, please try again"
            ]);
        }
    }
}
