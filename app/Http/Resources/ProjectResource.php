<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $deploymentChecks = $this->deploymentChecks;

        return [
            'id' => (int) $this->id,
            'name' => (string) $this->name,
            'owner_email' => (string) $this->owner_email,
            'total_checks' => (int) $deploymentChecks->count(),
            'completed_checks' => (int) $deploymentChecks->where('is_completed', true)->count(),
        ];
    }
}
