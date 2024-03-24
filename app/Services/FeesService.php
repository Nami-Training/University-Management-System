<?php

namespace App\Services;

use App\Models\Fee;

class FeesService extends MainService
{
    public function __construct()
    {
        parent::__construct(new Fee);
    }
}
