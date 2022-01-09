<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tag_ids' => 'required|array',
            'tag_ids.*' => 'exists:tags,id',
            'title' => 'required|string|max:191',
            'slug' => ['nullable','string','max:191', Rule::unique('posts', 'slug')->ignore($this->id)],
            'body' => 'required|string',
        ];
    }
}
