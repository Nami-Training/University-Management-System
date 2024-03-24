<?php

namespace App\Http\Controllers;

use App\Models\ReceiptStudent;
use App\Services\ReceiptStudentService;
use App\Services\StudentService;
use Illuminate\Http\Request;

class ReceiptStudentController extends Controller
{

    private $receiptStudentService;
    private $studentService;


    function __construct(ReceiptStudentService $receiptStudentService, StudentService $studentService)
    {
        $this->receiptStudentService = $receiptStudentService;
        $this->studentService = $studentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receipt_students = $this->receiptStudentService->all();
        return view('pages.Receipt.index',compact('receipt_students'));
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
        $this->receiptStudentService->create($request->except('_token'));
        return redirect()->route('ReceiptStudent.index');
        // DB::beginTransaction();

        // try {

        //     // حفظ البيانات في جدول سندات القبض
        //     $receipt_students = new ReceiptStudent();
        //     $receipt_students->date = date('Y-m-d');
        //     $receipt_students->student_id = $request->student_id;
        //     $receipt_students->Debit = $request->Debit;
        //     $receipt_students->description = $request->description;
        //     $receipt_students->save();

        //     // حفظ البيانات في جدول الصندوق
        //     $fund_accounts = new FundAccount();
        //     $fund_accounts->date = date('Y-m-d');
        //     $fund_accounts->receipt_id = $receipt_students->id;
        //     $fund_accounts->Debit = $request->Debit;
        //     $fund_accounts->credit = 0.00;
        //     $fund_accounts->description = $request->description;
        //     $fund_accounts->save();

        //     // حفظ البيانات في جدول حساب الطالب
        //     $fund_accounts = new StudentAccount();
        //     $fund_accounts->date = date('Y-m-d');
        //     $fund_accounts->type = 'receipt';
        //     $fund_accounts->receipt_id = $receipt_students->id;
        //     $fund_accounts->student_id = $request->student_id;
        //     $fund_accounts->Debit = 0.00;
        //     $fund_accounts->credit = $request->Debit;
        //     $fund_accounts->description = $request->description;
        //     $fund_accounts->save();

        //     DB::commit();
        //     toastr()->success(trans('messages.success'));
        //     return redirect()->route('receipt_students.index');

        // }

        // catch (\Exception $e) {
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
        return view('pages.Receipt.add',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $receipt_student = $this->receiptStudentService->findById($id);
        return view('pages.Receipt.edit',compact('receipt_student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->receiptStudentService->update($id, $request->except('_token'));
        return redirect()->route('ReceiptStudent.index');
        // DB::beginTransaction();

        // try {
        //     // تعديل البيانات في جدول سندات القبض
        //     $receipt_students = ReceiptStudent::findorfail($request->id);
        //     $receipt_students->date = date('Y-m-d');
        //     $receipt_students->student_id = $request->student_id;
        //     $receipt_students->Debit = $request->Debit;
        //     $receipt_students->description = $request->description;
        //     $receipt_students->save();

        //     // تعديل البيانات في جدول الصندوق
        //     $fund_accounts = FundAccount::where('receipt_id',$request->id)->first();
        //     $fund_accounts->date = date('Y-m-d');
        //     $fund_accounts->receipt_id = $receipt_students->id;
        //     $fund_accounts->Debit = $request->Debit;
        //     $fund_accounts->credit = 0.00;
        //     $fund_accounts->description = $request->description;
        //     $fund_accounts->save();

        //     // تعديل البيانات في جدول الصندوق

        //     $fund_accounts = StudentAccount::where('receipt_id',$request->id)->first();
        //     $fund_accounts->date = date('Y-m-d');
        //     $fund_accounts->type = 'receipt';
        //     $fund_accounts->student_id = $request->student_id;
        //     $fund_accounts->receipt_id = $receipt_students->id;
        //     $fund_accounts->Debit = 0.00;
        //     $fund_accounts->credit = $request->Debit;
        //     $fund_accounts->description = $request->description;
        //     $fund_accounts->save();


        //     DB::commit();
        //     toastr()->success(trans('messages.Update'));
        //     return redirect()->route('receipt_students.index');
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // }
    }

    public function delete(string $id)
    {
        $this->receiptStudentService->delete($id);
        return redirect()->route('ReceiptStudent.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->receiptStudentService->forceDelete($id);
        return redirect()->route('ReceiptStudent.index');
    }
}
