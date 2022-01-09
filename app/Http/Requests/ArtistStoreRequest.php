<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ArtistStoreRequest extends FormRequest
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

    public function prepareForValidation()
    {
        if ($this->has('slug') && $this->slug != null) {
            $this->merge([
                'slug' => Str::slug($this->slug),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'slug' => 'required|string|max:100|unique:artists,slug',
            'country_ids' => 'nullable|array',
            'country_ids.*' => 'exists:countries,id',
            'meta_keywords' => 'sometimes|string',
            'meta_description' => 'sometimes|string',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
        ];
    }
}
