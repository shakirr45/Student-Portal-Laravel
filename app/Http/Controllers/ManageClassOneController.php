<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

// use App\Models\ManageClassOne;
use App\Http\Requests\StoreManageClassOneRequest;
use App\Http\Requests\UpdateManageClassOneRequest;
use App\Models\ClassAssign;
use App\Models\ClassSection;
use App\Models\User;
use App\Models\Subject;
use App\Models\DayOfWeek;
use App\Models\ManageClass;

class ManageClassOneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $manageClassOneData = ManageClass::where('class', 1)
        ->with(['classSection'])
        ->with(['userList'])
        ->with(['subjects'])
        ->paginate(10);
        // dd($manageClassOneData);
        // return view('manage-class.class-one.index',compact('manageClassOneData'));

        return view('manage-class.class-one.index',compact('manageClassOneData'))
        ->with('i', (request()->input('page', 1) - 1) * 5);

    }
    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $classAssign = ClassAssign::orderBy('id', 'ASC')
        ->where('class', 1)
        ->with(['subjects'])
        ->get()->toArray();

        // dd($classAssign);
            

        $classSection = ClassSection::dataList();

        $days = DayOfWeek::dataList();

        // $subjects = Subject::dataList();

        // dd($subjects);

        $isTeacher = User::whereHas('roles', function($q) {
            $q->where(function ($query) {
                $query->where('name', 'Teacher')
                ->orWhere('name', 'Headmaster');
            });
        })->pluck('name', 'id')->toArray();

        // dd($isTeacher);
        
        return view('manage-class.class-one.create',compact('classAssign','classSection','isTeacher','days'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        
        
        $this->validate($request, [

            'class_assign_id' => 'required',

            'section_id' => 'required',
            
            'days' => 'required',

            'assign_teacher_id' => 'required',
            
            'time_start' => 'required',
            
            'time_end' => 'required',

            'pm_or_am_first' => 'required',

            'pm_or_am_second' => 'required',
			
        ]);

        // dd($input = $request->all());

        $input = $request->all();
        
        $classAssignId = $input['class_assign_id'];

        $getClassAssignData = ClassAssign::find($classAssignId);

        $getSubjectId = $getClassAssignData->subject_id;


        // dd($getSubjectId);

        // $classId = $input['class_id'];

        // dd($classId);

        // $getClass = InstitutionClass::where('id',$classId)->pluck('code')->first();
        
        // dd($getClass);
        
        $input['class_schedule'] = $input['time_start'] . "   " . $input['pm_or_am_first']. " - " . $input['time_end'] . "   " . $input['pm_or_am_second'];
       
        $input['subject_id'] = $getSubjectId;
        
        $input['class'] = 1;

        $user = ManageClass::create($input);

        toastr()->success('Manage Class one created successfully');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ManageClassOne $manageClassOne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageClassOne $manageClassOne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateManageClassOneRequest $request, ManageClassOne $manageClassOne)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageClassOne $manageClassOne)
    {
        //
    }
}
