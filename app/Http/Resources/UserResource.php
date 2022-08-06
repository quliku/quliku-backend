<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserResource extends JsonResource
{
    public function setToken(string $token)
    {
        $this->token = $token;
    }

    public function getProfileImageUrl(string $name): string
    {
        if ($name == 'user-default.png'){
            return asset('images/'. $name);
        }
        return asset('storage/profile_images/' . $name);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $response = [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'role' => $this->role,
            'profile_url' => $this->getProfileImageUrl($this->profile_url),
            'rating' => $this->whenLoaded('foremanRatings')->avg('rating'),
            'details' => (new ForemanDetailResource($this->whenLoaded('foremanDetail'))),
            'images' => ForemanImageResource::collection($this->whenLoaded('foremanImages')),
            'comments' => RatingResource::collection($this->whenLoaded('foremanRatings')),
        ];

        if ($this->token) {
            $response['token'] = $this->token;
        }

        return $response;
    }
}
