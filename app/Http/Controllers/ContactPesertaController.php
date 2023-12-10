<?php

namespace App\Http\Controllers;

use App\Helpers\CustomHelper;
use App\Models\ContactPeserta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactPesertaController extends Controller
{
    public function contact(){
        return view('panel.contact');
    }

    public function datatable(Request $request){
        $draw   = $request->input("draw");
        $start   = $request->input("start");
        $length   = $request->input("length");
        $columns   = $request->input("columns");
        $order   = $request->input("order");
        $search   = $request->input("search")["value"];

        $data   = ContactPeserta::select("*");
        $record_total   = $data->count();

        if(!empty($search)){
            $data->where(function($query) use ($search,$columns){
                foreach($columns as $col){
                    if($col["searchable"] && !empty($col["name"])){
                        $query->orWhere($col["name"],"like","%$search%");
                    }
                }
            });
        }

        foreach($order as $ord){
            if($columns[$ord["column"]]["orderable"]){
                $data->orderBy($columns[$ord["column"]]["name"],$ord["dir"]);
            }
        }
        
        $record_filtered   = $data->count();

        $data->limit($length);
        $data->offset($start);
        
        $result = $data->get();


        return [
            "draw"=> $draw,
            "recordsTotal"=> $record_total,
            "recordsFiltered"=> $record_filtered,
            "data" => $result
        ];
    }

    public function insert(Request $request){

        $request->validate([
            "nomor_contact"     => "required|digits_between:10,20"
        ]);

        $nomor_contact  = $request->input("nomor_contact");
        $nomor_contact  = preg_replace("/[^0-9]/","",$nomor_contact);
        $nomor_contact  = preg_replace("/^0/","62",$nomor_contact);

        if(strlen($nomor_contact) < 10 || strlen($nomor_contact) > 20){
            return response()->json([
                "message"   => "Format nomor salah"
            ],422);
        }
        

        $check      = ContactPeserta::where("nomor_contact",$nomor_contact)->first();
        if(!empty($check)){
            return response()->json([
                "message"   => "Nomor sudah terdaftar"
            ],422);
        }

        $contact    = new ContactPeserta();
        $contact->nomor_contact = $nomor_contact;
        if($contact->save()){
            return response()->json([
                "message"   => "Successfuly insert data"
            ]);
        }else{
            return response()->json([
                "message"   => "Failed, please try again"
            ],422);
        }
    }

    public function insert_csv(Request $request){
        $nomor_contact_arr  = [];


        $file_csv   = $request->file("file");

        if(empty($file_csv) || $file_csv->getClientOriginalExtension() != "csv"){
            return response()->json([
                "message"   => "File CSV not found"
            ],422);
        }


        $header_csv   = [];
        $index_phone    = [];
        if (($handle = fopen($file_csv, 'r')) !== FALSE) {
            $i = 0;
            $delimiter = "\t";
            while(! feof($handle))
            {
                if($i == 0){
                    $header_csv     = fgetcsv($handle,0,$delimiter);
                    if(count($header_csv) === 1){
                        if(strpos($header_csv[0],",") !== false){
                            $delimiter  = ",";
                        }else if(strpos($header_csv[0],";") !== false){
                            $delimiter  = ";";
                        }
                        $header_csv     = explode($delimiter,$header_csv[0]);
                    }
                    for($i = 1; $i <= 10;$i++){
                        $index   = array_search("Phone $i - Value",$header_csv);
                        if($index !== false){
                            $index_phone[] = $index;
                        }
                    }

                    if(empty($index_phone)){
                        $index_phone[] = 0;
                    }
                }else{
                    $data_csv       = fgetcsv($handle,0,$delimiter);
                    foreach($index_phone as $indx){
                        if(!empty($data_csv[$indx])){
                            $nomor      = $data_csv[$indx];
                            $split      = explode(":::",$nomor);

                            foreach($split as $sp){
                                $nomor_contact_arr[]    = trim($sp);
                            }
                        }
                    }
                }
                $i++;
            }
            fclose($handle);
        }

        $data_insert    = [];

        foreach($nomor_contact_arr as $key => $nomor_contact){
            $nomor_contact  = preg_replace("/[^0-9]/","",$nomor_contact);
            $nomor_contact  = preg_replace("/^0/","62",$nomor_contact);

            if(strlen($nomor_contact) < 10 || strlen($nomor_contact) > 20){
                continue;
            }

            if(array_search($nomor_contact, array_column($data_insert, 'nomor_contact')) !== false){
                continue;
            }
    
            $check      = ContactPeserta::where("nomor_contact",$nomor_contact)->first();
            if(!empty($check)){
                continue;
            }

            $data_insert[]    = [
                "nomor_contact" => $nomor_contact,
                "created_at"    => Carbon::now(),
                "updated_at"    => Carbon::now(),
            ];
        }

        $contact    = ContactPeserta::insert($data_insert);
        if($contact){
            return response()->json([
                "message"   => "Successfuly insert data"
            ]);
        }else{
            return response()->json([
                "message"   => "Failed, please try again"
            ],422);
        }
    }

    public function delete($id){
        $contact    = ContactPeserta::find($id);
        if($contact->delete()){
            return response()->json([
                "message"   => "Successfuly delete data"
            ]);
        }else{
            return response()->json([
                "message"   => "Failed, please try again"
            ],422);
        }
    }

    public function send_wa(Request $request){
        $request->validate([
            "nomor_contact" => "required",
            "nomor_contact.*" => "required"
        ]);

        $nomor_contact_arr  = $request->input("nomor_contact");
        $message            = CustomHelper::getSetting("template_pesan_kirim_link");
        
        foreach($nomor_contact_arr as $nomor_contact){
            $link_sertifikat    = CustomHelper::form_url($nomor_contact);
            $data_replace       = [
                "link"    => $link_sertifikat
            ];

            $new_message        = $message;
            foreach($data_replace as $key => $val){
                $new_message    = str_replace("[$key]",$val,$new_message);
            }

            CustomHelper::sendWA($new_message,$nomor_contact);
        }

        return response()->json([
            "message" => "Success"
        ]);

    }
    
}
