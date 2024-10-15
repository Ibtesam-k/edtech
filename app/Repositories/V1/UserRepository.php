<?php
namespace App\Repositories\V1;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function all() {
        return $this->model->all();
    }

    public function create(array $data) {
        $data['password'] = Hash::make($data['password']);
        return $this->model->create($data);
    }

    public function update($id, array $data) {
        $user = $this->findById($id);
        return $user->update($data);
    }

    public function delete($id) {
        return $this->model->destroy($id);
    }

    public function findById($id) {
        return $this->model->find($id);
    }
}
