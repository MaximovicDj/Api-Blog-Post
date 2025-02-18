<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'post',
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'slug' => $this->slug,
                'description' => $this->when($request->routeIs('posts.show'), $this->description),
                'status' => $this->status ? 'Active' : 'Inactive',
                'user' => $this->user->name,
                'category' => $this->category->name,
                $this->mergeWhen($request->routeIs('posts.show'), [
                    'createdAt' => optional($this->created_at)->format('Y-m-d H:i:s'),
                    'updatedAt' => optional($this->updated_at)->format('Y-m-d H:i:s'),
                    'deletedAt' => optional($this->deleted_at)->format('Y-m-d H:i:s')
                ])
            ],
            'relationships' => [
                'author' => [
                    'data' => [
                        'type' => 'user',
                        'id' => $this->user_id
                    ]
                ],
                'category' => [
                    'data' => [
                        'type' => 'category',
                        'id' => $this->category_id
                    ]
                ]
            ],
            'links' => [
                'self' => route('posts.show', $this->id),
            ],
            'included' => new UserResource($this->user)
        ];
    }
}
