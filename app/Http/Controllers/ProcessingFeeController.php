<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessingFeeRequest;
use Illuminate\Http\Request;
use App\Services\StudentService;
use App\Services\ProcessingFeeService;
use App\Services\StudentAccountService;

class ProcessingFeeController extends Controller
{
    private $processingFeeService;
    private $studentService;
    private $studentAccountService;

    function __construct(ProcessingFeeService $processingFeeService, StudentService $studentService, StudentAccountService $studentAccountService)
    {
        $this->processingFeeService = $processingFeeService;
        $this->studentService = $studentService;
        $this->studentAccountService = $studentAccountService;
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
    public function store(ProcessingFeeRequest $request)
    {
        $ProcessingFee = $this->processingFeeService->create($request->validated());

        $this->studentAccountService->create([
            'date' => now(),
            'type' => 'ProcessingFee',
            'processing_id' => $ProcessingFee->id,
            'student_id' => $request->student_id,
            'Debit' => 0.00,
            'credit' => $request->amount,
            'description' => $request->description,
        ]);

        return redirect()->route('ProcessingFee.index');
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
    public function update(ProcessingFeeRequest $request, string $id)
    {
        $this->processingFeeService->update($id ,$request->validated());
        $this->studentAccountService->update($id, [
            'date' => now(),
            'type' => 'ProcessingFee',
            'processing_id' => $id,
            'student_id' => $request->student_id,
            'Debit' => 0.00,
            'credit' => $request->amount,
            'description' => $request->description,
        ]);

        return redirect()->route('ProcessingFee.index');
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
