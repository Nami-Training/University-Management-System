<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Section;
use App\Services\SectionService;
use App\Services\StudentService;
use App\Http\Controllers\Controller;
use App\Services\AttendanceService;
use App\Services\TeacherSectionService;
use App\Services\TeacherService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(StudentService $studentService, TeacherSectionService $teacherSectionService)
    {
        $ids = $teacherSectionService->getAll();
        $students = $studentService->whereIn('section_id', $ids);
        return view('pages.Teachers.dashboard.students.index', compact('students'));
    }

    public function sections(TeacherSectionService $teacherSectionService, SectionService $sectionService)
    {
        $ids = $teacherSectionService->getAll();
        $sections = $sectionService->whereIn('id', $ids);
        return view('pages.Teachers.dashboard.sections.index', get_defined_vars());
    }

    public function attendance(Request $request, AttendanceService $attendanceService)
    {
        $attenddate = date('Y-m-d');
        foreach ($request->attendences as $studentid => $attendence) {

            if ($attendence == 'presence') {
                $attendence_status = true;
            } else if ($attendence == 'absent') {
                $attendence_status = false;
            }

            $attendanceService->updateorCreate(['student_id'=> $studentid],[
                'student_id' => $studentid,
                'grade_id' => $request->grade_id,
                'classroom_id' => $request->classroom_id,
                'section_id' => $request->section_id,
                'teacher_id' => 1,
                'attendence_date' => $attenddate,
                'attendence_status' => $attendence_status
            ]);
        }
        // toastr()->success(trans('messages.success'));
        return redirect()->back();
    }

    public function editAttendance(Request $request, AttendanceService $attendanceService){

        try{
            $date = date('Y-m-d');
            $student_id = $attendanceService->where('attendence_date',$date)->where('student_id',$request->id)->first();
            if( $request->attendences == 'presence' ) {
                $attendence_status = true;
            } else if( $request->attendences == 'absent' ){
                $attendence_status = false;
            }
            $student_id->update([
                'attendence_status'=> $attendence_status
            ]);
            // toastr()->success(trans('messages.success'));
            return redirect()->back();
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function attendanceReport(TeacherSectionService $teacherSectionService, StudentService $studentService){

        $ids = $teacherSectionService->getAll();
        $students = $studentService->whereIn('section_id', $ids);
        return view('pages.Teachers.dashboard.students.attendance_report', compact('students'));

    }

    public function attendanceSearch(Request $request, TeacherSectionService $teacherSectionService, StudentService $studentService, AttendanceService $attendanceService){

        $request->validate([
            'from'  =>'required|date|date_format:Y-m-d',
            'to'=> 'required|date|date_format:Y-m-d|after_or_equal:from'
        ],[
            'to.after_or_equal' => trans('onlineClass.dateMustBeBigger'),
            'from.date_format' => trans('onlineClass.dateFormate'),
            'to.date_format' => trans('onlineClass.dateFormate'),
        ]);

        $ids = $teacherSectionService->getAll();
        $students = $studentService->whereIn('section_id', $ids);

        if($request->student_id == 0){

            $Students = $attendanceService->whereBetween('attendence_date', [$request->from, $request->to]);
            return view('pages.Teachers.dashboard.students.attendance_report',get_defined_vars());

        }else{
            $Students = $attendanceService->whereBetween('attendence_date', [$request->from, $request->to])
            ->where('student_id',$request->student_id);
            return view('pages.Teachers.dashboard.students.attendance_report',get_defined_vars());
        }
    }

}
