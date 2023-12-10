<?php

namespace App\Console\Commands;

use App\Helpers\CustomHelper;
use App\Models\ScheduleWa as ModelsScheduleWa;
use Illuminate\Console\Command;

class scheduleWA extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:schedule-wa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $getSchedule     = ModelsScheduleWa::where("waktu_pengiriman","<=",date("Y-m-d H:i:59"))
        ->where("status_pengiriman","!=","success")
        ->orderBy("waktu_pengiriman","ASC")
        ->limit(50)
        ->get();

        foreach($getSchedule as $row){

            if($row->status_pengiriman === "failed_send_media"){
                $template_pesan     = CustomHelper::getSetting("template_pesan_sertifikat");
                $sendWa     = CustomHelper::sendWA($template_pesan . " " . $row->url_media,$row->nomor_wa);
            }else{
                $sendWa     = CustomHelper::sendWA($row->isi_pesan,$row->nomor_wa,$row->url_media);
            }
            if($sendWa["status"]){
                $row->status_pengiriman = "success";
                $row->save();
            }else{
                if(!empty($row->url_media)){
                    $row->status_pengiriman     = "failed_send_media";
                }else{
                    $row->status_pengiriman     = "failed_send_message";
                }
                $row->save();
            }
        }

    }
}
