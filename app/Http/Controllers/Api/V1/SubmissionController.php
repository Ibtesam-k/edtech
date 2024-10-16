<?php

namespace App\Http\Controllers\Api\V1;


use App\Services\SubmissionLogger;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\SubmissionResource;
use App\Http\Requests\V1\StoreSubmissionRequest;
use App\Interfaces\SubmissionRepositoryInterface;
use App\Http\Requests\V1\BulkStoreSubmissionRequest;
use App\Http\Resources\V1\SubmissionLogResource;
use Exception;

class SubmissionController extends Controller
{
    protected $submissionRepository;
    protected $submissionLogger;

    public function __construct(SubmissionRepositoryInterface $submissionRepository,SubmissionLogger $submissionLogger)
    {
        $this->submissionRepository= $submissionRepository;
        $this->submissionLogger = $submissionLogger;
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
        $bulk = collect($request->validated()['submissions'])->map(function ($arr) {
            return array_merge($arr, ["submitted_at" => now()]);
        });

        $submissions = $bulk->toArray();

        $this->submissionRepository->bulkInsert($submissions);

        $this->submissionLogger->logSubmissions($submissions);

        return response()->json([
            'message' => 'Submissions processed successfully!',
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

    public function logs()
    {
        //
        return SubmissionLogResource::collection($this->submissionRepository->logs());

    }
}
