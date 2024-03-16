<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\ManageStudent;
use App\Http\Requests\StoreManageStudentRequest;
use App\Http\Requests\UpdateManageStudentRequest;
use App\Models\User;
use App\Models\ClassSection;
use App\Models\InstitutionClass;

class ManageStudentController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:manage-student-list|manage-student-create|manage-student-edit|manage-student-delete', ['only' => ['index','show']]);
         $this->middleware('permission:manage-student-create', ['only' => ['create','store']]);
         $this->middleware('permission:manage-student-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:manage-student-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $serchCondition  = [];

        if ( !empty($request->user_id ) )
		{

			 $serchCondition['user_id']  = $request->user_id;

		}
        

        $manageStudents = User::whereHas('roles', function ($query){
            $query->where('name', 'Student');
        })->where($serchCondition)->latest()->paginate(5);

    // Check if no students are found
    if ($manageStudents->isEmpty()) {
        return view('manage-students.index')->with('noDataFound', true);
    }

    return view('manage-students.index', compact('manageStudents'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $institutionClass = InstitutionClass::dataList();

        $classSection = ClassSection::dataList();

        // dd($institutionClass);

        return view('manage-students.create',compact('classSection','institutionClass'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($input = $request->all());

        $this->validate($request, [

            'user_id' => 'required', 

            'section_id' => 'required',

            'assign_class' => 'required',
			
        ]);

        $input = $request->all();

        $studentDetails = $request->all();

        $studentUserId = $studentDetails['user_id'];

        // dd($studentUserId);

        $findStudent = User::where('user_id', $studentUserId)->first()->toArray();

        if(!empty($findStudent)){

            $findStudentId = !empty($findStudent['id']) ? $findStudent['id'] : " ";

            $input['section_id'] = !empty($input['section_id']) ? $input['section_id'] : 0 ;

            $input['assign_class'] = !empty($input['assign_class']) ? $input['assign_class'] : 0 ;

            $updateData = User::find($findStudentId);
            $updateData->update($input);


            return redirect()->route('manage-students.index')
            ->with('success','Student Section Assign successfully');

        }
        dd("Data not Found");

    



    }

    /**
     * Display the specified resource.
     */
    public function show( $studentId )
    {
        $manageStudents = User::find($studentId);
        
        // dd($manageStudents);

        return view('manage-students.show',compact('manageStudents'));
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit( $studentId )
    // {

    //     $manageStudents = User::find($studentId);

    //     $studentWiseUser = $manageStudents->student_id;

    //     // dd($manageStudents);

    //     $institutionClass = InstitutionClass::dataList();

    //     $classSection = ClassSection::dataList();

    //     return view('manage-students.edit',compact('manageStudents','institutionClass','classSection', 'studentWiseUser'));

    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, $studentId)
    // {
    //     //
    //     $this->validate($request, [

    //         'user_id' => 'required', 

    //         'section_id' => 'required',

    //         'assign_class' => 'required',
			
    //     ]);

    //     $studentDetails = $request->all();


    //     // dd($studentDetails);



    //     // $studentUserId = $studentDetails['user_id'];

    //     $findStudent = User::where('id', $studentId)->first()->toArray();

    //     $findStudentId = !empty($findStudent['id']) ? $findStudent['id'] : " ";


    //     // dd($findStudentId);

    //     if(!empty($findStudentId)){

    //         // $findStudentId = !empty($findStudent['id']) ? $findStudent['id'] : " ";

    //         $input['section_id'] = !empty($input['section_id']) ? $input['section_id'] : 0 ;

    //         $input['class_assign_id'] = !empty($input['assign_class']) ? $input['assign_class'] : 0 ;

    //         $updateData = User::find($studentId);
    //         $updateData->update($input);


    //         return redirect()->route('manage-students.index')
    //         ->with('success','Student Section Assign successfully');

    //     }
    //     dd("Data not Found");
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(ManageStudent $manageStudent)
    // {
    //     //
    // }
}
