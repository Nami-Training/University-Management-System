<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FeesService;
use App\Services\GradeService;
use App\Http\Requests\FeeRequest;

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
    public function store(FeeRequest $request)
    {
        $this->feesService->create($request->validated());
        return redirect()->route('Fees.index');
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
    public function update(FeeRequest $request, string $id)
    {
        $this->feesService->update($id, $request->validated());
        return redirect()->route('Fees.index');
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
