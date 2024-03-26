<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceiptStudentRequest;
use App\Models\ReceiptStudent;
use App\Models\Student;
use App\Services\FundAccountService;
use App\Services\ReceiptStudentService;
use App\Services\StudentAccountService;
use App\Services\StudentService;
use Illuminate\Http\Request;

class ReceiptStudentController extends Controller
{

    private $receiptStudentService;
    private $studentService;
    private $studentAccountService;
    private $fundAccountService;


    function __construct(ReceiptStudentService $receiptStudentService, StudentService $studentService, StudentAccountService $studentAccountService, FundAccountService $fundAccountService)
    {
        $this->receiptStudentService = $receiptStudentService;
        $this->studentService = $studentService;
        $this->studentAccountService = $studentAccountService;
        $this->fundAccountService = $fundAccountService;
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
    public function store(ReceiptStudentRequest $request)
    {
        $receipt_students = $this->receiptStudentService->create($request->validated());
        $this->fundAccountService->create([
            'date' => now(),
            'receipt_id' => $receipt_students->id,
            'Debit' => $request->Debit,
            'credit' => '0.00',
            'description' => $request->description
        ]);

        $this->studentAccountService->create([
            'date' => now(),
            'type' => 'receipt',
            'receipt_id' => $receipt_students->id,
            'student_id' => $request->student_id,
            'Debit' => 0.00,
            'credit' => $request->Debit,
            'description' => $request->description,
        ]);

        return redirect()->route('ReceiptStudent.index');
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
    public function update(ReceiptStudentRequest $request, string $id)
    {
        $this->receiptStudentService->update($id, $request->validated());

        $this->fundAccountService->update($id, [
            'date' => now(),
            'receipt_id' => $id,
            'Debit' => $request->Debit,
            'credit' => '0.00',
            'description' => $request->description
        ]);

        $this->studentAccountService->update($id, [
            'date' => now(),
            'type' => 'receipt',
            'receipt_id' => $id,
            'student_id' => $request->student_id,
            'Debit' => 0.00,
            'credit' => $request->Debit,
            'description' => $request->description,
        ]);

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
