<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class BasePostRequest extends FormRequest
{
    /**
     * @return array
     */
    public function mappedData(): array
    {
        $dataForStore = [];
        $data = [
            'title' => 'data.attributes.title',
            'slug' => 'data.attributes.slug',
            'description' => 'data.attributes.description',
            'status' => 'data.attributes.status',
            'user_id' => 'data.relationships.author.data.id',
            'category_id' => 'data.relationships.category.data.id'
        ];

        foreach ($data as $key => $value)
        {
            if($this->has($value))
            {
                $dataForStore[$key] = $this->input($value);
            }
        }
        return $dataForStore;
    }
}
