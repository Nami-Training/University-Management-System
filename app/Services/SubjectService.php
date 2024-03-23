<?php

namespace App\Services;

use App\Models\Subject;

class SubjectService extends MainService
{
    public function __construct()
    {
        parent::__construct(new Subject);
    }
}
