<?php

namespace App\Helpers;

use App\Models\Kuesioner;
use App\Models\KuesionerJawaban;

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

    public static function get_presentase_kuesioner_jawaban($kuesioner_id){
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
        $last_kuesioner     = Kuesioner::orderBy("no_peserta","DESC")->limit(1);
        $latest             = !empty($last_kuesioner->no_peserta) ? intval($last_kuesioner->no_peserta) : 0;
        $latest++;
        
        $nomor_urut     = substr('000000' . $latest,-6);
        return $nomor_urut;
    }

    public static function get_value_number_tgl_lahir($number_tgl_lahir){
        switch ($number_tgl_lahir) {
            case 1:
                return "Multitalent";
                break;
            case 2:
                return "Multitalent";
                break;
            case 3:
                return "Multitalent";
                break;
            case 4:
                return "Multitalent";
                break;
            case 5:
                return "Multitalent";
                break;
            case 6:
                return "Multitalent";
                break;
            case 7:
                return "Multitalent";
                break;
            case 8:
                return "Multitalent";
                break;
            case 9:
                return "Multitalent";
                break;
        }
    }
}
