<?php

namespace App\Http\Controllers;

use App\Helpers\CustomHelper;
use App\Models\GolonganDarah;
use App\Models\HasilTes;
use App\Models\Kuesioner;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    public function dashboard(){
        return view("panel.dashboard");
    }

    public function settings(Request $request){
        if($request->method() === "POST"){
            if(!empty($request->input("key"))){
                $request->validate([
                    "key"  => ["required"],
                    "value"  => ["required"],
                ]);

                $key        = $request->input("key");
                $value      = is_array($request->input("value")) ? json_encode($request->input("value")) : $request->input("value");
                $settings   = Settings::where("key",$key)->first();
                $settings->value = nl2br($value);

                if($settings->save()){
                    return back()->with([
                        "message_setting"   => "Successfuly save setting"
                    ]);    
                }

                return back()->with([
                    "message_setting"   => "Failed, Please try again"
                ]);
            }
            if(!empty($request->input("username"))){
                $request->validate([
                    "username"  => ["required","min:8","max:32"],
                ]);
                if(!empty($request->input("password"))){
                    $request->validate([
                        "password"  => ["required","min:8","max:32"],
                        "conf_password"     => ["required","same:password"]
                    ]);
                }

                $auth   = Auth::user();
                $user   = User::find($auth->id);
                $user->username     = $request->input("username");
                if(!empty($request->input("password"))){
                    $user->password     = Hash::make($request->input("password"));
                }
                if($user->save()){
                    return back()->with([
                        "message"   => "Successfuly change account"
                    ]);    
                }

                return back()->with([
                    "message"   => "Failed, Please try again"
                ]);
            }

            return back();
        }else{
            $data   = [];
            $data["golongan_darah"]  = GolonganDarah::orderBy("golongan_darah")->get();
            $data["hasil_tes"]  = HasilTes::orderBy("kode_angka")->get();
            return view("panel.settings",$data);
        }
    }

    public function export(Request $request)
    {
        $filter   = $request->input("filter");
        $columns   = $request->input("columns");
        $order   = $request->input("order");
        $search   = $request->input("search")["value"];

        $data   = Kuesioner::select("*");

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
        $result = $data->get();

        foreach($result as $row){
            $row->hasil_tes    = CustomHelper::get_value_number_tgl_lahir($row->number_tgl_lahir);
        }
        
        $csvFileName = 'hasil_kuesioner.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $header     = [
            "Nama Lengkap",
            "No Peserta",
            "Tempat Lahir",
            "Tanggal Lahir",
            "Hasil Tes",
            "Golongan Darah",
            "Agama",
            "Jenis Kelamin",
            "Alamat",
            "Email",
            "No WA",
            "Persentase Visual (%)",
            "Persentase Auditory (%)",
            "Persentase Kinestetik (%)"
        ];
        $filecsv = "file.csv";
        $handle = fopen($filecsv, 'w+');
        fputcsv($handle, $header,";"); // Add more headers as needed

        foreach ($result as $row) {
            fputcsv($handle, [
                $row->nama_lengkap,
                '="'.$row->no_peserta.'"',
                $row->tempat_lahir,
                $row->tanggal_lahir,
                $row->hasil_tes,
                $row->golongan_darah,
                $row->agama,
                $row->jenis_kelamin,
                $row->alamat,
                $row->email,
                '="'.$row->no_wa.'"',
                $row->persentase_visual."%",
                $row->persentase_auditory."%",
                $row->persentase_kinestetik."%",
            ],";"); // Add more fields as needed
        }

        fclose($handle);
        
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return response()->download($filecsv, $csvFileName, $headers);

    }

}
