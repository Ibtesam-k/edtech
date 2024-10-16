<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubmissionLogResource extends JsonResource
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
            'assignment_id' => $this->assignment_id,
            'status' => $this->status,
            'api_response_id' => $this->api_response_id??"not available",
            'response_data' => $this->response_data?json_decode( $this->response_data):"not available",
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),

        ];
    }
}

