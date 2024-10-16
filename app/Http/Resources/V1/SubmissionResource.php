<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubmissionResource extends JsonResource
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
            'student_id' => $this->student_id,
            'submitted_at' => $this->submitted_at->format('Y-m-d H:i:s'),
            'file_path'=>$this->file_path,
            'student' => new UserResource($this->whenLoaded('student')), // Load student details
           

        ];
    }
}
