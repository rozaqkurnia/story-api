<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'slug' => 'nullable|string|max:191|unique:posts,slug',
            'body' => 'required|string',
        ];
    }
}
