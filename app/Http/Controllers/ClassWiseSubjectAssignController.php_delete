<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\ClassWiseSubjectAssign;
use App\Http\Requests\StoreClassWiseSubjectAssignRequest;
use App\Http\Requests\UpdateClassWiseSubjectAssignRequest;
use App\Models\DayOfWeek;
use App\Models\Subject;
use App\Models\User;
// use App\Models\ClassAssign;
use App\Models\InstitutionClass;
use App\Models\ClassSection;

class ClassWiseSubjectAssignController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:class-wise-subject-list|class-wise-subject-create|class-wise-subject-edit|class-wise-subject-delete', ['only' => ['index','show']]);
         $this->middleware('permission:class-wise-subject-create', ['only' => ['create','store']]);
         $this->middleware('permission:class-wise-subject-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:class-wise-subject-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $classWiseSubjectAssign = ClassWiseSubjectAssign::latest()
        ->with(['institutionClass'])
        ->with(['userList'])
        ->paginate(5);
        

        // dd($classWiseSubjectAssign);

        return view('class-wise-subject-assign.index',compact('classWiseSubjectAssign'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $assignTeacher = User::whereHas('roles', function($q) {
            $q->where(function ($query) {
                $query->where('name', 'Teacher')
                ->orWhere('name', 'Headmaster');
            });
        })->pluck('name', 'id')->toArray();

        // dd($assignTeacher);

        // $classAssign = ClassAssign::get(['class_id', 'section'])->toArray();

        // $reArrangeClass = [];
        
        // if (!empty($classAssign)) {

        //     foreach ($classAssign as $value) {

        //         $reArrangeClass[$value['class_id']] = ' Class -- '.$value['class_id'] . ' -- Section: ' . $value['section'];


        //     }
        //     // dd($reArrangeClass->id);
        // }

        $institutionClass = InstitutionClass::dataList();

        $classSection = ClassSection::dataList();

        $days = DayOfWeek::dataList();

        $subjects = Subject::dataList();

        return view('class-wise-subject-assign.create',compact('days','subjects','institutionClass','classSection','assignTeacher'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());

        $this->validate($request, [

            'class_assign_id' => 'required',

            'section_assign_id' => 'required',

            'assign_teacher_id' => 'required',

            'subjects' => 'required',
			
            'days' => 'required',

        ]);


        $input = $request->all();

        // dd($input);

        ClassWiseSubjectAssign::create($input);

        return redirect()->route('class-wise-subject-assign.index')
                        ->with('success','Subject Assign successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassWiseSubjectAssign $classWiseSubjectAssign)
    {
        //
        return view('class-wise-subject-assign.show',compact('classWiseSubjectAssign'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassWiseSubjectAssign $classWiseSubjectAssign)
    {
 //
 $assignTeacher = User::whereHas('roles', function($q) {
    $q->where(function ($query) {
        $query->where('name', 'Teacher')
        ->orWhere('name', 'Headmaster');
    });
})->pluck('name', 'id')->toArray();

// dd($assignTeacher);

// $classAssign = ClassAssign::get(['id', 'class', 'section'])->toArray();

// $reArrangeClass = [];

// if (!empty($classAssign)) {

//     foreach ($classAssign as $value) {

//         $reArrangeClass[$value['id']] = ' Class -- '.$value['class'] . ' -- Section: ' . $value['section'];

//     }
//     // dd($reArrangeClass);
// }


$institutionClass = InstitutionClass::dataList();

$classSection = ClassSection::dataList();

$subjects = Subject::dataList();

$days = DayOfWeek::dataList();


return view('class-wise-subject-assign.edit',compact('classWiseSubjectAssign','assignTeacher','institutionClass','classSection','subjects','days'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassWiseSubjectAssign $classWiseSubjectAssign)
    {
        //
                // dd($request->all());

                $this->validate($request, [

                    'class_assign_id' => 'required',
        
                    'section_assign_id' => 'required',
        
                    'assign_teacher_id' => 'required',
        
                    'subjects' => 'required',
                    
                    'days' => 'required',
        
                ]);
        
                $input = $request->all();
        
                $updateData = ClassWiseSubjectAssign::find($classWiseSubjectAssign->id);
        
                $updateData->update($input);
        
                return redirect()->route('class-wise-subject-assign.index')
                                ->with('success','Subject Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassWiseSubjectAssign $classWiseSubjectAssign)
    {
        //
        $classWiseSubjectAssign->delete();
    
        return redirect()->route('class-wise-subject-assign.index')
                        ->with('success','Assigned Subject deleted successfully');
    }
}
