<?php

namespace App\Services;

use App\Models\FundAccount;

class FundAccountService extends MainService
{
    public function __construct()
    {
        parent::__construct(new FundAccount);
    }
}
