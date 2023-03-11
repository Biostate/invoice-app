<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'from_street_address' => $this->from_street_address,
            'from_city' => $this->from_city,
            'from_post_code' => $this->from_post_code,
            'from_country' => $this->from_country,
            'to_street_address' => $this->to_street_address,
            'to_city' => $this->to_city,
            'to_post_code' => $this->to_post_code,
            'to_country' => $this->to_country,
            'description' => $this->description,
            'client_name' => $this->client_name,
            'client_email' => $this->client_email,
            'payment_terms' => $this->payment_terms,
            'status' => $this->status,
            'payment_due' => $this->payment_due,
            'invoice_date' => $this->invoice_date,
            'total' => $this->total,
            'created_at' => $this->created_at,
            'items' => InvoiceItemResource::collection($this->items),
        ];
    }
}
