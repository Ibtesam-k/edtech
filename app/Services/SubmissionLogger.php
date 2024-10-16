<?php

namespace App\Services;

use App\Models\SubmissionLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class SubmissionLogger
{
    public function logSubmissions($submissions)
    {
        $url ='https://jsonplaceholder.typicode.com/posts';


       
    // Using the Pool method for concurrent requests
        $responses = Http::pool(fn ($pool) => collect($submissions)->map(function ($submission) use ($pool, $url) {
            return $pool->as($submission['assignment_id'])->post($url, [
                'assignment_id' => $submission['assignment_id'],
                'student_id'    => $submission['student_id'],
                'submitted_at'  => $submission['submitted_at']->toDateTimeString(),
            ]);
        })->toArray());

        // Handle responses and log them
        foreach ($responses as $key => $response) {
            if ($response->successful()) {
                $apiResponseId = $response->json('id');  // Get the ID from the response

                // Log the successful submission to the database
                SubmissionLog::create([
                    'assignment_id'   => $key,
                    'api_response_id' => $apiResponseId,
                    'status'          => 'success',
                    'response_data'   => json_encode($response->json()),
                ]);

            } else {
                SubmissionLog::create([
                    'assignment_id'   => $key,
                    'status'          => 'failed',
                    'response_data'   =>$response->body(),
                ]);
            }
        } 
       
    }
}
