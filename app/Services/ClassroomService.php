<?php

namespace App\Services;

use App\Models\Classroom;

class ClassroomService extends MainService
{
    public function __construct()
    {
        parent::__construct(new Classroom);
    }

    public function getData($column , $value)
    {
        $data = [];
        $classes = $this->findByColumn($column, $value);

        foreach($classes as $class){
            $data[$class->id] = $class->Name;
        }
        return $data;
    }

    public function deletAll($data)
    {
        $delete_all_id = explode(",", $data);

        foreach($delete_all_id as $id){
            $class = $this->delete($id);
        }
        // toastr()->error(trans('messages.Delete'));
    }

}
