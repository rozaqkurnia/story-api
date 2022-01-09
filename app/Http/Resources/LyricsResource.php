<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LyricsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'song' => $this->song,
            'aka' => $this->aka,
            'album' => $this->album,
            'year' => $this->year,
            'featuredImage' => $this->featured_image_path,
            'shortDescription' => $this->short_description,
            'romaji' => nl2br($this->romaji),
            'original' => nl2br($this->original),
            'enTranslation' => $this->en_translation,
            'idTranslation' => $this->id_translation,
            'collaboration' => $this->collaboration,
            'featuring' => $this->featuring,
            'updatedAt' => $this->updated_at,
            'performers' => ArtistResource::collection($this->performers),
            'composers' => ArtistResource::collection($this->composers),
            'lyricists' => ArtistResource::collection($this->lyricists),
            'genres' => GenreResource::collection($this->genres),
            'language' => new LanguageResource($this->language),
            'country' => new CountryResource($this->country),
            'user' => new UserResource($this->user),
            'meta' => new MetaResource($this->meta),
        ];
    }
}
