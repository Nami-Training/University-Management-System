<?php

namespace App\Services;

use App\Models\StudentAccount;

class StudentAccountService extends MainService
{
    public function __construct()
    {
        parent::__construct(new StudentAccount);
    }
}
