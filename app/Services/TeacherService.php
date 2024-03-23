<?php

namespace App\Services;

use App\Models\Teacher;

class TeacherService extends MainService
{
    public function __construct()
    {
        parent::__construct(new Teacher);
    }
}
