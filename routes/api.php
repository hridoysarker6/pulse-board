<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(
        [
            'status' => 200,
            'message' => 'running successfully'
        ]
    );
});


