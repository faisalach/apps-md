<?php

namespace App\Http\Controllers;

use App\Models\GroupContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupContactController extends Controller
{
    public function group_contact(){
        return view('panel.group_contact');
    }

    public function get($id){
        return GroupContact::find($id);
    }

    public function datatable(Request $request){

        $draw   = $request->input("draw");
        $start   = $request->input("start");
        $length   = $request->input("length");
        $columns   = $request->input("columns");
        $order   = $request->input("order");
        $search   = $request->input("search")["value"];

        $data   = GroupContact::select("*");

        $data->where("id_cabang",Auth::user()->id_cabang);        
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

        foreach($result as $row){
            $row->date_created     = date("Y-m-d H:i",strtotime($row->created_at));
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
            "nama_group"     => "required"
        ]);

        $group_contact    = new GroupContact();
        $group_contact->nama_group = $request->input("nama_group");
        $group_contact->id_cabang = Auth::user()->id_cabang;
        if($group_contact->save()){
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
            "nama_group"     => "required"
        ]);

        $group_contact    = GroupContact::find($id);
        $group_contact->nama_group = $request->input("nama_group");

        if($group_contact->id_cabang !== Auth::user()->id_cabang){
            return response()->json([
                "message"   => "Data Not Found"
            ],422);
        }

        if($group_contact->save()){
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
        $group_contact    = GroupContact::find($id);
        if($group_contact->id_cabang !== Auth::user()->id_cabang){
            return response()->json([
                "message"   => "Data Not Found"
            ],422);
        }

        if($group_contact->delete()){
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
