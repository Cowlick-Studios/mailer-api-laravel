<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\EmailSubmissionController;


Route::get('/user', function (Request $request) {
    return Response([
        'message' => 'Current user.',
        'user' => $request->user()
    ], 200); 
})->middleware('auth:sanctum');

Route::prefix('email_submission')->middleware('auth:sanctum')->group(function() {
    Route::get('/', [EmailSubmissionController::class, 'index']);
    Route::get('/{emailSubmission}', [EmailSubmissionController::class, 'show']);
    Route::post('/', [EmailSubmissionController::class, 'store']);
    Route::put('/{emailSubmission}', [EmailSubmissionController::class, 'update']);
    Route::patch('/{emailSubmission}', [EmailSubmissionController::class, 'update']);
    Route::delete('/{emailSubmission}', [EmailSubmissionController::class, 'detroy']);

    Route::post('/{emailSubmission}/field', [EmailSubmissionController::class, 'addField']);
    Route::delete('/{emailSubmission}/field/{field}', [EmailSubmissionController::class, 'removeField']);
    Route::post('/{emailSubmission}/recipiant', [EmailSubmissionController::class, 'addRecipiant']);
    Route::delete('/{emailSubmission}/recipiant/{recipiant}', [EmailSubmissionController::class, 'removeRecipiant']);
});
