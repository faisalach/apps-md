<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactPesertaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilTesController;
use App\Http\Controllers\KuesionerController;
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

Route::group(["middleware" => "guest"],function(){
    Route::redirect("/panel","/panel/login");
    Route::get("/panel/login",[AuthController::class,"login"])->name("login");
    Route::post("/panel/login",[AuthController::class,"authenticated"])->name("authenticated");
});
Route::group(["middleware" => "auth"],function(){
    Route::get("/panel/dashboard",[DashboardController::class,"dashboard"])->name("dashboard");
    Route::get("/panel/kuesioner/datatable",[KuesionerController::class,"datatable"])->name("kuesioner.datatable");
    Route::get("/panel/kuesioner/export_csv",[DashboardController::class,"export"])->name("kuesioner.export_csv");

    Route::get("/panel/settings",[DashboardController::class,"settings"])->name("settings");
    Route::post("/panel/settings",[DashboardController::class,"settings"])->name("settings");
    Route::get("/panel/settings/hasil_tes/{kode_angka}",[HasilTesController::class,"get"])->name("settings.hasil_tes.get");
    Route::post("/panel/settings/hasil_tes/{kode_angka}/update",[HasilTesController::class,"update"])->name("settings.hasil_tes.update");

    Route::get("/panel/contact",[ContactPesertaController::class,"contact"])->name("contact");
    Route::get("/panel/contact/datatable",[ContactPesertaController::class,"datatable"])->name("contact.datatable");
    Route::post("/panel/contact/insert",[ContactPesertaController::class,"insert"])->name("contact.insert");
    Route::post("/panel/contact/send_wa",[ContactPesertaController::class,"send_wa"])->name("contact.send_wa");
    Route::post("/panel/contact/insert_csv",[ContactPesertaController::class,"insert_csv"])->name("contact.insert_csv");
    Route::post("/panel/contact/delete/{id}",[ContactPesertaController::class,"delete"])->name("contact.delete");

    Route::get("/panel/logout",[AuthController::class,"logout"])->name("logout");
});