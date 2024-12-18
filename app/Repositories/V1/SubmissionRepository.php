<?php
namespace App\Repositories\V1;


use App\Models\Submission;
use App\Models\SubmissionLog;
use App\Interfaces\SubmissionRepositoryInterface;
use Illuminate\Support\Facades\Log;

class SubmissionRepository implements SubmissionRepositoryInterface
{
    protected $model;

    public function __construct(Submission $submission)
    {
        $this->model = $submission->with('student');
    }

    public function all() {
        return $this->model->get();
    }

    public function create(array $data) {
        $data = array_merge($data, ['submitted_at' => now()]);
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

    public function bulkInsert(array $data) {

        $instance = $this->model->insert($data);
        
        return $instance;
    }

    //not the best place
    public function logs() {
        return SubmissionLog::all();
    }


}
