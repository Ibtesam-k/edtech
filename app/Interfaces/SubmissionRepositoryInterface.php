<?php

namespace App\Interfaces;

interface SubmissionRepositoryInterface extends BaseRepositoryInterface
{
    //
    public function bulkInsert(array $data);
    public function logs();

}
