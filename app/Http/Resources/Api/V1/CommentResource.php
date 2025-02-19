<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'comment',
            'id' => $this->id,
            'attributes' => [
                'comment' => $this->comment,
                'user' => $this->user->name,
                'post' => $this->post->title,
                'createdAt' => $this->created_at
            ]
        ];
    }
}
