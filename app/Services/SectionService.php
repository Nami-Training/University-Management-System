<?php

namespace App\Services;

use App\Models\Section;

class SectionService extends MainService
{
    public function __construct()
    {
        parent::__construct(new Section);
    }

    public function getData($column , $value)
    {
        $data = [];
        $sections = $this->findByColumn($column, $value);

        foreach($sections as $section){
            $data[$section->id] = $section->Name;
        }
        return $data;
    }
}
