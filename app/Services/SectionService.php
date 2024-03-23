<?php

namespace App\Services;

use App\Models\Section;

class SectionService extends MainService
{
    public function __construct()
    {
        parent::__construct(new Section);
    }
}
