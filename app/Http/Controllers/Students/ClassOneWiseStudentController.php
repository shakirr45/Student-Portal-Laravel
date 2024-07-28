<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InstitutionClass;
use App\Models\ClassSection;
use App\Models\ClassTwoStudentRecord;
use App\Models\ClassAssign;
use Auth;

class ClassOneWiseStudentController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:manage-class-one-students', ['only' => ['index','singleStudentpromoteClass','studentWiseDemoteClass','promoteAllStudents','selectedWisePromoteStudents']]);
    }
    
    public function index(Request $request)
    {

        $serchCondition  = [];

        if(!empty($request->user_id)){

            $serchCondition['user_id'] = $request->user_id;
        }
        if(!empty($request->final_result)){

            $serchCondition['final_result'] = $request->final_result;
        }

        $data = User::whereHas('roles', function ($query){
            $query->where('name', 'Student');

        })
        // ->where('assign_class_id', 1)
        ->where('promote_class', 1)
        ->where($serchCondition)
        // ->with(['institutionClass'])
        ->paginate(10);

        // $institutionClass = InstitutionClass::dataList();

        $classSection = ClassSection::dataList();

        // For count class wise ==============>
        $totalStudentsCount = User::whereHas('roles', function($query){
            $query->where('name', 'Student');
        })
        // ->where('assign_class_id', 1)
        ->where('promote_class', 1)
        ->count();

        $totalDemotedStudentsCount = User::whereHas('roles', function($query){
            $query->where('name', 'Student');
        })
        // ->where('assign_class_id', 1)
        ->where('promote_class', 1)
        ->where('demote_class', 1)
        ->count();

        // dd($totalDemotedStudentsCount);

        if($request->ajax()){
			
			return view('class-wise-students.one.index-pagination',['data' => $data,'classSection' => $classSection]); 
            
        }
		
        return view('class-wise-students.one.index',compact('data','classSection','totalStudentsCount','totalDemotedStudentsCount'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    
    public function singleStudentpromoteClass( Request $request, $id ){

        $this->validate($request, [

            'section_id' => 'required',

        ]);

        $input = $request->all();
        $getAllClass = ClassAssign::where('class', 2)->get();

        // dd($getAllClass);

		$updateData = User::find($id);
        $input['demote_class'] = 0;
        $input['section_id'] = $input['section_id'];
        // $input['assign_class_id'] = 2;
        $input['promote_class'] = 2;
		$updateData->update($input);


        foreach($getAllClass as $class){

            $input = [
            'student_id' => $updateData->id ,
            'subject_id' => $class->subject_id,
            // 'assign_class_id_id' => $user->assign_class_id,
            'session_id' => $updateData->session_id,
            'section_id' => $updateData->section_id,
            'promote_class' => 2,
            'entry_user_id' => !empty( Auth::user()->id) ? Auth::user()->id : null ,
            ];

            ClassTwoStudentRecord::create($input);
            
        }

        toastr()->success('Created with new record into class Two');

        toastr()->success('Class One Student promoted class Two successfully');

        return redirect()->route('class-one-wise-students.index');

    }

    public function studentWiseDemoteStatus( Request $request, $id ){

        $updateData = User::find($id);

        $input['demote_class'] = 1;

		$updateData->update($input);
        
        toastr()->success('Class One student demoted status updated successfully');

        return redirect()->route('class-one-wise-students.index');
    }

    public function studentWisePromoteStatus( Request $request, $id ){

        $updateData = User::find($id);

        $input['demote_class'] = 0;

		$updateData->update($input);
        
        toastr()->success('Class One student promoted status updated successfully');

        return redirect()->route('class-one-wise-students.index');

    }


    public function promoteAllStudents( Request $request ){

        $input = $request->all();

        $allClassOneStudents = User::whereHas('roles', function ($query){
            $query->where('name', 'Student');

        })
        // ->where('assign_class_id', 1)
        ->where('promote_class', 1)
        ->where('demote_class', 0)
        ->get();

        // dd($input);

        $promoteSection = $input['section_id'];

        if(!empty($promoteSection)){
    
            // dd(count($allClassOneStudents));
    
            if(count($allClassOneStudents) == 0){
    
                toastr()->error('No one to promote class One to Two');
    
                return redirect()->route('class-one-wise-students.index');
            }

            $getAllClass = ClassAssign::where('class', 2)->get();

            
            foreach ($allClassOneStudents as $student) {
                // $student->assign_class_id = 2;
                $student->promote_class = 2;
                $student->section_id = $promoteSection;
                
                $student->save(); // Save the changes to the database

                foreach($getAllClass as $class){

                    $input = [
                    'student_id' => $student->id ,
                    'subject_id' => $class->subject_id,
                    'session_id' => $student->session_id,
                    'section_id' => $student->section_id,
                    'promote_class' => 2,
                    'entry_user_id' => !empty( Auth::user()->id) ? Auth::user()->id : null ,
                    ];
    
                    ClassTwoStudentRecord::create($input);
                }

            }
    
            toastr()->success('Class One all students promoted class One to Two successfully');
            return redirect()->route('class-one-wise-students.index');

        }

        if(count($allClassOneStudents) == 0){

            toastr()->error('No one to promote class One to Two');

            return redirect()->route('class-one-wise-students.index');
        }

        $getAllClass = ClassAssign::where('class', 2)->get();

            
        foreach ($allClassOneStudents as $student) {
            // $student->assign_class_id = 2;
            $student->promote_class = 2;
            $student->section_id = $student->section_id;
            
            $student->save(); // Save the changes to the database

            foreach($getAllClass as $class){

                $input = [
                'student_id' => $student->id ,
                'subject_id' => $class->subject_id,
                'session_id' => $student->session_id,
                'section_id' => $student->section_id,
                'promote_class' => 2,
                'entry_user_id' => !empty( Auth::user()->id) ? Auth::user()->id : null ,
                ];

                ClassTwoStudentRecord::create($input);
            }

        }

        toastr()->success('Class One all students promoted class One to Two successfully');

        return redirect()->route('class-one-wise-students.index');

    }


    public function selectedWisePromoteStudents( Request $request ){
        
        $studentIds = $request->ids;

        // dd($studentIds);
        $getAllClass = ClassAssign::where('class', 2)->get();
        $sectionId = $request->section;

        if(!empty($sectionId) && !empty($studentIds)) {

            $allClassOneStudents = User::whereIn('id', $studentIds)->get();

            //  dd($allClassOneStudents->toArray());
            
            foreach ($allClassOneStudents as $student) {
                // $student->assign_class_id = 2;
                $student->promote_class = 2;
                $student->section_id = $sectionId;
                
                $student->save(); // Save the changes to the database
    
                foreach($getAllClass as $class){
    
                    $input = [
                    'student_id' => $student->id ,
                    'subject_id' => $class->subject_id,
                    'session_id' => $student->session_id,
                    'section_id' => $sectionId,
                    'promote_class' => 2,
                    'entry_user_id' => !empty( Auth::user()->id) ? Auth::user()->id : null,
                    ];
    
                    ClassTwoStudentRecord::create($input);
                }
    
            }

            $totalStudentsCount = User::whereHas('roles', function($query){
                $query->where('name', 'Student');
            })
            // ->where('assign_class_id', 1)
            ->where('promote_class', 1)
            ->count();
    
            $totalDemotedStudentsCount = User::whereHas('roles', function($query){
                $query->where('name', 'Student');
            })
            // ->where('assign_class_id', 1)
            ->where('promote_class', 1)
            ->where('demote_class', 1)
            ->count();
    
            return response()->json(['message' => 'Selected Students Promoted Successfully and also Created with new record into class Two', 'totalStudentsCount' => $totalStudentsCount, 'totalDemotedStudentsCount' => $totalDemotedStudentsCount]);
    
        }
        $allClassOneStudents = User::whereIn('id', $studentIds)->get();

        foreach ($allClassOneStudents as $student) {
            // $student->assign_class_id = 2;
            $student->promote_class = 2;
            $student->section_id = $student->section_id;
            
            $student->save(); // Save the changes to the database

            foreach($getAllClass as $class){

                $input = [
                'student_id' => $student->id ,
                'subject_id' => $class->subject_id,
                'session_id' => $student->session_id,
                'section_id' => $student->section_id,
                'promote_class' => 2,
                'entry_user_id' => !empty( Auth::user()->id) ? Auth::user()->id : null ,
                ];

                ClassTwoStudentRecord::create($input);
            }

        }


        $totalStudentsCount = User::whereHas('roles', function($query){
            $query->where('name', 'Student');
        })
        // ->where('assign_class_id', 1)
        ->where('promote_class', 1)
        ->count();
        $totalDemotedStudentsCount = User::whereHas('roles', function($query){
            $query->where('name', 'Student');
        })
        // ->where('assign_class_id', 1)
        ->where('promote_class', 1)
        ->where('demote_class', 1)
        ->count();

        return response()->json(['message' => 'Selected Students Promoted Successfully and also Created with new record into class Two', 'totalStudentsCount' => $totalStudentsCount, 'totalDemotedStudentsCount' => $totalDemotedStudentsCount]);


    }


}
