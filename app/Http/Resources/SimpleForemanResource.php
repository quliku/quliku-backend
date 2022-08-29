<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;
use phpDocumentor\Reflection\Types\Float_;

class SimpleForemanResource extends JsonResource
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
            'rating' => (float) $this->rating ?? 0,
            'details' => [
                'subscription' => $this->subscription_type,
                'is_work' => $this->is_work,
                'city' => $this->city,
                'wa_number' => $this->wa_number,
                'classification' => $this->classification,
                'description' => $this->description,
                'experience' => $this->experience,
                'min_people' => $this->min_people,
                'max_people' => $this->max_people,
            ],
        ];
    }
}
