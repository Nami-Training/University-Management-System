<?php

namespace App\Services;

use App\Models\Specialization;

class SpecializationService extends MainService
{
    public function __construct()
    {
        parent::__construct(new Specialization);
    }
}
