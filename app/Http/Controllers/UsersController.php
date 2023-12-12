<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function users(){

        $cabang     = Cabang::all();
        
        $data   = [
            "cabang"    => $cabang
        ];
        return view('panel.users',$data);
    }

    public function get($id){
        return User::find($id);
    }

    public function datatable(Request $request){
        $draw   = $request->input("draw");
        $start   = $request->input("start");
        $length   = $request->input("length");
        $columns   = $request->input("columns");
        $order   = $request->input("order");
        $search   = $request->input("search")["value"];

        $data   = User::with(["cabang"]);
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
            switch($row->role){
                case 'superadmin':
                    $row->nama_role = "Superadmin";
                    break;
                case 'admin_cabang':
                    $row->nama_role = "Cabang";
                    break;
                case 'agen':
                    $row->nama_role = "Agen";
                    break;
                default : 
                    $row->nama_role = "";
                    break;
            }
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
            "username"     => "required",
            "password"     => "required",
            "role"         => "required|in:superadmin,admin_cabang,agen",
        ]);

        if($request->input("role") !== "superadmin"){
            $request->validate([
                "id_cabang"    => "required",
            ]); 
        }

        $user    = new User();
        $user->username  = $request->input("username");
        $user->password  = Hash::make($request->input("password"));
        $user->role      = $request->input("role");
        $user->id_cabang      = $user->role !== "superadmin" ? $request->input("id_cabang") : null;
        if($user->save()){
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
            "username"     => "required",
            "role"         => "required|in:superadmin,admin_cabang,agen",
        ]);

        if(!empty($request->input("password"))){
            $request->validate([
                "password"  => "min:8|max:32"
            ]);
        }

        if($request->input("role") !== "superadmin"){
            $request->validate([
                "id_cabang"    => "required",
            ]); 
        }

        $user    = User::find($id);
        $user->username  = $request->input("username");
        if(!empty($request->input("password"))){
            $user->password  = Hash::make($request->input("password"));
        }
        $user->role         = $request->input("role");
        $user->id_cabang    = $user->role !== "superadmin" ? $request->input("id_cabang") : null;
        if($user->save()){
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
        $user    = User::find($id);

        if($user->id == Auth::user()->id){
            return response()->json([
                "message"   => "Permission denied."
            ],422);
        }
        if($user->delete()){
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
