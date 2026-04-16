<?php

use App\Http\Controllers\DeploymentCheckController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(
        [
            'status' => 200,
            'message' => 'running successfully',
        ]
    );
});

Route::get('projects', [ProjectController::class, 'index']);
Route::post('projects', [ProjectController::class, 'store']);
Route::get('projects/{project}/readiness', [ProjectController::class, 'readiness']);
Route::delete('projects/{project}', [ProjectController::class, 'destroy']);

Route::post('projects/{project}/checks', [DeploymentCheckController::class, 'store']);

Route::patch('checks/{deploymentCheck}/complete', [DeploymentCheckController::class, 'markAsComplete']);
