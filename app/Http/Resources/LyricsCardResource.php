<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class LyricsCardResource extends JsonResource
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
            'excerpt' => Str::limit($this->short_description,155),
            'performers' => ArtistCardResource::collection($this->performers),
            'featuring' => $this->featuring,
            'collaboration' => $this->collaboration,
            'genres' => GenreCardResource::collection($this->genres),
            'featuredImage' => $this->featured_image_path,
            'year' => $this->year,
            'postBy' => $this->user->name,
            'createdAt' => $this->created_at->diffForHumans(),
        ];
    }
}
