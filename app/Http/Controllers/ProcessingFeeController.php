<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StudentService;
use App\Services\ProcessingFeeService;

class ProcessingFeeController extends Controller
{
    private $processingFeeService;
    private $studentService;

    function __construct(ProcessingFeeService $processingFeeService, StudentService $studentService)
    {
        $this->processingFeeService = $processingFeeService;
        $this->studentService = $studentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ProcessingFees = $this->processingFeeService->all();
        return view('pages.ProcessingFee.index',compact('ProcessingFees'));
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
    public function store(Request $request)
    {
        // DB::beginTransaction();

        // try {
        //     // حفظ البيانات في جدول معالجة الرسوم
        //     $ProcessingFee = new ProcessingFee();
        //     $ProcessingFee->date = date('Y-m-d');
        //     $ProcessingFee->student_id = $request->student_id;
        //     $ProcessingFee->amount = $request->Debit;
        //     $ProcessingFee->description = $request->description;
        //     $ProcessingFee->save();


        //     // حفظ البيانات في جدول حساب الطلاب
        //     $students_accounts = new StudentAccount();
        //     $students_accounts->date = date('Y-m-d');
        //     $students_accounts->type = 'ProcessingFee';
        //     $students_accounts->student_id = $request->student_id;
        //     $students_accounts->processing_id = $ProcessingFee->id;
        //     $students_accounts->Debit = 0.00;
        //     $students_accounts->credit = $request->Debit;
        //     $students_accounts->description = $request->description;
        //     $students_accounts->save();


        //     DB::commit();
        //     toastr()->success(trans('messages.success'));
        //     return redirect()->route('ProcessingFee.index');
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = $this->studentService->findById($id);
        return view('pages.ProcessingFee.add',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ProcessingFee = $this->processingFeeService->findById($id);
        return view('pages.ProcessingFee.edit',compact('ProcessingFee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // DB::beginTransaction();

        // try {
        //     // تعديل البيانات في جدول معالجة الرسوم
        //     $ProcessingFee = ProcessingFee::findorfail($request->id);;
        //     $ProcessingFee->date = date('Y-m-d');
        //     $ProcessingFee->student_id = $request->student_id;
        //     $ProcessingFee->amount = $request->Debit;
        //     $ProcessingFee->description = $request->description;
        //     $ProcessingFee->save();

        //     // تعديل البيانات في جدول حساب الطلاب
        //     $students_accounts = StudentAccount::where('processing_id',$request->id)->first();;
        //     $students_accounts->date = date('Y-m-d');
        //     $students_accounts->type = 'ProcessingFee';
        //     $students_accounts->student_id = $request->student_id;
        //     $students_accounts->processing_id = $ProcessingFee->id;
        //     $students_accounts->Debit = 0.00;
        //     $students_accounts->credit = $request->Debit;
        //     $students_accounts->description = $request->description;
        //     $students_accounts->save();


        //     DB::commit();
        //     toastr()->success(trans('messages.Update'));
        //     return redirect()->route('ProcessingFee.index');
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // }
    }

    public function delete($id)
    {
        $this->processingFeeService->delete($id);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->processingFeeService->forceDelete($id);
        return redirect()->back();
    }
}
