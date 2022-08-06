<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ForemanDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'subscription' => $this->subscription_type,
            'is_work' => $this->is_work,
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
    }
}
