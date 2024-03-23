<?php

namespace App\Services;

use App\Models\Question;

class QuestionService extends MainService
{
    public function __construct()
    {
        parent::__construct(new Question);
    }
}

