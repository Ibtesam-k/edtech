<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Http\Requests\V1\StoreUserRequest;
use App\Http\Requests\V1\UpdateUserRequest;
use App\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $validRoles = [User::ROLE_STUDENT,User::ROLE_TEACHER];

        $role = $request->query('role');
      
        if ($role && !in_array($role, $validRoles)) {
            return response()->json([
                'error' => 'Invalid role. Valid roles are: ' . implode(', ', $validRoles),
            ], 400);
        }
        else if($role)
        {
            return UserResource::collection($this->userRepository->getUsersByRole($role));

        }
        return UserResource::collection($this->userRepository->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
        $validated = $request->validated();
        $newUser = $this->userRepository->create($validated);
        return new  UserResource($newUser);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return new UserResource($this->userRepository->findById($id));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        //
        $this->userRepository->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $this->userRepository->delete($id);
    }
}
