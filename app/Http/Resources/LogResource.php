<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'logable_id' => $this->logable_id,
            'logable_type' => $this->logable_type,
            'action_type' => $this->action_type,
            'created_at' => $this->created_at,
            'user' => new UserResource($this->user),
        ];
    }
}
