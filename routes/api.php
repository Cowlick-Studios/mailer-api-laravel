<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return Response([
        'message' => 'Current user.',
        'user' => $request->user()
    ], 200); 
})->middleware('auth:sanctum');
