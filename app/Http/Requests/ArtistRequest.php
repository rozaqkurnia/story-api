<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArtistRequest extends FormRequest
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
        } else if ($this->has('title') && $this->title) {
            $this->merge([
                'slug' => Str::slug($this->title),
            ]);
        }

        if ($this->has('is_draft') && ($this->is_draft == "1" || $this->is_draft == "on" || $this->is_draft == "yes" || $this->is_draft == true || $this->is_draft == "true")) {
            $this->merge([
                'is_draft' => true,
            ]);
        } else {
            $this->merge([
                'is_draft' => false,
            ]);
        }

        if ($this->has('is_published') && ($this->is_published == "1" || $this->is_published == "on" || $this->is_published == "yes" || $this->is_published == true || $this->is_published == "true")) {
            $this->merge([
                'is_published' => true,
            ]);
        } else {
            $this->merge([
                'is_published' => false,
            ]);
        }

        if (! $this->has('published_at') && $this->has('is_published')) {
            $this->merge([
                'published_at' => Carbon::now()->format('Y-m-d\TH:i:sO'),
            ]);
        }

        $this->merge([
            'id' => $this->route('artist'),
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
                Rule::exists('artists', 'id'),
            ],
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required', 
                'string', 
                'max:255',
                Rule::unique('artists', 'slug')
                    ->ignore($this->id, 'id'),
            ],
            'featured_image' => ['nullable'],
            'excerpt' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'is_draft' => ['required', 'boolean'],
            'is_published' => ['required', 'boolean'],
            'published_at' => ['nullable', 'date_format:Y-m-d\TH:i:sO'], // PHP DateTime ISO8601
            'countries' => ['required', 'array'],
            'countries.*.id' => [
                'required',
                Rule::exists('countries', 'id'),
            ],
        ];
    }
}
