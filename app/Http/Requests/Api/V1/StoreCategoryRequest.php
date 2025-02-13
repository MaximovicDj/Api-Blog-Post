<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\Api\BaseCategoryRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends BaseCategoryRequest
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
            'data.attributes.name' => ['required', 'string', 'unique:categories,name', 'min:3', 'max:50'],
            'data.attributes.status' => ['required', 'int', 'in:0,1'],
        ];
    }
}
