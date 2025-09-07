<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'order_date' => $this->order_date,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'status_text' => $this->getStatusText(),
            'user' => new UserResource($this->whenLoaded('user')),
            'order_details' => OrderDetailResource::collection($this->whenLoaded('orderDet')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    /**
     * Get status text based on status number
     */
    private function getStatusText(): string
    {
        return match ($this->status) {
            1 => 'Pending',
            2 => 'Processing',
            3 => 'Shipped',
            4 => 'Delivered',
            5 => 'Cancelled',
            default => 'Unknown',
        };
    }
}
