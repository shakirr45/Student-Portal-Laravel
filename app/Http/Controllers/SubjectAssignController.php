<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\SubjectAssign;
use App\Http\Requests\StoreSubjectAssignRequest;
use App\Http\Requests\UpdateSubjectAssignRequest;
use App\Models\DayOfWeek;
use App\Models\Subject;
use App\Models\User;
use App\Models\ClassAssign;

class SubjectAssignController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:subject-list|subject-create|subject-edit|subject-delete', ['only' => ['index','show']]);
         $this->middleware('permission:subject-create', ['only' => ['create','store']]);
         $this->middleware('permission:subject-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:subject-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $subjectAssign = SubjectAssign::latest()
        ->with(['classAssign'])
        ->with(['userList'])
        ->paginate(5);

        // dd($subjectAssign);

        return view('subject-assign.index',compact('subjectAssign'))
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

        $classAssign = ClassAssign::get(['id', 'class', 'section'])->toArray();

        $reArrangeClass = [];
        
        if (!empty($classAssign)) {

            foreach ($classAssign as $value) {

                $reArrangeClass[$value['id']] = ' Class -- '.$value['class'] . ' -- Section: ' . $value['section'];

            }
            // dd($reArrangeClass);
        }

        $days = DayOfWeek::dataList();

        $subjects = Subject::dataList();

        return view('subject-assign.create',compact('days','subjects','reArrangeClass','assignTeacher'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());

        $this->validate($request, [

            'class_assign_id' => 'required',

            'assign_teacher_id' => 'required',

            'subjects' => 'required',
			
            'days' => 'required',

        ]);


        $input = $request->all();

        // dd($input);

        SubjectAssign::create($input);

        return redirect()->route('subject-assign.index')
                        ->with('success','Subject Assign successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubjectAssign $subjectAssign)
    {
        //
        return view('subject-assign.show',compact('subjectAssign'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubjectAssign $subjectAssign)
    {
        //
        $assignTeacher = User::whereHas('roles', function($q) {
            $q->where(function ($query) {
                $query->where('name', 'Teacher')
                ->orWhere('name', 'Headmaster');
            });
        })->pluck('name', 'id')->toArray();

        // dd($assignTeacher);

        $classAssign = ClassAssign::get(['id', 'class', 'section'])->toArray();
        

        $classAssign = ClassAssign::get(['id', 'class', 'section'])->toArray();

        $reArrangeClass = [];
        
        if (!empty($classAssign)) {

            foreach ($classAssign as $value) {

                $reArrangeClass[$value['id']] = ' Class -- '.$value['class'] . ' -- Section: ' . $value['section'];

            }
            // dd($reArrangeClass);
        }

         $subjects = Subject::dataList();

        $days = DayOfWeek::dataList();


        return view('subject-assign.edit',compact('subjectAssign','assignTeacher','reArrangeClass','subjects','days'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubjectAssign $subjectAssign)
    {
        
        // dd($request->all());

        $this->validate($request, [

            'class_assign_id' => 'required',

            'assign_teacher_id' => 'required',

            'subjects' => 'required',
			
            'days' => 'required',

        ]);

        $input = $request->all();

		$updateData = SubjectAssign::find($subjectAssign->id);

        $updateData->update($input);

        return redirect()->route('subject-assign.index')
                        ->with('success','Subject Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubjectAssign $subjectAssign)
    {
        //
        $subjectAssign->delete();
    
        return redirect()->route('subject-assign.index')
                        ->with('success','Assigned Subject deleted successfully');
    }
}
