<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string)$this->id,
            'attributes' => [
                'name' => $this->name,
                'priority' => $this->priority,
                'created_at' => $this->created_at,
                'updated_at' => $this->created_at,
            ],
            'relationships' => [
                'id' => (string)$this->user->id,
                'user_name' => $this->user->name,
                'user_email' => $this->user->email,
            ]
        ];
    }
}
