<?php

namespace App\Http\Controllers;

use App\Models\GolonganDarah;
use Illuminate\Http\Request;
use ZipArchive;

class GolonganDarahController extends Controller
{
    public function update(Request $request,$golongan_darah){
        $data_golongan_darah  = GolonganDarah::where("golongan_darah",$golongan_darah)->first();

        if(!empty($request->file("file_zip"))){
            $file = $request->file('file_zip');
            $pdf_file_arr = [];

            if(strtolower($file->getClientOriginalExtension()) == "zip"){
                $zip = new ZipArchive;
                $zip_open   = $zip->open($file->getPathName(), ZipArchive::CREATE);
    
                // reset folder
                $pathFolder     = "pdf_file/goldar_".$golongan_darah;
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
                $pathFolder     = "pdf_file/goldar_".$golongan_darah;
                if($file->move($pathFolder,$file->getClientOriginalName())){
                    $pdf_file_arr[]     = $file->getClientOriginalName();
                }
            }

            
            if(!empty($pdf_file_arr)){
                $data_golongan_darah->file_pdf = json_encode($pdf_file_arr);
            }
        }else{
            return back()->with([
                "message_golongan_darah"   => "Pilih file terlebih dulu"
            ]);
        }

        if($data_golongan_darah->save()){
            return back()->with([
                "message_golongan_darah"   => "Successfuly update"
            ]);
        }else{
            return back()->with([
                "message_golongan_darah"   => "Failed, please try again"
            ]);
        }
    }
}
