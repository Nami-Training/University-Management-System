<?php

namespace App\Http\Controllers;

use App\Models\FeeInvoice;
use App\Services\FeeInvoicesService;
use App\Services\FeesService;
use App\Services\GradeService;
use App\Services\StudentService;
use Illuminate\Http\Request;

class Fees_InvoicesController extends Controller
{

    private $feeInvoicesService;
    private $gradeService;
    private $studentService;
    private $feesService;

    function __construct(FeeInvoicesService $feeInvoicesService, GradeService $gradeService, StudentService $studentService, FeesService $feesService)
    {
        $this->feeInvoicesService = $feeInvoicesService;
        $this->gradeService = $gradeService;
        $this->studentService = $studentService;
        $this->feesService = $feesService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Fee_invoices = $this->feeInvoicesService->all();
        $Grades = $this->gradeService->all();
        return view('pages.Fees_Invoices.index',compact('Fee_invoices','Grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $student = $this->studentService->all();
        return view('pages.Fees_Invoices.add',compact('student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $List_Fees = $request->List_Fees;

        // DB::beginTransaction();

        // try {

        //     foreach ($List_Fees as $List_Fee) {
        //         // حفظ البيانات في جدول فواتير الرسوم الدراسية
        //         $Fees = new Fee_invoice();
        //         $Fees->invoice_date = date('Y-m-d');
        //         $Fees->student_id = $List_Fee['student_id'];
        //         $Fees->Grade_id = $request->Grade_id;
        //         $Fees->Classroom_id = $request->Classroom_id;;
        //         $Fees->fee_id = $List_Fee['fee_id'];
        //         $Fees->amount = $List_Fee['amount'];
        //         $Fees->description = $List_Fee['description'];
        //         $Fees->save();

        //         // حفظ البيانات في جدول حسابات الطلاب
        //         $StudentAccount = new StudentAccount();
        //         $StudentAccount->date = date('Y-m-d');
        //         $StudentAccount->type = 'invoice';
        //         $StudentAccount->fee_invoice_id = $Fees->id;
        //         $StudentAccount->student_id = $List_Fee['student_id'];
        //         $StudentAccount->Debit = $List_Fee['amount'];
        //         $StudentAccount->credit = 0.00;
        //         $StudentAccount->description = $List_Fee['description'];
        //         $StudentAccount->save();
        //     }

        //     DB::commit();

        //     toastr()->success(trans('messages.success'));
        //     return redirect()->route('Fees_Invoices.index');
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
        $student =$this->studentService->findById($id);
        $fees = $this->feesService->findByColumn('classroom_id',$student->Classroom_id);
        return view('pages.Fees_Invoices.add',compact('student','fees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fee_invoices = $this->feeInvoicesService->findById($id);
        $fees = $this->feesService->findByColumn('Classroom_id',$fee_invoices->Classroom_id);
        return view('pages.Fees_Invoices.edit',compact('fee_invoices','fees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function delete($id)
    {
        $this->feeInvoicesService->delete($id);
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->feeInvoicesService->forceDelete($id);
        return redirect()->back();
    }
}
