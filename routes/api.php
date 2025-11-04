<?php

use Illuminate\Support\Facades\Route;

// v1
Route::group(['prefix' => 'v1'], function() {
    Route::get('/info', function () {
        return response()->json([
            'success' => true,
            'message' => 'Vimeo Downloader v1'
        ], 200);
    });
});