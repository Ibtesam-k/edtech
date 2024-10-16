<?php
namespace App\Repositories\V1;


use App\Interfaces\AssignmentRepositoryInterface;
use App\Models\Assignment;

class AssignmentRepository implements AssignmentRepositoryInterface
{
    protected $model;

    public function __construct(Assignment $assignment)
    {
        $this->model = $assignment;
    }

    public function all() {
        return $this->model->get();
    }

    public function create(array $data) {
        $instance = $this->model->create($data);
        
        return $instance;
    }

    public function update($id, array $data) {
        $instance = $this->findById($id);
        return $instance->update($data);
    }

    public function delete($id) {
        $instance = $this->findById($id);
        $instance->delete();
       
    }

    public function findById($id) {
        return $this->model->findOrFail($id);
    }
}
