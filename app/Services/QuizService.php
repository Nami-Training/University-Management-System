<?php

namespace App\Services;

use App\Models\Quiz;

class QuizService extends MainService
{
    public function __construct()
    {
        parent::__construct(new Quiz);
    }
}
