<?php

namespace App\Services;

use App\Models\ReceiptStudent;

class ReceiptStudentService extends MainService
{
    public function __construct()
    {
        parent::__construct(new ReceiptStudent);
    }
}
