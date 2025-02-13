<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'user',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role->name,
                'status' => $this->status ? 'active' : 'inactive',
                $this->mergeWhen($request->routeIs('users.show', 'users.store', 'users.update'), [
                    'createdAt' => optional($this->created_at)->format('Y-m-d H:i:s'),
                    'updatedAt' => optional($this->updated_at)->format('Y-m-d H:i:s'),
                    'deletedAt' => optional($this->deleted_at)->format('Y-m-d H:i:s'),
                ])
            ]
        ];
    }
}
