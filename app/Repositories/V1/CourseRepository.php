<?php
namespace App\Repositories\V1;

use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\CourseRepositoryInterface;


class CourseRepository implements CourseRepositoryInterface
{
    protected $model;

    public function __construct(Course $course)
    {
        $this->model = $course->with('teacher');
    }

    public function all() {
        return $this->model->get();
    }

    public function create(array $data) {
        $instance = $this->model->create($data);
        
        return $instance->load('teacher');
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
