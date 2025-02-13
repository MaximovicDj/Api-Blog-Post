<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'category',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'status' => $this->status,
                $this->mergeWhen($request->routeIs('categories.show', 'categories.store'), [
                    'createdAt' => $this->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
                    'softDeleted' => $this->deleted_at ? $this->deleted_at->format('Y-m-d H:i:s') : null,
                ])
            ]
        ];
    }
}
