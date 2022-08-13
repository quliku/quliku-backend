<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class PaymentResource extends JsonResource
{
    private function getPaymentPhotoUrl(int $project_id,string $name): string
    {
        return asset('storage/project/'. $project_id. '/payment/' . $name);
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
            'photo_url' => $this->getPaymentPhotoUrl($this->project_id,$this->photo_url),
            'amount' => (int) $this->amount,
            'status' => $this->status,
            'description' => $this->description,
        ];
    }
}
