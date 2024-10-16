<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AssignmentResource;
use App\Http\Requests\V1\StoreAssignmentRequest;
use App\Http\Requests\V1\UpdateAssignmentRequest;
use App\Interfaces\AssignmentRepositoryInterface;

class AssignmentController extends Controller
{
    protected $assignmentRepository;

    public function __construct(AssignmentRepositoryInterface $assignmentRepository)
    {
        $this->assignmentRepository= $assignmentRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return AssignmentResource::collection($this->assignmentRepository->all());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssignmentRequest $request)
    {
        //
        $validated = $request->validated();
        return new AssignmentResource($this->assignmentRepository->create( $validated ));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return new AssignmentResource($this->assignmentRepository->findById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssignmentRequest $request, string $id)
    {
        //
        $this->assignmentRepository->update($id,$request->validated());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->assignmentRepository->delete($id);
    }
}
