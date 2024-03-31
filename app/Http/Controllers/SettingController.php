<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $settingService;

    function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = $this->settingService->get();
        return view('pages.setting.index', get_defined_vars());
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, string $id)
    {
        $this->settingService->update($id, $request->validated());
        $setting = $this->settingService->get();
        if($request->file('logo')){
            if ($setting->image){
                $this->settingService->Delete_attachment($setting->image->filename, $setting->image->id);
            }
            $this->settingService->Upload_attachment($request->logo);
        }
        return redirect()->route('settings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
