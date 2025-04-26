<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobPositionController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\RecruitmentStageController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Custom routes first - before resource routes
    Route::get('/applications/report', [ApplicationController::class, 'dailyReport'])->name('applications.report');
    
    // Resource routes
    Route::resource('job_positions', JobPositionController::class);
    Route::resource('applicants', ApplicantController::class);
    Route::resource('applications', ApplicationController::class)->except(['show']);
    Route::resource('recruitment_stages', RecruitmentStageController::class);
});