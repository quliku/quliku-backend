<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ForemanImageResource extends JsonResource
{
    public function getForemanImageUrl(string $name): string
    {
        return asset('storage/foreman_images/' . $name);
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
            'photo_url' => $this->getForemanImageUrl($this->photo_url),
            'type' => $this->type,
        ];
    }
}
