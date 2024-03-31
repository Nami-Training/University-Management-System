<?php

namespace App\Services;

use App\Models\onlineClasse;

class OnlineClassService extends MainService
{
    public function __construct()
    {
        parent::__construct(new onlineClasse);
    }
}
