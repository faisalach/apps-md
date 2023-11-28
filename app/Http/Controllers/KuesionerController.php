<?php

namespace App\Http\Controllers;

use App\Helpers\CustomHelper;
use App\Models\BankSoal;
use App\Models\Kuesioner;
use App\Models\KuesionerJawaban;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class KuesionerController extends Controller
{

    public function datatable(Request $request){
        
    }

    public function form(Request $request){
        $bank_soal  = BankSoal::with(["bank_soal_jawaban"])->orderBy("no_urut","ASC")->get();

        $data   = [];
        $data["bank_soal"]  = $bank_soal;
        $data["no_peserta"]  = $request->input("no_peserta");
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
        $no_peserta         = !empty($request->input("no_peserta")) ? $request->input("no_peserta") : CustomHelper::get_no_peserta();
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
        $kuesioner->no_peserta    = $no_peserta;
        $kuesioner->persentase_visual   = 0;
        $kuesioner->persentase_auditory   = 0;
        $kuesioner->persentase_kinestetik   = 0;
        if($kuesioner->save()){
            
            foreach($jawaban as $bank_soal_id => $bank_soal_jawaban_id){
                $kuesioner_jawaban  = new KuesionerJawaban();
                $kuesioner_jawaban->bank_soal_id    = $bank_soal_id;
                $kuesioner_jawaban->bank_soal_jawaban_id    = $bank_soal_jawaban_id;
                $kuesioner_jawaban->kuesioner_id    = $kuesioner->id;
                $kuesioner_jawaban->save();
            }
            $persentase_jawaban         = CustomHelper::get_persentase_kuesioner_jawaban($kuesioner->id);
            $kuesioner->persentase_visual   = $persentase_jawaban["visual"];
            $kuesioner->persentase_auditory   = $persentase_jawaban["auditory"];
            $kuesioner->persentase_kinestetik   = $persentase_jawaban["kinestetik"];
            $kuesioner->save();

            $sertifikat_url   = $this->sertifikat($kuesioner);

            return redirect(route("kuesioner.form"))->with(["message" => "Kuesioner berhasil direkam. Silahkan cek Whatsapp anda untuk mendapatkan sertifikat"]);
        }
        
        return redirect(route("kuesioner.form"))->with(["message" => "Failed, Please try again."]);
    }

    private function sertifikat($kuesioner){
        $value_number_tgl_lahir         = CustomHelper::get_value_number_tgl_lahir($kuesioner->number_tgl_lahir);

        $data   = [];
        $data["kuesioner"]              = $kuesioner;
        $data["value_number_tgl_lahir"] = $value_number_tgl_lahir;
        $data["image"]                  = base64_encode(file_get_contents(public_path('/assets/template_sertifikat.jpg')));

        $pdf_filename   = 'sertifikat_'.$kuesioner->no_peserta.'.pdf';
        $pdf_filepath   = 'sertifikat/'.$pdf_filename;
        $pdf = PDF::loadView('kuesioner.sertifikat', $data);
        $pdf->save($pdf_filepath);
        
        return $pdf_filepath;
    }
}
