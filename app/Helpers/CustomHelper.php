<?php

namespace App\Helpers;

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

        $setting_time   = CustomHelper::getSetting("time_expired_token");
        $time_interval  = !empty($setting_time) ? $setting_time : 60;

        $token              = new KuesionerToken();
        $token->start_date  = date("Y-m-d H:i:s");
        $token->end_date    = date("Y-m-d H:i:s",strtotime("+$time_interval minutes"));
        $token->sudah_diisi = 0;
        $token->nomor_contact = $nomor_contact;
        $token->token       = $str_token;
        $token->save();


        return url(route("kuesioner.form",["token" => $token->token]));
    }

    public static function getSetting($key){
        return Settings::where("key","time_expired_token")->value('value');
    }

    public static function sendWA($pesan,$no_hp,$url_file = ''){
        $api_key    = CustomHelper::getSetting("wa_api_key");
        $id_device  = CustomHelper::getSetting("wa_device_id");
        $url        = 'https://api.watsap.id/send-media'; // URL API

        if(!empty($url_file)){
            $tipe  = 'image'; // Tipe Pesan Media Gambar
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0); // batas waktu response
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_POST, 1);

        $data_post = [
            'id_device' => $id_device,
            'api-key' => $api_key,
            'no_hp'   => $no_hp,
            'pesan'   => $pesan,
        ];
        if(!empty($url_file)){
            $data_post['tipe']    = $tipe;
            $data_post['link']    = $url_file; // pake http
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data_post));
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
