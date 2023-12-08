<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\ContactPesertaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GolonganDarahController;
use App\Http\Controllers\HasilTesController;
use App\Http\Controllers\KuesionerController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::redirect("/","/form");
Route::get("/form",[KuesionerController::class,"form"])->name("kuesioner.form");
Route::post("/form/store",[KuesionerController::class,"form_store"])->name("kuesioner.formStore");
Route::get("/form/sertifikat/{id}",[KuesionerController::class,"show_sertifikat"]);

Route::group(["middleware" => "guest:superadmin,admin_cabang"],function(){
    Route::redirect("/panel","/panel/login");
    Route::get("/panel/login",[AuthController::class,"login"])->name("login");
    Route::post("/panel/login",[AuthController::class,"authenticated"])->name("authenticated");
});
Route::group(["middleware" => "auth:superadmin,admin_cabang"],function(){

    Route::group(["middleware" => "auth:superadmin"],function(){
        Route::get("/panel/dashboard",[DashboardController::class,"dashboard"])->name("dashboard");
        Route::get("/panel/kuesioner/datatable",[KuesionerController::class,"datatable"])->name("kuesioner.datatable");
        Route::get("/panel/kuesioner/export_csv",[DashboardController::class,"export"])->name("kuesioner.export_csv");

        Route::get("/panel/settings/hasil_tes/{kode_angka}",[HasilTesController::class,"get"])->name("settings.hasil_tes.get");
        Route::post("/panel/settings/hasil_tes/{kode_angka}/update",[HasilTesController::class,"update"])->name("settings.hasil_tes.update");

        Route::post("/panel/settings/golongan_darah/{golongan_darah}/update",[GolonganDarahController::class,"update"])->name("settings.golongan_darah.update");

        Route::get("/panel/cabang",[CabangController::class,"cabang"])->name("cabang");
        Route::get("/panel/cabang/get/{id}",[CabangController::class,"get"])->name("cabang.get");
        Route::get("/panel/cabang/datatable",[CabangController::class,"datatable"])->name("cabang.datatable");
        Route::post("/panel/cabang/insert",[CabangController::class,"insert"])->name("cabang.insert");
        Route::post("/panel/cabang/update/{id}",[CabangController::class,"update"])->name("cabang.update");
        Route::post("/panel/cabang/update_kuota_link/{id}",[CabangController::class,"update_kuota_link"])->name("cabang.update_kuota_link");
        Route::post("/panel/cabang/delete/{id}",[CabangController::class,"delete"])->name("cabang.delete");

        Route::get("/panel/users",[UsersController::class,"users"])->name("users");
        Route::get("/panel/users/get/{id}",[UsersController::class,"get"])->name("users.get");
        Route::get("/panel/users/datatable",[UsersController::class,"datatable"])->name("users.datatable");
        Route::post("/panel/users/insert",[UsersController::class,"insert"])->name("users.insert");
        Route::post("/panel/users/update/{id}",[UsersController::class,"update"])->name("users.update");
        Route::post("/panel/users/delete/{id}",[UsersController::class,"delete"])->name("users.delete");
    });
    
    Route::get("/panel/settings",[DashboardController::class,"settings"])->name("settings");
    Route::post("/panel/settings",[DashboardController::class,"settings"])->name("settings");
    
    Route::get("/panel/contact",[ContactPesertaController::class,"contact"])->name("contact");
    Route::get("/panel/contact/datatable",[ContactPesertaController::class,"datatable"])->name("contact.datatable");
    Route::post("/panel/contact/insert",[ContactPesertaController::class,"insert"])->name("contact.insert");
    Route::post("/panel/contact/send_wa",[ContactPesertaController::class,"send_wa"])->name("contact.send_wa");
    Route::post("/panel/contact/insert_csv",[ContactPesertaController::class,"insert_csv"])->name("contact.insert_csv");
    Route::post("/panel/contact/delete/{id}",[ContactPesertaController::class,"delete"])->name("contact.delete");

    Route::get("/panel/logout",[AuthController::class,"logout"])->name("logout");

});