<?php

namespace App\Http\Controllers;

use App\Services\FeesService;
use App\Services\GradeService;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    private $feesService;
    private $gradeService;

    function __construct(FeesService $feesService, GradeService $gradeService)
    {
        $this->feesService = $feesService;
        $this->gradeService = $gradeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fees = $this->feesService->all();
        $Grades = $this->gradeService->all();
        return view('pages.Fees.index',compact('fees','Grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Grades =  $this->gradeService->all();
        return view('pages.Fees.add',compact('Grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $fees = new Fee();
        // $fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
        // $fees->amount  =$request->amount;
        // $fees->Grade_id  =$request->Grade_id;
        // $fees->Classroom_id  =$request->Classroom_id;
        // $fees->description  =$request->description;
        // $fees->year  =$request->year;
        // $fees->Fee_type  =$request->Fee_type;
        // $fees->save();
        // return redirect()->route('Fees.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fee = $this->feesService->findById($id);
        $Grades = $this->gradeService->all();
        return view('pages.Fees.edit',compact('fee','Grades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $fees = Fee::findorfail($request->id);
        // $fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
        // $fees->amount  =$request->amount;
        // $fees->Grade_id  =$request->Grade_id;
        // $fees->Classroom_id  =$request->Classroom_id;
        // $fees->description  =$request->description;
        // $fees->year  =$request->year;
        // $fees->Fee_type  =$request->Fee_type;
        // $fees->save();
        // toastr()->success(trans('messages.Update'));
        // return redirect()->route('Fees.index');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function delete($id)
    {
        $this->feesService->delete($id);
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        $this->feesService->forceDelete($id);
        return redirect()->back();
    }
}
