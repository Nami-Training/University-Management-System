<?php

namespace App\Services;

use App\Models\BloodType;

class BloodService extends MainService
{
    public function __construct()
    {
        parent::__construct(new BloodType);
    }
}
