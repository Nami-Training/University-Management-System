<?php

namespace App\Services;

use App\Models\Grade;
use App\Models\FeeInvoice;

class FeeInvoicesService extends MainService
{
    public function __construct()
    {
        parent::__construct(new FeeInvoice);
    }

}
