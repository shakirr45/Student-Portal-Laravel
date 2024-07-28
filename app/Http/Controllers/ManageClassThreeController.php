<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Models\ManageClassThree;
use App\Models\ClassAssign;
use App\Models\ClassSection;
use App\Models\User;
use App\Models\Subject;
use App\Models\DayOfWeek;
use App\Models\ManageClass;

class ManageClassThreeController extends Controller
{
 //
 public function index(){

    $manageClassThreeData = ManageClass::where('class', 3)
    ->with(['classSection'])
    ->with(['userList'])
    ->with(['subjects'])
    ->paginate(10);

    // dd($manageClassThreeData);
    // return view('manage-class.class-three.index',compact('manageClassThreeData'));


    return view('manage-class.class-three.index',compact('manageClassThreeData'))
    ->with('i', (request()->input('page', 1) - 1) * 5);


}

public function create()
{
    //
    $classAssign = ClassAssign::orderBy('id', 'ASC')
    ->where('class', 3)
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
    
    return view('manage-class.class-three.create',compact('classAssign','classSection','isTeacher','days'));

}

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
    
    $input['class'] = 3;

    $user = ManageClass::create($input);

    toastr()->success('Manage Class Three created successfully');

    return redirect()->back();
}
}
