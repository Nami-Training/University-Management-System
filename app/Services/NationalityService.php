<?php

namespace App\Services;

use App\Models\Nationality;

class NationalityService extends MainService
{
    public function __construct()
    {
        parent::__construct(new Nationality);
    }
}
