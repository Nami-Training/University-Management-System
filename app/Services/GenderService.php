<?php

namespace App\Services;

use App\Models\Gender;

class GenderService extends MainService
{
    public function __construct()
    {
        parent::__construct(new Gender);
    }
}
