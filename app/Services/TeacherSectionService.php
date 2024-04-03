<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
class TeacherSectionService
{
    public function getAll()
    {
        return DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
    }
}
