<?php

namespace App\Helpers;

use App\Models\GolonganDarah;
use App\Models\HasilTes;
use App\Models\Kuesioner;
use App\Models\KuesionerJawaban;
use App\Models\KuesionerToken;
use App\Models\Settings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomHelper
{
    public static function count_number_tgl_lahir($tgl_lahir){
        $tgl_lahir  = preg_replace("/[^0-9]/","",$tgl_lahir);

        $split      = str_split($tgl_lahir);
        $total      = 0;
        foreach($split as $nmbr){
            $total  += intval($nmbr);
        }

        if(strlen($total) > 1){
            return CustomHelper::count_number_tgl_lahir($total);
        }else{
            return $total;
        }
    }

    public static function get_persentase_kuesioner_jawaban($kuesioner_id){
        $kuesioner_jawaban  = KuesionerJawaban::with(["bank_soal_jawaban"])
        ->where("kuesioner_id",$kuesioner_id)
        ->get();

        $count_visual   = 0;
        $count_auditory   = 0;
        $count_kinestetik   = 0;
        foreach($kuesioner_jawaban as $jawaban){
            switch ($jawaban->bank_soal_jawaban->type) {
                case 'visual':
                    $count_visual++;
                    break;
                case 'auditory':
                    $count_auditory++;
                    break;
                case 'kinestetik':
                    $count_kinestetik++;
                    break;
            }
        }

        $presentase     = [
            "visual"    => $count_visual / count($kuesioner_jawaban) * 100,
            "auditory"    => $count_auditory / count($kuesioner_jawaban) * 100,
            "kinestetik"    => $count_kinestetik / count($kuesioner_jawaban) * 100,
        ];

        return $presentase;
    }

    public static function get_no_peserta(){
        $last_kuesioner     = Kuesioner::orderBy("no_peserta","DESC")->limit(1)->first();
        $latest             = !empty($last_kuesioner->no_peserta) ? intval($last_kuesioner->no_peserta) : 0;
        $latest++;
        
        $nomor_urut     = substr('000000' . $latest,-6);
        return $nomor_urut;
    }

    public static function get_value_number_tgl_lahir($number_tgl_lahir){
        $hasil_tes  = HasilTes::where("kode_angka",$number_tgl_lahir)->first();
        return !empty($hasil_tes->title) ? $hasil_tes->title : "";
    }

    public static function get_pdf_hasil_tes($kode_angka){
        $hasil_tes  = HasilTes::where("kode_angka",$kode_angka)->first();
        $pdf_file   = (!empty($hasil_tes->file_pdf) && json_decode($hasil_tes->file_pdf,true) ? json_decode($hasil_tes->file_pdf,true) : []);

        if(!empty($pdf_file)){
            foreach($pdf_file as $key => $file){
                $file   = "/pdf_file/kode_$kode_angka/$file";
                $pdf_file[$key]     = $file;
            }
        }
        return $pdf_file;
    }

    public static function get_pdf_golongan_darah($golongan_darah){
        $data_golongan_darah  = GolonganDarah::where("golongan_darah",$golongan_darah)->first();
        $pdf_file   = (!empty($data_golongan_darah->file_pdf) && json_decode($data_golongan_darah->file_pdf,true) ? json_decode($data_golongan_darah->file_pdf,true) : []);
        if(!empty($pdf_file)){
            foreach($pdf_file as $key => $file){
                $file   = "/pdf_file/goldar_$golongan_darah/$file";
                $pdf_file[$key]     = $file;
            }
        }
        return $pdf_file;
    }

    public static function form_url($nomor_contact){
        $token  = KuesionerToken::where("nomor_contact",$nomor_contact)
        ->where("start_date","<=",date("Y-m-d H:i:s"))
        ->where("end_date",">=",date("Y-m-d H:i:s"))
        ->where("sudah_diisi",0)
        ->first();

        if(!empty($token->token)){
            return url(route("kuesioner.form",["token" => $token->token]));
        }

        do {
            $str_token  = Str::random(30);
            $check  = KuesionerToken::where("token",$str_token)->first();
        } while (!empty($check));

        $time_expired_token   = CustomHelper::getSetting("time_expired_token");
        $time_expired_token_arr     = json_decode($time_expired_token,true) ? json_decode($time_expired_token,true) : [];
        $satuan         = !empty($time_expired_token_arr["satuan"]) ? $time_expired_token_arr["satuan"] : "minutes";
        $time_interval  = !empty($time_expired_token_arr["time"]) ? $time_expired_token_arr["time"] : 60;

        $token              = new KuesionerToken();
        $token->start_date  = date("Y-m-d H:i:s");
        $token->end_date    = date("Y-m-d H:i:s",strtotime("+$time_interval $satuan"));
        $token->sudah_diisi = 0;
        $token->nomor_contact = $nomor_contact;
        $token->token       = $str_token;
        $token->save();


        return url(route("kuesioner.form",["token" => $token->token]));
    }

    public static function getSetting($key){
        return Settings::where("key",$key)->value('value');
    }

    public static function sendWA($pesan,$no_hp,$url_file = ''){
        $api_key    = CustomHelper::getSetting("wa_api_key");
        $sender     = CustomHelper::getSetting("wa_sender");

        if(!empty($url_file)){
            $api_url = "https://wa.srv21.wapanels.com/send-media";
            $data = [
                'api_key' => $api_key,
                'sender' => $sender,
                'number' => $no_hp,
                'media_type' => "pdf",
                'caption'   => $pesan,
                "url"       => $url_file
            ];
        }else{
            $api_url = "https://wa.srv21.wapanels.com/send-message";
            $data = [
                'api_key' => $api_key,
                'sender' => $sender,
                'number' => $no_hp,
                'message' => $pesan
            ];
        }
        $curl = curl_init();
                                            
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
                                            
        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response,true);
    }
}
