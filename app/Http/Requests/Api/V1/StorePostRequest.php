<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\Api\BasePostRequest;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends BasePostRequest
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
            'data.attributes.title' => ['required', 'string', 'min:10', 'max:255', 'unique:posts,title'],
            'data.attributes.description' => ['required', 'string', 'min:10', 'max:255'],
            'data.attributes.status' => ['required', 'integer', 'in:0,1'],
            'data.relationships.author.data.id' => ['required', 'integer', 'exists:users,id'],
            'data.relationships.category.data.id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }
}
