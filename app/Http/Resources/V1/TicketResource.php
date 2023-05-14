<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'status' => $this->status,
            'issue_headline' => $this->issue_headline,
            'issue_description' => $this->issue_description,
            'requested_by' => $this->requested_by,
            'requested_date' => $this->requested_date,
        ];
    }
}
