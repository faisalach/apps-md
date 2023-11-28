<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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




Route::group(["middleware" => "guest"],function(){
    Route::redirect("/","/form");
    Route::get("/form",[KuesionerController::class,"form"])->name("kuesioner.form");
    Route::post("/form/store",[KuesionerController::class,"form_store"])->name("kuesioner.formStore");
    
    Route::redirect("/panel","/panel/login");
    Route::get("/panel/login",[AuthController::class,"login"])->name("login");
    Route::post("/panel/login",[AuthController::class,"authenticated"])->name("authenticated");
});
Route::group(["middleware" => "auth"],function(){
    Route::get("/panel/dashboard",[DashboardController::class,"dashboard"])->name("dashboard");

    Route::get("/panel/settings",[AuthController::class,"settings"])->name("settings");
    Route::post("/panel/settings",[AuthController::class,"settings"])->name("settings");

    Route::get("/panel/logout",[AuthController::class,"logout"])->name("logout");
});