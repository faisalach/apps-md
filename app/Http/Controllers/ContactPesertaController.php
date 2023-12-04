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
            "nomor_contact"     => "required|numeric"
        ]);

        $nomor_contact  = $request->input("nomor_contact");
        $nomor_contact  = preg_replace("/[^0-9]/g","",$nomor_contact);
        $nomor_contact  = preg_replace("/^0/g","62",$nomor_contact);

        $contact    = new ContactPeserta();
        $contact->nomor_contact = $nomor_contact;
        if($contact->save()){
            return back()->with([
                "success"   => "Successfuly insert data"
            ]);
        }else{
            return back()->with([
                "error"   => "Failed, please try again"
            ]);
        }
    }

    public function delete(Request $request,$id){
        $contact    = ContactPeserta::find($id);
        if($contact->delete()){
            return back()->with([
                "success"   => "Successfuly delete data"
            ]);
        }else{
            return back()->with([
                "error"   => "Failed, please try again"
            ]);
        }
    }

    
}
