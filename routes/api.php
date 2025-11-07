<?php

use Illuminate\Support\Facades\Route;

// v1 Controllers
use App\Http\Controllers\API\v1\DownloadController;

// v1 Routes
Route::group(['prefix' => 'v1'], function() {
    Route::get('/info', function () {
        return response()->json([
            'success' => true,
            'message' => 'Vimeo Downloader v1'
        ], 200);
    });

    Route::get('/download', [DownloadController::class, 'download'])->middleware('api.middleware');

});