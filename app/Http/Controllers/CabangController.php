<?php

namespace App\Http\Controllers;

use App\Helpers\CustomHelper;
use App\Models\Cabang;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    public function cabang(){
        return view('panel.cabang');
    }

    public function get($id){
        return Cabang::find($id);
    }

    public function datatable(Request $request){
        $draw   = $request->input("draw");
        $start   = $request->input("start");
        $length   = $request->input("length");
        $columns   = $request->input("columns");
        $order   = $request->input("order");
        $search   = $request->input("search")["value"];

        $data   = Cabang::select("*");
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
            "nama_cabang"     => "required"
        ]);

        $cabang    = new Cabang();
        $cabang->nama_cabang = $request->input("nama_cabang");
        $cabang->kuota_link = 0;
        if($cabang->save()){
            return response()->json([
                "message"   => "Successfuly insert data"
            ]);
        }else{
            return response()->json([
                "message"   => "Failed, please try again"
            ],422);
        }
    }

    public function update(Request $request,$id){

        $request->validate([
            "nama_cabang"     => "required|numeric"
        ]);

        $cabang    = Cabang::find($id);
        $cabang->nama_cabang = $request->input("nama_cabang");
        $cabang->kuota_link = 0;
        if($cabang->save()){
            return response()->json([
                "message"   => "Successfuly update data"
            ]);
        }else{
            return response()->json([
                "message"   => "Failed, please try again"
            ],422);
        }
    }

    public function update_kuota_link(Request $request,$id){

        $request->validate([
            "kuota_link"     => "required"
        ]);

        $cabang    = Cabang::find($id);
        $cabang->kuota_link = $request->input("kuota_link");
        if($cabang->save()){
            return response()->json([
                "message"   => "Successfuly update data"
            ]);
        }else{
            return response()->json([
                "message"   => "Failed, please try again"
            ],422);
        }
    }

    public function delete($id){
        $cabang    = Cabang::find($id);
        if($cabang->delete()){
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
