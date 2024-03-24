<?php

namespace App\Services;

use App\Models\ProcessingFee;

class ProcessingFeeService extends MainService
{
    public function __construct()
    {
        parent::__construct(new ProcessingFee);
    }
}
