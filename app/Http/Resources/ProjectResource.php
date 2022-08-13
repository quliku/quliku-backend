<?php

namespace App\Http\Resources;

use DateTime;
use Exception;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     * @throws Exception
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'rejected_reason' => $this->when($this->status == 'reject', $this->reject_reason),
            'start_date' => (new DateTime($this->start_date))->format('Y-m-d'),
            'end_date' => (new DateTime($this->end_date))->format('Y-m-d'),
            'province' => $this->province,
            'city' => $this->city,
            'district' => $this->district,
            'village' => $this->village,
            'address' => $this->address,
            'total_price' => (float) $this->total_price,
            'document_url' => $this->document_url,
            'fix_people' => $this->fix_people ? ((int) $this->fix_people) : null,
            'transportation_fee' => (float) $this->transportation_fee ?: null,
            'already_paid' => (float) $this->already_paid ?: null,
            'payment_type' => $this->payment_type,
            'wa_number' => $this->wa_number,
            'created_at' => (new DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updated_at' => (new DateTime($this->updated_at))->format('Y-m-d H:i:s'),
            'payments' => PaymentResource::collection($this->whenLoaded('payments')),
            'contractor' => (new UserResource($this->whenLoaded('contractor'))),
            'foreman' => (new UserResource($this->whenLoaded('foreman'))),
        ];
    }
}
