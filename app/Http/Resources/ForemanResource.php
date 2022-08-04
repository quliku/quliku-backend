<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ForemanResource extends JsonResource
{
    public function setUser(array $user)
    {
        $this->user_data = $user;
    }

    public function setImages(array $images)
    {
        $this->images = $images;
    }

    public function setRating(float $rating)
    {
        $this->rating = $rating;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $response =  [
            'city' => $this->city,
            'wa_number' => $this->wa_number,
            'classification' => $this->classification,
            'description' => $this->description,
            'experience' => $this->experience,
            'min_people' => $this->min_people,
            'max_people' => $this->max_people,
            'price' => $this->price,
            'bank_type' => $this->bank_type,
            'account_name' => $this->account_name,
            'account_number' => $this->account_number,
        ];

        if (isset($this->user_data)) {
            $response = array_merge($this->user_data, $response);
        }

        if (isset($this->images)) {
            $response['images'] = $this->images;
        }

        if (isset($this->rating)) {
            $response['rating'] = $this->rating;
        }

        return $response;
    }
}
