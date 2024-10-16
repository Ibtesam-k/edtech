<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Resources\V1\SubmissionResource;
use App\Http\Requests\V1\StoreSubmissionRequest;
use App\Interfaces\SubmissionRepositoryInterface;
use App\Http\Requests\V1\BulkStoreSubmissionRequest;


class SubmissionController extends Controller
{
    protected $submissionRepository;

    public function __construct(SubmissionRepositoryInterface $submissionRepository)
    {
        $this->submissionRepository= $submissionRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return SubmissionResource::collection($this->submissionRepository->all());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubmissionRequest $request)
    {
        //
        $validated = $request->validated();
        $validated = array_merge($validated, ['submitted_at' => now()]);
        return new SubmissionResource($this->submissionRepository->create( $validated ));
    }

        /**
     * Store a newly created resource in storage.
     */
    public function blukStore(BulkStoreSubmissionRequest $request)
    {
        // Validate the request and add submission timestamps
        $bulk = collect($request->validated()['submissions'])->map(function ($arr) {
            return array_merge($arr, ["submitted_at" => now()]);
        });

        // Convert the submissions to an array for bulk insert
        $submissions = $bulk->toArray();

        // Insert submissions into the database
        $this->submissionRepository->bulkInsert($submissions);

        return response()->json([
            'message' => 'Submissions inserted successfully!',
        ], 200);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return new SubmissionResource($this->submissionRepository->findById($id));
    }

 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->submissionRepository->delete($id);
    }
}
