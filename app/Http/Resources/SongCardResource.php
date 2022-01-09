<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SongCardResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt->limit(150),
            'featuredImage' => $this->featured_image,
            'isPublished' => $this->is_published,
            'isDraft' => $this->is_draft,
            'publishedAt' => $this->published_at ? $this->published_at->timestamp : $this->published_at,
            'artists' => AsTagResource::collection($this->performers),
            'songwriters' => AsTagResource::collection($this->songwriters),
            'composers' => AsTagResource::collection($this->composers),
            'genres' => AsTagResource::collection($this->genres),
            'publishedBy' => $this->user->name,
            'likesCount' => $this->likes_count,
            'commentsCount' => $this->comments_count,
        ];
    }
}
