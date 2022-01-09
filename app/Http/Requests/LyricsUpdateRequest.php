<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LyricsUpdateRequest extends FormRequest
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
        if ($this->has('performer_type')) {
            if ($this->performer_type == 'collaboration') {
                $this->merge([
                    'collaboration' => true,
                ]);
            }

            if ($this->performer_type == 'featuring') {
                $this->merge([
                    'featuring' => true,
                ]);
            }
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
            'performer_ids' => 'required|array',
            'performer_ids.*' => 'exists:artists,id',
            'composer_ids' => 'required|array',
            'composer_ids.*' => 'exists:artists,id',
            'lyricist_ids' => 'required|array',
            'lyricist_ids.*' => 'exists:artists,id',
            'genre_ids' => 'required|array',
            'genre_ids.*' => 'exists:genres,id',
            'country_id' => 'nullable|exists:countries,id',
            'language_id' => 'nullable|exists:languages,id',
            'title' => ['required','string','max:191', Rule::unique('lyrics', 'title')->ignore($this->id)],
            'slug' => ['nullable','string','max:191', Rule::unique('lyrics', 'slug')->ignore($this->id)],
            'song' => 'required|string|max:191',
            'aka' => 'nullable|string|max:191',
            'album' => 'nullable|string|max:191',
            'year' => 'nullable|date_format:Y',
            'short_description' => 'nullable|string',
            'romaji' => 'nullable|string',
            'original' => 'nullable|string',
            'en_translation' => 'nullable|string',
            'id_translation' => 'nullable|string',
            'featured_image' => 'nullable|mimes:jpg,jpeg,png|max:5120',
            'collaboration' => 'sometimes|boolean',
            'featuring' => 'sometimes|boolean',
            'meta_keywords' => 'sometimes|string',
            'meta_description' => 'sometimes|string',
        ];
    }
}
