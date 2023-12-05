<?php

namespace App\Http\Controllers;

use App\Helpers\CustomHelper;
use App\Models\ContactPeserta;
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
                    if($col["searchable"]){
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

        foreach($result as $row){
            $row->url    = CustomHelper::form_url($row->nomor_contact);
        }

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

        $data   = [];

        echo "OKE";

        if (($handle = fopen($file_csv, 'r')) !== FALSE) {
            $i = 0;
            $delimiter = ',';
            while (($lineArray = fgetcsv($handle, 4000, $delimiter, '"')) !== FALSE) {
                for ($j = 0; $j < count($lineArray); $j  ) {
                    $data[$i][$j] = $lineArray[$j];
                }
                $i++;
            }
            fclose($handle);
        }
        echo "<pre>";
        print_r($data);
        exit;


        foreach($nomor_contact_arr as $key => $nomor_contact){
            $nomor_contact  = preg_replace("/[^0-9]/","",$nomor_contact);
            $nomor_contact  = preg_replace("/^0/","62",$nomor_contact);

            if(strlen($nomor_contact) < 10 || strlen($nomor_contact) > 20){
                continue;
            }
    
            $check      = ContactPeserta::where("nomor_contact",$nomor_contact)->first();
            if(!empty($check)){
                unset($nomor_contact_arr[$key]);
            }
        }

        $nomor_contact_arr  = array_values($nomor_contact_arr);


        $contact    = ContactPeserta::create($nomor_contact_arr);
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

    public function delete(Request $request,$id){
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

    
}
