<?php

namespace App\Http\Controllers;

use App\Services\AttendanceService;
use App\Services\GradeService;
use App\Services\StudentService;
use App\Services\TeacherService;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GradeService $gradeService, TeacherService $teacherService)
    {
        $Grades = $gradeService->getWith('Sections');
        $list_Grades = $gradeService->all();
        $teachers = $teacherService->all();
        return view('pages.Attendance.Sections',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, AttendanceService $attendanceService)
    {
        try {
            foreach ($request->attendences as $studentid => $attendence) {

                if( $attendence == 'presence' ) {
                    $attendence_status = true;
                } else if( $attendence == 'absent' ){
                    $attendence_status = false;
                }

                $attendanceService->create([
                    'student_id'=> $studentid,
                    'grade_id'=> $request->grade_id,
                    'classroom_id'=> $request->classroom_id,
                    'section_id'=> $request->section_id,
                    'teacher_id'=> 1,
                    'attendence_date'=> date('Y-m-d'),
                    'attendence_status'=> $attendence_status
                ]);

            }

            toastr()->success(trans('messages.success'));
            return redirect()->back();
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, StudentService $studentService)
    {
        // $students = Student::with('attendance')->where('section_id',$id)->get();
        $students = $studentService->getWithWhere('attendance','section_id',$id);
        return view('pages.Attendance.index',compact('students'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
