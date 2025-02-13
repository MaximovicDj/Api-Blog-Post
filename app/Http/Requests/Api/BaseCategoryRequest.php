<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class BaseCategoryRequest extends FormRequest
{
    public function mappedData()
    {
        $dataForUpdate = [];
        $data = [
            'name' => 'data.attributes.name',
            'status' => 'data.attributes.status',
        ];

        foreach($data as $key => $value)
        {
            if($this->has($value))
            {
                $dataForUpdate[$key] = $this->input($value);
            }
        }
        return $dataForUpdate;
    }
}
