<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssignmentResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'course_id' => $this->course_id,
            'due_date' => $this->due_date->format('Y-m-d H:i'),
           // 'course' => new CourseResource($this->whenLoaded('course')), 
        ];
    }
}
