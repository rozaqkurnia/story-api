<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArtistResource extends JsonResource
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
            'name' => $this->name,
            'knownAs' => $this->known_as,
            'title' => $this->title,
            'slug' => $this->slug,
            'featuredImage' => $this->featured_image,
            'excerpt' => $this->excerpt,
            'description' => $this->description,
            'isDraft' => $this->is_draft,
            'isPublished' => $this->is_published,
            'publishedAt' => $this->published_at ? $this->published_at->timestamp : $this->published_at,
            'country' => CountryResource::collection($this->countries),
        ];
    }
}
