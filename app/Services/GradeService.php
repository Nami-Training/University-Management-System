<?php

namespace App\Services;

use App\Models\Grade;
use App\Models\Classroom;

class GradeService extends MainService
{
    public function __construct()
    {
        parent::__construct(new Grade);
    }

    public function deleteGarde($id)
    {
        $MyClass_id = Classroom::where('Grade_id',$id)->pluck('Grade_id');

      if($MyClass_id->count() == 0){

          Grade::findOrFail($id)->delete();
          toastr()->error(trans('messages.Delete'));
          return redirect()->route('Grades.index');

      }else{
          toastr()->error(trans('Grades_trans.delete_Grade_Error'));
          return redirect()->route('Grades.index');
      }
    }
}
