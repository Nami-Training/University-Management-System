<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeeInvoicesRequest;
use App\Models\FeeInvoice;
use App\Services\FeeInvoicesService;
use App\Services\FeesService;
use App\Services\GradeService;
use App\Services\StudentAccountService;
use App\Services\StudentService;
use Illuminate\Http\Request;

class Fees_InvoicesController extends Controller
{

    private $feeInvoicesService;
    private $gradeService;
    private $studentService;
    private $feesService;
    private $studentAccountService;

    function __construct(FeeInvoicesService $feeInvoicesService, GradeService $gradeService, StudentService $studentService, FeesService $feesService, StudentAccountService $studentAccountService)
    {
        $this->feeInvoicesService = $feeInvoicesService;
        $this->gradeService = $gradeService;
        $this->studentService = $studentService;
        $this->feesService = $feesService;
        $this->studentAccountService = $studentAccountService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Fee_invoices = $this->feeInvoicesService->all();
        $Grades = $this->gradeService->all();
        return view('pages.Fees_Invoices.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $student = $this->studentService->all();
        return view('pages.Fees_Invoices.add',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeeInvoicesRequest $request)
    {
        try {
            $fee = $this->feeInvoicesService->create($request->validated());

            $this->studentAccountService->create([
                'date' => now(),
                'type' => 'invoice',
                'fee_invoice_id' => $fee->id,
                'student_id' => $request->student_id,
                'Debit' => $request->amount,
                'credit' => 0.00,
                'description' => $request->description
            ]);

            toastr()->success(trans('messages.success'));
            return redirect()->route('Fee_Invoices.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student =$this->studentService->findById($id);
        $fees = $this->feesService->findByColumn('classroom_id',$student->classroom_id);
        return view('pages.Fees_Invoices.add',get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fee_invoices = $this->feeInvoicesService->findById($id);
        $fees = $this->feesService->findByColumn('Classroom_id',$fee_invoices->classroom_id);
        return view('pages.Fees_Invoices.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $this->feeInvoicesService->update($id, $request->only('student_id', 'amount', 'fee_id', 'description'));

            $this->studentAccountService->update($id, [
                'date' => now(),
                'type' => 'invoice',
                'fee_invoice_id' => $id,
                'student_id' => $request->student_id,
                'Debit' => $request->amount,
                'credit' => 0.00,
                'description' => $request->description
            ]);

            toastr()->success(trans('messages.Update'));
            return redirect()->route('Fee_Invoices.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            $this->feeInvoicesService->delete($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->feeInvoicesService->forceDelete($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
