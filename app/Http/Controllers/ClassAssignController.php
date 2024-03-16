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
        // $currentDate = \Carbon\Carbon::now();
        // $tomorrowDate = $currentDate->addDay(); // Add one day to get tomorrow's date
        // $tomorrowDate = $currentDate->addDay(); // Add one day to get tomorrow's date
        // $dayOfWeek = $tomorrowDate->format('l'); // Get the day of the week for tomorrow
        // dd($dayOfWeek);
        // if ($dayOfWeek == 'Saturday') {
        //     // dd("true");
        //     return "true";
        // } else {
        //     // dd("false");
        //     return "false";
        // }
        

        // $classes = ClassAssign::latest()
        // ->with(['userAsTeacher'])
        // ->paginate(5);


        $classes = ClassAssign::latest()
        ->with(['institutionClass'])
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

        $classSection = ClassSection::dataList();

        $days = DayOfWeek::dataList();

        $subjects = Subject::dataList();

        $isTeacher = User::whereHas('roles', function($q) {
            $q->where(function ($query) {
                $query->where('name', 'Teacher')
                ->orWhere('name', 'Headmaster');
            });
        })->pluck('name', 'id')->toArray();

        // dd($isTeacher);
        
        // return view('class-assign.create',compact('institutionClass','classSection','isTeacher','subjects','days'));


        return view('class-assign.create',compact('institutionClass','classSection','isTeacher','subjects','days'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [

            'user_id' => 'required',

            'class_id' => 'required',

            'section_id' => 'required',

            'days' => 'required',

            'subjects' => 'required',
			
            // 'assign_teacher_id' => 'required',
			

			
        ]);



        // dd($input = $request->all());
        $input = $request->all();

        
		// $input['section'] = json_encode($input['section']);
		// $input['days'] = json_encode($input['days']);
		// $input['subjects'] = json_encode($input['subjects']);

        $user = ClassAssign::create($input);

        return redirect()->route('class-assign.index')
                        ->with('success','Class Assign successfully');
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

        $classSection = ClassSection::dataList();

        $days = DayOfWeek::dataList();

        $subjects = Subject::dataList();

        $isTeacher = User::whereHas('roles', function($q) {
            $q->where(function ($query) {
                $query->where('name', 'Teacher')
                ->orWhere('name', 'Headmaster');
            });
        })->pluck('name', 'id')->toArray();


        // return view('class-assign.edit',compact('classAssign'),compact('isTeacher','institutionClass','classSection','days','subjects'));

        return view('class-assign.edit',compact('classAssign'),compact('institutionClass','classSection','isTeacher','subjects','days'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassAssign $classAssign)
    {

        $this->validate($request, [

            'user_id' => 'required',
            
            'class_id' => 'required',
            
            'section_id' => 'required',
            // 
            'days' => 'required',

            'subjects' => 'required',
			
            // 'assign_teacher_id' => 'required',
			
            // 'days' => 'required',

            // 'subjects' => 'required',
			
        ]);
    
		$input = $request->all();

		$updateData = ClassAssign::find($classAssign->id);
		$updateData->update($input);
			
    
        return redirect()->route('class-assign.index')
                        ->with('success','Assigned class updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassAssign $classAssign)
    {
        $classAssign->delete();
    
        return redirect()->route('class-assign.index')
                        ->with('success','Assigned class deleted successfully');
    }
}
