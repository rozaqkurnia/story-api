<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SongResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'title' => $this->title,
            'slug' => $this->slug,
            'knownAs' => $this->known_as,
            'excerpt' => $this->excerpt,
            'releaseDate' => $this->release_date ? $this->release_date->timestamp : $this->release_date,
            'releaseYear' => $this->release_year,
            'number' => $this->number,
            'discNumber' => $this->disc_number,
            'original' => $this->original,
            'romanized' => $this->romanized,
            'featuredImage' => $this->featured_image,
            'isCollaboration' => $this->is_collaboration,
            'isFeaturing' => $this->is_featuring,
            'isPublished' => $this->is_published,
            'isDraft' => $this->is_draft,
            'publishedAt' => $this->published_at ? $this->published_at->timestamp : $this->published_at,
            'album' => AlbumResource::make($this->album),
            'languages' => LanguageResource::collection($this->languages),
            'artists' => ArtistResource::collection($this->performers),
            'songwriters' => ArtistResource::collection($this->songwriters),
            'composers' => ArtistResource::collection($this->composers),
            'genres' => GenreResource::collection($this->genres),
            'publishedBy' => $this->user->name,
            'createdAt' => $this->created_at->timestamp,
        ];
    }
}
