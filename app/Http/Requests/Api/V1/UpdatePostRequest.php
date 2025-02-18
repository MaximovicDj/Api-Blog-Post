<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\Api\BasePostRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends BasePostRequest
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
        $rules = [
            'data.attributes.title' => ['required', 'string', 'min:10', 'max:255', Rule::unique('posts', 'title')->ignore($this->title)],
            'data.attributes.description' => ['required', 'string', 'min:10', 'max:255'],
            'data.attributes.status' => ['required', 'integer', 'in:0,1'],
            'data.relationships.category.data.id' => ['required', 'integer', 'exists:categories,id'],
        ];
        if($this->routeIs('posts.store'))
        {
            $rules['data.relationships.author.data.id'] = ['required', 'integer', 'exists:users,id'];
        }
        return $rules;
    }
}
