<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\ClassAssign;
use App\Http\Requests\StoreClassAssignRequest;
use App\Http\Requests\UpdateClassAssignRequest;
use App\Models\InstitutionClass;
use App\Models\ClassSection;
use App\Models\User;
use App\Models\Subject;
use App\Models\DayOfWeek;


class ClassAssignController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:class-list|class-create|class-edit|class-delete', ['only' => ['index','show']]);
         $this->middleware('permission:class-create', ['only' => ['create','store']]);
         $this->middleware('permission:class-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:class-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = ClassAssign::latest()
        ->with(['institutionClass'])
        ->with(['classSection'])
        ->with(['userList'])
        ->with(['subjects'])
        ->paginate(5);

        // dd($classes);

        return view('class-assign.index',compact('classes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $institutionClass = InstitutionClass::dataList();

        // $classSection = ClassSection::dataList();

        // $days = DayOfWeek::dataList();

        $subjects = Subject::dataList();

        // dd($subjects);

        // $isTeacher = User::whereHas('roles', function($q) {
        //     $q->where(function ($query) {
        //         $query->where('name', 'Teacher')
        //         ->orWhere('name', 'Headmaster');
        //     });
        // })->pluck('name', 'id')->toArray();

        // dd($isTeacher);
        
        // return view('class-assign.create',compact('institutionClass','classSection','isTeacher','subjects','days'));
        return view('class-assign.create',compact('institutionClass','subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        
        
        $this->validate($request, [

            // 'teacher_id' => 'required',

            'class_id' => 'required',

            // 'section_id' => 'required',

            // 'days' => 'required',

            'subject_id' => 'required',

            // 'time_start' => 'required',

            // 'time_end' => 'required',

            // 'pm_or_am_first' => 'required',

            // 'pm_or_am_second' => 'required',
			
        ]);

        // dd($input = $request->all());
        $input = $request->all();

        $classId = $input['class_id'];

        // dd($classId);

        $getClass = InstitutionClass::where('id',$classId)->pluck('code')->first();
        
        // dd($getClass);
        
        // $input['class_schedule'] = $input['time_start'] . "   " . $input['pm_or_am_first']. " - " . $input['time_end'] . "   " . $input['pm_or_am_second'];
       
        $input['class'] = $getClass;

        $user = ClassAssign::create($input);

        toastr()->success('Class assign successfully');

        return redirect()->route('class-assign.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassAssign $classAssign)
    {
        return view('class-assign.show',compact('classAssign'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassAssign $classAssign)
    {
        $institutionClass = InstitutionClass::dataList();

        // $classSection = ClassSection::dataList();

        // $days = DayOfWeek::dataList();

        $subjects = Subject::dataList();

        // $isTeacher = User::whereHas('roles', function($q) {
        //     $q->where(function ($query) {
        //         $query->where('name', 'Teacher')
        //         ->orWhere('name', 'Headmaster');
        //     });
        // })->pluck('name', 'id')->toArray();

        // return view('class-assign.edit',compact('classAssign'),compact('institutionClass','classSection','isTeacher','subjects','days'));
        return view('class-assign.edit',compact('institutionClass','classAssign','subjects'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassAssign $classAssign)
    {

        $this->validate($request, [

            // 'teacher_id' => 'required',
            
            'class_id' => 'required',
            
            // 'section_id' => 'required',

            // 'days' => 'required',

            'subject_id' => 'required',

            // 'class_schedule' => 'required',

        ]);
    
		$input = $request->all();

        $classId = $input['class_id'];

        // dd($classId);

        $getClass = InstitutionClass::where('id',$classId)->pluck('code')->first();
        
        // dd($getClass);
        
        // $input['class_schedule'] = $input['time_start'] . "   " . $input['pm_or_am_first']. " - " . $input['time_end'] . "   " . $input['pm_or_am_second'];
       
        $input['class'] = $getClass;

		$updateData = ClassAssign::find($classAssign->id);
		$updateData->update($input);
			
        toastr()->success('Assigned class updated successfully');

        return redirect()->route('class-assign.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassAssign $classAssign)
    {
        $classAssign->delete();

        toastr()->success('Assigned class deleted successfully');

        return redirect()->route('class-assign.index');
    }
}
