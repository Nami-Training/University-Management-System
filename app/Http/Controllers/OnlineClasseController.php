<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GradeService;
use MacsiDigital\Zoom\Facades\Zoom;
use App\Http\Trait\MeetingZoomTrait;
use App\Services\OnlineClassService;
use App\Http\Requests\OnlineClassRequest;

class OnlineClasseController extends Controller
{
    use MeetingZoomTrait;

    private $onlineClassService;
    private $gradeService;

    function __construct(OnlineClassService $onlineClassService, GradeService $gradeService)
    {
        $this->onlineClassService = $onlineClassService;
        $this->gradeService = $gradeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $online_classes = $this->onlineClassService->all();
        return view('pages.online_classes.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Grades = $this->gradeService->all();
        return view('pages.online_classes.add', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OnlineClassRequest $request)
    {
        $meeting = $this->createMeeting($request);

        $this->onlineClassService->create([
            'integration' => true,
            'Grade_id' => $request->grade_id,
            'Classroom_id' => $request->classroom_id,
            'section_id' => $request->section_id,
            'user_id' => auth()->user()->id,
            'meeting_id' => $meeting->id,
            'topic' => $request->topic,
            'start_at' => $request->start_time,
            'duration' => $meeting->duration,
            'password' => $meeting->password,
            'start_url' => $meeting->start_url,
            'join_url' => $meeting->join_url,
        ]);
        return redirect()->route('OnlineClass.index');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $info = $this->onlineClassService->findById($request->id);

        if($info->integration == true){
            $meeting = Zoom::meeting()->find($request->meeting_id);
            $meeting->delete();
            // online_classe::where('meeting_id', $request->id)->delete();
            $this->onlineClassService->delete($request->id);
        }
        else{
            // online_classe::where('meeting_id', $request->id)->delete();
            $this->onlineClassService->delete($request->id);
        }

        return redirect()->route('online_classes.index');
    }

    public function indirectCreate()
    {
        $Grades = $this->gradeService->all();
        return view('pages.online_classes.indirect', compact('Grades'));
    }

    public function IndirectStore(Request $request)
    {
        $this->onlineClassService->create([
            'integration' => false,
            'Grade_id' => $request->Grade_id,
            'Classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'user_id' => auth()->user()->id,
            'meeting_id' => $request->meeting_id,
            'topic' => $request->topic,
            'start_at' => $request->start_time,
            'duration' => $request->duration,
            'password' => $request->password,
            'start_url' => $request->start_url,
            'join_url' => $request->join_url,
        ]);
        return redirect()->route('OnlineClass.index');
    }
}
