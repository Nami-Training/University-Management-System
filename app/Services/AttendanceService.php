<?php

namespace App\Services;

use App\Models\Attendance;

class AttendanceService extends MainService
{
    public function __construct()
    {
        parent::__construct(new Attendance);
    }
}
