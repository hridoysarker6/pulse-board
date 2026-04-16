<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeploymentCheckRequest;
use App\Http\Resources\DeploymentCheckResource;
use App\Models\DeploymentCheck;
use App\Models\Project;

class DeploymentCheckController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Project $project, DeploymentCheckRequest $request)
    {
        $validatedData = $request->validated();

        $deploymentCheck = new DeploymentCheck($validatedData);
        $deploymentCheck->project()->associate($project);
        $deploymentCheck->save();

        return response()->json([
            'status' => 201,
            'message' => 'Deployment check created successfully',
            'data' => DeploymentCheckResource::make($deploymentCheck),
        ], 201);
    }

    public function markAsComplete(DeploymentCheck $deploymentCheck)
    {
        if ($deploymentCheck->is_completed) {
            return response()->json([
                'status' => 400,
                'message' => 'Deployment check is already marked as complete',
            ], 400);
        }
        $deploymentCheck->is_completed = true;
        $deploymentCheck->completed_at = now();
        $deploymentCheck->save();

        return response()->json([
            'status' => 200,
            'message' => 'Deployment check marked as complete',
            'data' => DeploymentCheckResource::make($deploymentCheck),
        ]);
    }
}
