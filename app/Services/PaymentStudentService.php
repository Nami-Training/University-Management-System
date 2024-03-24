<?php

namespace App\Services;

use App\Models\PaymentStudent;

class PaymentStudentService extends MainService
{
    public function __construct()
    {
        parent::__construct(new PaymentStudent);
    }
}
