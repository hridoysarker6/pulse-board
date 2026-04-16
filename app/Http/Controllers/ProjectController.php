<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('deploymentChecks')->orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => 200,
            'message' => 'Projects retrieved successfully',
            'data' => ProjectResource::collection($projects),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $validatedData = $request->validated();

        $project = Project::create($validatedData);

        return response()->json([
            'status' => 201,
            'message' => 'Project created successfully',
            'data' => ProjectResource::make($project),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function readiness(Project $project)
    {
        $deploymentChecks = $project->deploymentChecks()->get();

        return response()->json([
            'status' => 200,
            'message' => 'Project readiness retrieved successfully',
            'data' => [
                'project' => (string) $project->name,
                'total_checks' => (int) $deploymentChecks->count(),
                'completed_checks' => (int) $deploymentChecks->where('is_completed', true)->count(),
                'is_ready_for_deployment' => (bool) $deploymentChecks->where('is_completed', false)->count() === 0,
            ],
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Project deleted successfully',
        ], 200);
    }
}
