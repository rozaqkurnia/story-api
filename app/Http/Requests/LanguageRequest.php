<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class LanguageRequest extends FormRequest
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
        if ($this->has('slug') && $this->slug) {
            $this->merge([
                'slug' => Str::slug($this->slug),
            ]);
        } else if ($this->has('name') && $this->name) {
            $this->merge([
                'slug' => Str::slug($this->name),
            ]);
        }

        $this->merge([
            'id' => $this->route('language'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => [
                'nullable',
                Rule::exists('languages', 'id'),
            ],
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required', 
                'string', 
                'max:255',
                Rule::unique('languages', 'slug')
                    ->ignore($this->id, 'id'),
            ],
        ];
    }
}
