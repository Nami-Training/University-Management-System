<?php

namespace App\Services;

use App\Models\Promotion;

class PromotionService extends MainService
{
    public function __construct()
    {
        parent::__construct(new Promotion);
    }
}
