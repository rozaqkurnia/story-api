<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AlbumResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'country' => $this->country->name,
            'releaseYear' => $this->release_year,
            'isDraft' => $this->is_draft,
            'isPublished' => $this->is_published,
            'publishedAt' => $this->published_at ? $this->published_at->timestamp : $this->published_at,
            'excerpt' => $this->excerpt,
            'description' => $this->description,
            'artist' => $this->artist->name,
        ];
    }
}
