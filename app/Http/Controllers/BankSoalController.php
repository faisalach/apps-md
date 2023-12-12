<?php

namespace App\Http\Controllers;

use App\Models\BankSoal;
use App\Models\BankSoalJawaban;
use Illuminate\Http\Request;

class BankSoalController extends Controller
{
    public function bank_soal(){
        return view('panel.bank_soal');
    }

    public function get($id){
        return BankSoal::where("id",$id)->with(["bank_soal_jawaban"])->first();
    }

    public function datatable(Request $request){
        $draw   = $request->input("draw");
        $start   = $request->input("start");
        $length   = $request->input("length");
        $columns   = $request->input("columns");
        $order   = $request->input("order");
        $search   = $request->input("search")["value"];

        $data   = BankSoal::select("*");
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
            "pertanyaan"            => "required",
            "no_urut"               => "required|numeric",
            "jawaban.visual"        => "required",
            "jawaban.auditory"      => "required",
            "jawaban.kinestetik"    => "required",
        ]);

        $bank_soal    = new BankSoal();
        $bank_soal->pertanyaan  = $request->input("pertanyaan");
        $bank_soal->no_urut     = $request->input("no_urut");
        if($bank_soal->save()){
            foreach($request->input("jawaban") as $type => $jawaban){
                $bank_soal_jawaban    = new BankSoalJawaban();
                $bank_soal_jawaban->bank_soal_id  = $bank_soal->id;
                $bank_soal_jawaban->jawaban  = $jawaban;
                $bank_soal_jawaban->type     = $type;
                $bank_soal_jawaban->save();
            }
            
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
            "pertanyaan"            => "required",
            "no_urut"               => "required|numeric",
            "jawaban.visual"        => "required",
            "jawaban.auditory"      => "required",
            "jawaban.kinestetik"    => "required",
        ]);

        $bank_soal    = BankSoal::find($id);
        $bank_soal->pertanyaan  = $request->input("pertanyaan");
        $bank_soal->no_urut     = $request->input("no_urut");
        if($bank_soal->save()){
            foreach($request->input("jawaban") as $type => $jawaban){
                $bank_soal_jawaban    = BankSoalJawaban::where("bank_soal_id",$bank_soal->id)
                ->where("type",$type)
                ->first();

                $bank_soal_jawaban->jawaban  = $jawaban;
                $bank_soal_jawaban->type     = $type;
                $bank_soal_jawaban->save();
            }

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
        $bank_soal    = BankSoal::find($id);
        if($bank_soal->delete()){
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
