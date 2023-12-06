<?php

namespace App\Http\Controllers;

use App\Helpers\CustomHelper;
use App\Models\BankSoal;
use App\Models\Kuesioner;
use App\Models\KuesionerJawaban;
use App\Models\KuesionerToken;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KuesionerController extends Controller
{

    public function datatable(Request $request){

        $draw   = $request->input("draw");
        $start   = $request->input("start");
        $length   = $request->input("length");
        $columns   = $request->input("columns");
        $order   = $request->input("order");
        $search   = $request->input("search")["value"];

        $filter   = $request->input("filter");

        $data   = Kuesioner::select("*");
        $record_total   = $data->count();

        if(!empty($filter)){
            $data->where(function($query) use ($filter){
                foreach($filter as $column => $value){
                    if(empty($value)){
                        continue;
                    }
                    switch($column){
                        case 'min_persentase':
                            foreach($value as $col => $min){
                                if($min != null){
                                    $query->where($col,">=",$min);
                                }
                            }
                            break;
                        case 'max_persentase':
                            foreach($value as $col => $max){
                                if($max != null){
                                    $query->where($col,"<=",$max);
                                }
                            }
                            break;
                        case 'tahun_lahir':
                            $query->where(DB::raw("YEAR(tanggal_lahir)"),"like","%$value%");
                            break;
                        case 'bulan_lahir':
                            $query->where(DB::raw("MONTH(tanggal_lahir)"),"like","%$value%");
                            break;
                        case 'tanggal_lahir':
                            $query->where(DB::raw("DAY(tanggal_lahir)"),"like","%$value%");
                            break;
                        default :
                            $query->where($column,"like","%$value%");
                            break;
                    }
                }
            });
        }

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
            $row->hasil_tes    = CustomHelper::get_value_number_tgl_lahir($row->number_tgl_lahir);
        }

        return [
            "draw"=> $draw,
            "recordsTotal"=> $record_total,
            "recordsFiltered"=> $record_filtered,
            "data" => $result
        ];
    }

    public function form(Request $request){
        $bank_soal  = BankSoal::with(["bank_soal_jawaban"])->orderBy("no_urut","ASC")->get();

        $token  = $request->input("token");
        $check_token  = KuesionerToken::where("token",$token)
        ->where("start_date","<=",date("Y-m-d H:i:s"))
        ->where("end_date",">=",date("Y-m-d H:i:s"))
        ->where("sudah_diisi",0)
        ->first();

        if(empty($check_token)){
            return view("kuesioner.failed");
        }

        $data   = [];
        $data["bank_soal"]  = $bank_soal;
        $data["no_peserta"]  = $request->input("no_peserta");
        $data["token_form"]  = $request->input("token");
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
            "token_form" => "required",
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
        $token_form         = $request->input("token_form");

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

            $token  = KuesionerToken::where("token",$token_form)->first();
            $token->sudah_diisi = 1;
            $token->save();

            $sertifikat_url   = $this->sertifikat($kuesioner);

            return redirect(route("kuesioner.form"))->with([
                "message" => "Kuesioner berhasil direkam. Silahkan cek Whatsapp anda untuk mendapatkan sertifikat",
                "url_open"  => url($sertifikat_url)
            ]);
        }
        
        return redirect(route("kuesioner.form"))->with(["message" => "Failed, Please try again."]);
    }

    private function sertifikat($kuesioner){
        $value_number_tgl_lahir         = CustomHelper::get_value_number_tgl_lahir($kuesioner->number_tgl_lahir);
        $pdf_hasil_tes                  = CustomHelper::get_pdf_hasil_tes($kuesioner->number_tgl_lahir);

        $data   = [];
        $data["kuesioner"]              = $kuesioner;
        $data["value_number_tgl_lahir"] = $value_number_tgl_lahir;
        $data["pdf_hasil_tes"]          = $pdf_hasil_tes;
        $data["image"]                  = base64_encode(file_get_contents(public_path('/assets/template_sertifikat.png')));

        $pdf_filename   = 'sertifikat_'.$kuesioner->no_peserta.'.pdf';
        $pdf_filepath   = 'sertifikat/'.$pdf_filename;
        $pdf = PDF::loadView('kuesioner.sertifikat', $data);
        $pdf->save($pdf_filepath);
        
        return $pdf_filepath;
    }

    public function show_sertifikat($id){
        $kuesioner                      = Kuesioner::find($id);
        $value_number_tgl_lahir         = CustomHelper::get_value_number_tgl_lahir($kuesioner->number_tgl_lahir);
        $pdf_hasil_tes                  = CustomHelper::get_pdf_hasil_tes($kuesioner->number_tgl_lahir);
        $data   = [];
        $data["kuesioner"]              = $kuesioner;
        $data["value_number_tgl_lahir"] = $value_number_tgl_lahir;
        $data["pdf_hasil_tes"]          = base64_encode(file_get_contents(public_path("/$pdf_hasil_tes")));
        $data["image"]                  = base64_encode(file_get_contents(public_path('/assets/template_sertifikat.png')));

        // $pdf_filename   = 'sertifikat_'.$kuesioner->no_peserta.'.pdf';
        // $pdf_filepath   = 'sertifikat/'.$pdf_filename;
        // $pdf = PDF::loadView('kuesioner.sertifikat', $data);
        // $pdf->save($pdf_filepath);
        return view('kuesioner.sertifikat', $data);
    }
}
