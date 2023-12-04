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

        $setting_time   = Settings::where("key","time_expired_token")->first();
        $time_interval  = !empty($setting_time->value) ? $setting_time->value : 60;

        $token              = new KuesionerToken();
        $token->start_date  = date("Y-m-d H:i:s");
        $token->end_date    = date("Y-m-d H:i:s",strtotime("+$time_interval minutes"));
        $token->sudah_diisi = 0;
        $token->nomor_contact = $nomor_contact;
        $token->token       = $str_token;
        $token->save();


        return url(route("kuesioner.form",["token" => $token->token]));
    }
}
