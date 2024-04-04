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
        return view('pages.Receipt.index',get_defined_vars());
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
        try {
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
            toastr()->success(trans('messages.success'));
            return redirect()->route('ReceiptStudent.index');
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = $this->studentService->findById($id);
        return view('pages.Receipt.add',get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $receipt_student = $this->receiptStudentService->findById($id);
        return view('pages.Receipt.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReceiptStudentRequest $request, string $id)
    {
        try {
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
            toastr()->success(trans('messages.Update'));
            return redirect()->route('ReceiptStudent.index');
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete(string $id)
    {
        try {
            $this->receiptStudentService->delete($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('ReceiptStudent.index');
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
            $this->receiptStudentService->forceDelete($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('ReceiptStudent.index');
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
