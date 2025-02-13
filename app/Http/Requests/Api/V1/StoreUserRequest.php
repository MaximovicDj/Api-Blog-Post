<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\Api\BaseUserRequest;

class StoreUserRequest extends BaseUserRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data.attributes.name' => ['required', 'string', 'min:3', 'max:255'],
            'data.attributes.email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'data.attributes.password' => ['required', 'string', 'min:8'],
            'data.attributes.role_id' => ['required', 'integer', 'exists:roles,id'],
            'data.attributes.status' => ['required', 'integer', 'in:0,1'],
        ];
    }
}
