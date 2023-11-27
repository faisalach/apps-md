<?php

namespace App\Http\Controllers;

use App\Helpers\CustomHelper;
use App\Models\BankSoal;
use App\Models\Kuesioner;
use App\Models\KuesionerJawaban;
use Illuminate\Http\Request;

class KuesionerController extends Controller
{
    public function form(Request $request){
        $bank_soal  = BankSoal::with(["bank_soal_jawaban"])->orderBy("no_urut","ASC")->get();

        $data   = [];
        $data["bank_soal"]  = $bank_soal;
        return view("kuesioner.form",$data);
    }

    public function form_store(Request $request)
    {
        $request->validate([
            "nama_lengkap" => "required",
            "agama" => "required",
            "jenis_kelamin" => "required",
            "tempat_lahir" => "required",
            "tanggal_lahir" => "required",
            "golongan_darah" => "required",
            "alamat" => "required",
            "email" => "required",
            "no_wa" => "required",
            "jawaban" => "required",
        ]);

        $nama_lengkap       = $request->input("nama_lengkap");
        $agama              = $request->input("agama");
        $jenis_kelamin      = $request->input("jenis_kelamin");
        $tempat_lahir       = $request->input("tempat_lahir");
        $tanggal_lahir      = $request->input("tanggal_lahir");
        $number_tgl_lahir   = CustomHelper::count_number_tgl_lahir($tanggal_lahir);
        $golongan_darah     = $request->input("golongan_darah");
        $alamat             = $request->input("alamat");
        $email              = $request->input("email");
        $no_wa              = $request->input("no_wa");
        $jawaban            = $request->input("jawaban");

        $kuesioner          = new Kuesioner();
        $kuesioner->nama_lengkap    = $nama_lengkap;
        $kuesioner->tempat_lahir    = $tempat_lahir;
        $kuesioner->tanggal_lahir    = $tanggal_lahir;
        $kuesioner->number_tgl_lahir    = $number_tgl_lahir;
        $kuesioner->golongan_darah    = $golongan_darah;
        $kuesioner->agama    = $agama;
        $kuesioner->jenis_kelamin    = $jenis_kelamin;
        $kuesioner->alamat    = $alamat;
        $kuesioner->email    = $email;
        $kuesioner->no_wa    = $no_wa;
        $kuesioner->no_peserta    = "PESERTA01";
        if($kuesioner->save()){
            
            foreach($jawaban as $bank_soal_id => $bank_soal_jawaban_id){
                $kuesioner_jawaban  = new KuesionerJawaban();
                $kuesioner_jawaban->bank_soal_id    = $bank_soal_id;
                $kuesioner_jawaban->bank_soal_jawaban_id    = $bank_soal_jawaban_id;
                $kuesioner_jawaban->kuesioner_id    = $kuesioner->id;
                $kuesioner_jawaban->save();
            }

        }

    }

    public function sertifikat($kuesioner_id){
        $kuesioner                  = Kuesioner::find($kuesioner_id);
        $value_number_tgl_lahir     = CustomHelper::get_value_number_tgl_lahir($kuesioner->number_tgl_lahir);
        $presentase_jawaban         = CustomHelper::get_presentase_kuesioner_jawaban($kuesioner->id);

        $data   = [];
        $data["kuesioner"]              = $kuesioner;
        $data["value_number_tgl_lahir"] = $value_number_tgl_lahir;
        $data["presentase_jawaban"]     = $presentase_jawaban;

        return view("kuesioner.sertifikat",$data);

    }
}
