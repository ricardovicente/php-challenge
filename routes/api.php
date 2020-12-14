<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', function (Request $request) {
        return $request->user();
    });

    Route::get('/files', ['App\Http\Controllers\Api\FileController', 'index']);

    Route::get('/files/{id}/items', ['App\Http\Controllers\Api\FileController', 'items']);
});
