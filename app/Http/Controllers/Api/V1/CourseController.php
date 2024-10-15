<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CourseResource;
use App\Http\Requests\V1\StoreCourseRequest;
use App\Http\Requests\V1\UpdateCourseRequest;
use App\Interfaces\CourseRepositoryInterface;

class CourseController extends Controller
{
    protected $courseRepository;

    public function __construct(CourseRepositoryInterface $userRepository)
    {
        $this->courseRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return CourseResource::collection($this->courseRepository->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        //
        $validated = $request->validated();
        return new CourseResource($this->courseRepository->create( $validated ));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return new CourseResource($this->courseRepository->findById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, string $id)
    {
        //
        $this->courseRepository->update($id,$request->validated());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->courseRepository->delete($id);
    }
}
