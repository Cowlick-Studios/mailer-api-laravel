<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\EmailSubmissionController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'deauthenticate'])->middleware('auth:sanctum');

Route::post('/submit/{email_submission_name}', [EmailSubmissionController::class, 'submit']);
