<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentStudentRequest;
use App\Services\FundAccountService;
use App\Services\PaymentStudentService;
use App\Services\StudentAccountService;
use App\Services\StudentService;
use Illuminate\Http\Request;

class PaymentStudentController extends Controller
{
    private $paymentStudentService;
    private $studentService;
    private $studentAccountService;
    private $fundAccountService;

    function __construct(PaymentStudentService $paymentStudentService, StudentService $studentService, StudentAccountService $studentAccountService, FundAccountService $fundAccountService )
    {
        $this->paymentStudentService = $paymentStudentService;
        $this->studentService = $studentService;
        $this->studentAccountService = $studentAccountService;
        $this->fundAccountService = $fundAccountService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_students = $this->paymentStudentService->all();
        return view('pages.Payment.index',get_defined_vars());
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
    public function store(PaymentStudentRequest $request)
    {
        $payment_students = $this->paymentStudentService->create($request->validated());

        $this->fundAccountService->create([
            'payment_id' => $payment_students->id,
            'Debit' => '0.00',
            'credit' => $request->amount,
            'description' => $request->description
        ]);

        $this->studentAccountService->create([
            'date' => now(),
            'type' => 'payment',
            'student_id' => $request->student_id,
            'payment_id' => $payment_students->id,
            'Debit' => $request->amount,
            'credit' => 0.00,
            'description' => $request->description
        ]);

        return redirect()->route('PaymentStudent.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = $this->studentService->findById($id);
        return view('pages.Payment.add',get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payment_student = $this->paymentStudentService->findById($id);
        return view('pages.Payment.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentStudentRequest $request, string $id)
    {
        $this->paymentStudentService->update($id, $request->validated());

        $this->fundAccountService->update($id, [
            'payment_id' => $id,
            'Debit' => '0.00',
            'credit' => $request->amount,
            'description' => $request->description
        ]);

        $this->studentAccountService->update($id, [
            'date' => now(),
            'type' => 'payment',
            'student_id' => $request->student_id,
            'payment_id' => $id,
            'Debit' => $request->amount,
            'credit' => 0.00,
            'description' => $request->description
        ]);

        return redirect()->route('PaymentStudent.index');
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
