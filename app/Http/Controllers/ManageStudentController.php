<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\ManageStudent;
use App\Http\Requests\StoreManageStudentRequest;
use App\Http\Requests\UpdateManageStudentRequest;
use App\Models\User;
use App\Models\Session;
use App\Models\ClassSection;
use App\Models\ClassAssign;
use App\Models\InstitutionClass;
use App\Models\ClassOneStudentRecord;
use App\Models\ClassTwoStudentRecord;
use App\Models\ClassThreeStudentRecord;
use App\Models\ClassFourStudentRecord;
use App\Models\ClassFiveStudentRecord;
use App\Models\ClassSixStudentRecord;
use App\Models\ClassSevenStudentRecord;
use App\Models\ClassEightStudentRecord;
use App\Models\ClassNineStudentRecord;
use App\Models\ClassTenStudentRecord;
use Hash;
use Illuminate\Support\Arr;
use DB;
use Auth;


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
        })->where($serchCondition)
        // ->with(['InstitutionClass'])
        ->with(['classSection'])
        ->latest()->paginate(5);

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
        
        $sessions = Session::dataList();

        // dd($sessions);

        return view('manage-students.create',compact('institutionClass','classSection','sessions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',

            'email' => 'required|email|unique:users,email',

            'user_id' => 'required|unique:users,user_id',

            'mobile_no' => 'required|max:11|unique:users,mobile_no',

            'password' => 'required|same:confirm-password',

            'assign_class_id' => 'required',

            'section_id' => 'required',

            'session_id' => 'required',

        ]);


        $input = $request->all();

        $classId = $input['assign_class_id'];
        
        $checkClass = InstitutionClass::find($classId);

        $input['password'] = Hash::make($input['password']);

        $input['promote_class'] = $checkClass->code;
    
        $user = User::create($input);
        
        $user->assignRole('Student');

        $getStuClass = $user->promote_class;

        if( $getStuClass == 1 ){

            $getAllClass = ClassAssign::where('class_id', $getStuClass)->get();

            // dd($getAllClass->toArray());
            // dd($user->toArray());

            foreach($getAllClass as $class){

                $input = [
                'student_id' => $user->id ,
                'subject_id' => $class->subject_id,
                'session_id' => $user->session_id,
                'section_id' => $user->section_id,
                'promote_class' => 1,
                'entry_user_id' => !empty( Auth::user()->id) ? Auth::user()->id : null ,
                ];

                ClassOneStudentRecord::create($input);
                
            }

            dd("Ok for one");

        }else if( $getStuClass == 2 ){

            $getAllClass = ClassAssign::where('class_id', $getStuClass)->get();

            // dd($getAllClass->toArray());

            foreach($getAllClass as $class){

                $input = [
                'student_id' => $user->id ,
                'subject_id' => $class->subject_id,
                'session_id' => $user->session_id,
                'section_id' => $user->section_id,
                'promote_class' => 2,
                'entry_user_id' => !empty( Auth::user()->id) ? Auth::user()->id : null ,
                ];

                ClassTwoStudentRecord::create($input);
            }

            dd("Ok for 2");

        }else if( $getStuClass == 3 ){

            $getAllClass = ClassAssign::where('class_id', $getStuClass)->get();

            // dd($getAllClass->toArray());
            // dd($user->toArray());

            foreach($getAllClass as $class){

                $input = [
                'student_id' => $user->id ,
                'subject_id' => $class->subject_id,
                'session_id' => $user->session_id,
                'section_id' => $user->section_id,
                'promote_class' => 3,
                'entry_user_id' => !empty( Auth::user()->id) ? Auth::user()->id : null ,
                ];

                ClassThreeStudentRecord::create($input);
                
            }

            dd("Ok for 3");

        }else if( $getAllClass == 4 ){

            $getAllClass = ClassAssign::where('class_id', $getStuClass)->get();

            // dd($getAllClass->toArray());
            // dd($user->toArray());

            foreach($getAllClass as $class){

                $input = [
                'student_id' => $user->id ,
                'subject_id' => $class->subject_id,
                'session_id' => $user->session_id,
                'section_id' => $user->section_id,
                'promote_class' => 4,
                'entry_user_id' => !empty( Auth::user()->id) ? Auth::user()->id : null ,
                ];

                ClassFourStudentRecord::create($input);
                
            }

            dd("Ok for four");
            
        }else if( $getAllClass == 5 ){

            $getAllClass = ClassAssign::where('class_id', $getStuClass)->get();

            // dd($getAllClass->toArray());
            // dd($user->toArray());

            foreach($getAllClass as $class){

                $input = [
                'student_id' => $user->id ,
                'subject_id' => $class->subject_id,
                'session_id' => $user->session_id,
                'section_id' => $user->section_id,
                'promote_class' => 5,
                'entry_user_id' => !empty( Auth::user()->id) ? Auth::user()->id : null ,
                ];

                ClassFiveStudentRecord::create($input);
                
            }

            dd("Ok for Five");

        }else if( $getAllClass == 6 ){

            $getAllClass = ClassAssign::where('class_id', $getStuClass)->get();

            // dd($getAllClass->toArray());
            // dd($user->toArray());

            foreach($getAllClass as $class){

                $input = [
                'student_id' => $user->id ,
                'subject_id' => $class->subject_id,
                'session_id' => $user->session_id,
                'section_id' => $user->section_id,
                'promote_class' => 6,
                'entry_user_id' => !empty( Auth::user()->id) ? Auth::user()->id : null ,
                ];

                ClassSixStudentRecord::create($input);
                
            }

            dd("Ok for Six");
        }
        else if( $getAllClass == 7 ){

            $getAllClass = ClassAssign::where('class_id', $getStuClass)->get();

            // dd($getAllClass->toArray());
            // dd($user->toArray());

            foreach($getAllClass as $class){

                $input = [
                'student_id' => $user->id ,
                'subject_id' => $class->subject_id,
                'session_id' => $user->session_id,
                'section_id' => $user->section_id,
                'promote_class' => 7,
                'entry_user_id' => !empty( Auth::user()->id) ? Auth::user()->id : null ,
                ];

                ClassSevenStudentRecord::create($input);
                
            }

            dd("Ok for Seven");

        }else if( $getAllClass == 8 ){

            $getAllClass = ClassAssign::where('class_id', $getStuClass)->get();

            // dd($getAllClass->toArray());
            // dd($user->toArray());

            foreach($getAllClass as $class){

                $input = [
                'student_id' => $user->id ,
                'subject_id' => $class->subject_id,
                'session_id' => $user->session_id,
                'section_id' => $user->section_id,
                'promote_class' => 8,
                'entry_user_id' => !empty( Auth::user()->id) ? Auth::user()->id : null ,
                ];

                ClassEightStudentRecord::create($input);
                
            }

            dd("Ok for Eight");

        }
        else if( $getAllClass == 9 ){

            $getAllClass = ClassAssign::where('class_id', $getStuClass)->get();

            // dd($getAllClass->toArray());
            // dd($user->toArray());

            foreach($getAllClass as $class){

                $input = [
                'student_id' => $user->id ,
                'subject_id' => $class->subject_id,
                'session_id' => $user->session_id,
                'section_id' => $user->section_id,
                'promote_class' => 9,
                'entry_user_id' => !empty( Auth::user()->id) ? Auth::user()->id : null ,
                ];

                ClassNineStudentRecord::create($input);
                
            }

            dd("Ok for Nine");

        }else if( $getAllClass == 10 ){

            $getAllClass = ClassAssign::where('class_id', $getStuClass)->get();

            // dd($getAllClass->toArray());
            // dd($user->toArray());

            foreach($getAllClass as $class){

                $input = [
                'student_id' => $user->id ,
                'subject_id' => $class->subject_id,
                'session_id' => $user->session_id,
                'section_id' => $user->section_id,
                'promote_class' => 10,
                'entry_user_id' => !empty( Auth::user()->id) ? Auth::user()->id : null ,
                ];

                ClassTenStudentRecord::create($input);
                
            }

            dd("Ok for Ten");
        }


dd("ok");
        
        

        toastr()->success('Student created successfully');

        return redirect()->route('manage-students.index');

    }

    /**
     * Display the specified resource.
     */
    public function show( $studentId )
    {
        $manageStudents = User::where('id',$studentId)
        ->with(['InstitutionClass'])
        ->with(['classSection'])->first();
        
        // dd($manageStudents);

        return view('manage-students.show',compact('manageStudents'));
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    public function edit($id)
    {

        $user = User::find($id);

        $institutionClass = InstitutionClass::dataList();

        $classSections = ClassSection::dataList();

        $sessions = Session::dataList();


        $institutionClassSelected =  !empty( $user->assign_class_id ) ? ( $user->assign_class_id ) : [];

        return view('manage-students.edit',compact('user','institutionClass','institutionClassSelected','classSections','sessions'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            
            'email' => 'required|email|unique:users,email,'.$id,
            
            'user_id' => 'required|unique:users,user_id,'.$id,
            
            'mobile_no' => 'required|max:11|unique:users,mobile_no,'.$id,

            'password' => 'same:confirm-password',
            
            'assign_class_id' => 'required',
            
            'section_id' => 'required',

            'session_id' => 'required',
            
        ]);
    
        $input = $request->all();

        $classId = $input['assign_class_id'];
        
        $checkClass = InstitutionClass::find($classId);

        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }

        $input['promote_class'] = $checkClass->code;

    
        $user = User::find($id);

        // $input['assign_class_id'] = json_encode($input['assign_class_id']);

        $user->update($input);
        
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole('Student');

        toastr()->success('Student updated successfully!');

        return redirect()->route('manage-students.index');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy($id)
    {
        User::find($id)->delete();


        toastr()->success('Student deleted successfully!');

        return redirect()->route('manage-students.index');

    }
}
