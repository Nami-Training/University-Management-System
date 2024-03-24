<?php

namespace App\Http\Controllers;

use App\Services\PaymentStudentService;
use App\Services\StudentService;
use Illuminate\Http\Request;

class PaymentStudentController extends Controller
{
    private $paymentStudentService;
    private $studentService;

    function __construct(PaymentStudentService $paymentStudentService, StudentService $studentService)
    {
        $this->paymentStudentService = $paymentStudentService;
        $this->studentService = $studentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_students = $this->paymentStudentService->all();
        return view('pages.Payment.index',compact('payment_students'));
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

        //     // حفظ البيانات في جدول سندات الصرف
        //     $payment_students = new PaymentStudent();
        //     $payment_students->date = date('Y-m-d');
        //     $payment_students->student_id = $request->student_id;
        //     $payment_students->amount = $request->Debit;
        //     $payment_students->description = $request->description;
        //     $payment_students->save();


        //     // حفظ البيانات في جدول الصندوق
        //     $fund_accounts = new FundAccount();
        //     $fund_accounts->date = date('Y-m-d');
        //     $fund_accounts->payment_id = $payment_students->id;
        //     $fund_accounts->Debit = 0.00;
        //     $fund_accounts->credit = $request->Debit;
        //     $fund_accounts->description = $request->description;
        //     $fund_accounts->save();


        //     // حفظ البيانات في جدول حساب الطلاب
        //     $students_accounts = new StudentAccount();
        //     $students_accounts->date = date('Y-m-d');
        //     $students_accounts->type = 'payment';
        //     $students_accounts->student_id = $request->student_id;
        //     $students_accounts->payment_id = $payment_students->id;
        //     $students_accounts->Debit = $request->Debit;
        //     $students_accounts->credit = 0.00;
        //     $students_accounts->description = $request->description;
        //     $students_accounts->save();

        //     DB::commit();
        //     toastr()->success(trans('messages.success'));
        //     return redirect()->route('Payment_students.index');
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
        return view('pages.Payment.add',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payment_student = $this->paymentStudentService->findById($id);
        return view('pages.Payment.edit',compact('payment_student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // DB::beginTransaction();

        // try {

        //     // تعديل البيانات في جدول سندات الصرف
        //     $payment_students = PaymentStudent::findorfail($request->id);
        //     $payment_students->date = date('Y-m-d');
        //     $payment_students->student_id = $request->student_id;
        //     $payment_students->amount = $request->Debit;
        //     $payment_students->description = $request->description;
        //     $payment_students->save();


        //     // حفظ البيانات في جدول الصندوق
        //     $fund_accounts = FundAccount::where('payment_id',$request->id)->first();
        //     $fund_accounts->date = date('Y-m-d');
        //     $fund_accounts->payment_id = $payment_students->id;
        //     $fund_accounts->Debit = 0.00;
        //     $fund_accounts->credit = $request->Debit;
        //     $fund_accounts->description = $request->description;
        //     $fund_accounts->save();


        //     // حفظ البيانات في جدول حساب الطلاب
        //     $students_accounts = StudentAccount::where('payment_id',$request->id)->first();
        //     $students_accounts->date = date('Y-m-d');
        //     $students_accounts->type = 'payment';
        //     $students_accounts->student_id = $request->student_id;
        //     $students_accounts->payment_id = $payment_students->id;
        //     $students_accounts->Debit = $request->Debit;
        //     $students_accounts->credit = 0.00;
        //     $students_accounts->description = $request->description;
        //     $students_accounts->save();
        //     DB::commit();
        //     toastr()->success(trans('messages.Update'));
        //     return redirect()->route('Payment_students.index');
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // }
    }

    public function delete($id)
    {
        $this->paymentStudentService->delete($id);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->paymentStudentService->forceDelete($id);
        return redirect()->back();
    }
}
