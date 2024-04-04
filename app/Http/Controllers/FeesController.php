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
        return view('pages.Fees.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Grades =  $this->gradeService->all();
        return view('pages.Fees.add',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeeRequest $request)
    {
        try {
            $this->feesService->create($request->validated());
            toastr()->success(trans('messages.success'));
            return redirect()->route('Fees.index');
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
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
        return view('pages.Fees.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeeRequest $request, string $id)
    {
        try {
            $this->feesService->update($id, $request->validated());
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Fees.index');
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function delete($id)
    {
        try {
            $this->feesService->delete($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->feesService->forceDelete($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
