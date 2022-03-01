<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JoinNowController;

use App\Http\Controllers\ContactController;
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/admin/dashboard/join-now',[JoinNowController::class,'getAllJoinNowData']);
Route::post('/join-now',[JoinNowController::class,'addJoinNow']);

Route::get('/admin/dashboard/contact',[ContactController::class,'getAllContactData']);
Route::post('/contact',[ContactController::class,'addContact']);