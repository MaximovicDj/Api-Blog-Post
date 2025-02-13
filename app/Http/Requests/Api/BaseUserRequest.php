<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class BaseUserRequest extends FormRequest
{
    public function mappedData()
    {
        $dataForUpdate = [];
        $data = [
            'name' => 'data.attributes.name',
            'email' => 'data.attributes.email',
            'password' => 'data.attributes.password',
            'role_id' => 'data.attributes.role_id',
            'status' => 'data.attributes.status',
        ];

        foreach($data as $key => $value)
        {
            if($this->has($value))
            {
                $dataForUpdate[$key] = $this->input($value);
            }
        }
        $dataForUpdate['password'] = Hash::make($dataForUpdate['password']); // password - password
        return $dataForUpdate;
    }
}
