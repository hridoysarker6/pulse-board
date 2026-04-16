<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeploymentCheckResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'title' => (string) $this->title,
            'is_completed' => (bool) $this->is_completed,
            'project_id' => (int) $this->project_id,
            'project_name' => $this->project ? (string) $this->project->name : null,
        ];
    }
}
