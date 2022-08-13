<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ReportResource extends JsonResource
{
    private function getImageUrl(string $name): string
    {
        return asset('storage/project/'. $this->project_id . '/report/' . $name);
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
            'user_id' => $this->user_id,
            'project_id' => $this->project_id,
            'percentage' => $this->percentage,
            'description' => $this->description,
            'images' => $this->images->map(function ($image) {
                return $this->getImageUrl($image->photo_url);
            }),
        ];
    }
}
