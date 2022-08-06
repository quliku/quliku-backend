<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class SimpleUserResource extends JsonResource
{
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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'role' => $this->role,
            'profile_url' => $this->getProfileImageUrl($this->profile_url),
        ];
    }
}
