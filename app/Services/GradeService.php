<?php

namespace App\Services;

use App\Models\Grade;

class GradeService extends MainService
{
    public function __construct()
    {
        parent::__construct(new Grade);
    }

}
