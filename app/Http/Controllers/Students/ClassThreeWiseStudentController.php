<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InstitutionClass;
use App\Models\ClassSection;
use App\Models\ClassFourStudentRecord;

class ClassThreeWiseStudentController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:manage-class-three-students', ['only' => ['index','singleStudentpromoteClass','studentWiseDemoteClass','promoteAllStudents','selectedWisePromoteStudents']]);
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

        })->where('assign_class', 3)
        ->where('promote_class', 3)
        ->where($serchCondition)
        ->with(['institutionClass'])
        ->paginate(10);

        // $institutionClass = InstitutionClass::dataList();

        $classSection = ClassSection::dataList();

        // For count class wise ==============>
        $totalStudentsCount = User::whereHas('roles', function($query){
            $query->where('name', 'Student');
        })->where('assign_class', 3)
        ->where('promote_class', 3)
        ->count();

        $totalDemotedStudentsCount = User::whereHas('roles', function($query){
            $query->where('name', 'Student');
        })->where('assign_class', 3)
        ->where('promote_class', 3)
        ->where('demote_class', 1)
        ->count();

        // dd($totalDemotedStudentsCount);

        if($request->ajax()){
			
			return view('class-wise-students.three.index-pagination',['data' => $data,'classSection' => $classSection]); 
            
        }
		
        return view('class-wise-students.three.index',compact('data','classSection','totalStudentsCount','totalDemotedStudentsCount'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function singleStudentpromoteClass( Request $request, $id ){

        $this->validate($request, [

            'section_id' => 'required',

        ]);

        $input = $request->all();

        // dd($input);

		$updateData = User::find($id);
        $input['demote_class'] = 0;
        $input['section_id'] = $input['section_id'];
        $input['assign_class'] = 4;
        $input['promote_class'] = 4;
		$updateData->update($input);

        // =============
        $stuId = $updateData->id;
        $stuSessionId = $updateData->session_id;
        $stuClassId = $updateData->promote_class;
        $stuSectionId = $updateData->section_id;

        // dd($stuSectionId);
                
        $data['student_id'] = $stuId;

        $data['session_id'] = $stuSessionId;

        $data['promote_class_id'] = $stuClassId;

        $data['section_id'] = $stuSectionId;

        // $data['promote_status'] = 1;

        ClassFourStudentRecord::create($data);

        toastr()->success('Created with new record into class Four');


        toastr()->success('Class Three Student promoted class Four successfully');

        return redirect()->route('class-three-wise-students.index');

    }

    public function studentWiseDemoteStatus( Request $request, $id ){

        $updateData = User::find($id);

        $input['demote_class'] = 1;

		$updateData->update($input);
        
        toastr()->success('Class Three student demoted status updated successfully');

        return redirect()->route('class-three-wise-students.index');
    }


    public function studentWisePromoteStatus( Request $request, $id ){

        $updateData = User::find($id);

        $input['demote_class'] = 0;

		$updateData->update($input);
        
        toastr()->success('Class Three student promoted status updated successfully');

        return redirect()->route('class-three-wise-students.index');

    }

    public function promoteAllStudents( Request $request ){

        $input = $request->all();

        // dd($input);

        $promoteSection = $input['section_id'];

        if(!empty($promoteSection)){
            
            $allClassThreeStudents = User::whereHas('roles', function ($query){
                $query->where('name', 'Student');
    
            })->where('assign_class', 3)
            ->where('promote_class', 3)
            ->where('demote_class', 0)
            ->get();
    
            // dd(count($allClassThreeStudents));
    
            if(count($allClassThreeStudents) == 0){
    
                toastr()->error('No one to promote class Three to Four');
    
                return redirect()->route('class-three-wise-students.index');
            }
            
            foreach ($allClassThreeStudents as $student) {
                $student->assign_class = 4;
                $student->promote_class = 4;
                $student->section_id = $promoteSection;
                
                $student->save(); // Save the changes to the database
            }
        // =====================
            foreach($allClassThreeStudents as $stu){

                $input = ['student_id' => $stu->id , 'session_id' => $stu->session_id , 'promote_class_id' => $stu->promote_class, 'section_id' => $stu->section_id];

                ClassFourStudentRecord::create($input);
            }
            toastr()->success('Created with new record into class Four');
        // =====================
    
            // dd($allClassThreeStudents);
    
            toastr()->success('Class Three all students promoted class Three to Four successfully');
    
            return redirect()->route('class-three-wise-students.index');

        }

        $allClassThreeStudents = User::whereHas('roles', function ($query){
            $query->where('name', 'Student');

        })->where('assign_class', 3)
        ->where('promote_class', 3)
        ->where('demote_class', 0)
        ->get();

        // dd(count($allClassThreeStudents));

        if(count($allClassThreeStudents) == 0){

            toastr()->error('No Three student to promote class Three to Four');

            return redirect()->route('class-three-wise-students.index');
        }
        
        foreach ($allClassThreeStudents as $student) {
            $student->assign_class = 4;
            $student->promote_class = 4;
            $student->section_id = $student->section_id;
            
            $student->save(); // Save the changes to the database
        }

        // =====================

        foreach($allClassThreeStudents as $stu){

            $input = ['student_id' => $stu->id , 'session_id' => $stu->session_id , 'promote_class_id' => $stu->promote_class,'section_id' => $stu->section_id];

            ClassFourStudentRecord::create($input);
        }
        toastr()->success('Created with new record into class Four');

        // =====================
        // dd($allClassThreeStudents);

        toastr()->success('Class Three all students promoted class Three to Four successfully');

        return redirect()->route('class-three-wise-students.index');

    }

    public function selectedWisePromoteStudents( Request $request ){
        
        $studentIds = $request->ids;

        $sectionId = $request->section;

        if(!empty($sectionId) && !empty($studentIds)) {

            $allClassThreeStudents = User::whereIn('id', $studentIds)->get();

            foreach ($allClassThreeStudents as $student) {
                $student->assign_class = 4;
                $student->promote_class = 4;
                $student->section_id = $sectionId;
                $student->demote_class = 0;
                
                $student->save(); // Save the changes to the database
            }

            // =====================
            foreach($allClassThreeStudents as $stu){

                $input = ['student_id' => $stu->id , 'session_id' => $stu->session_id , 'promote_class_id' => $stu->promote_class,'section_id' => $stu->section_id];
    
                ClassFourStudentRecord::create($input);
            }
            // =====================

            $totalStudentsCount = User::whereHas('roles', function($query){
                $query->where('name', 'Student');
            })->where('assign_class', 3)
            ->where('promote_class', 3)
            ->count();
    
            $totalDemotedStudentsCount = User::whereHas('roles', function($query){
                $query->where('name', 'Student');
            })->where('assign_class', 3)
            ->where('promote_class', 3)
            ->where('demote_class', 1)
            ->count();
    
            return response()->json(['message' => 'Selected Students Promoted Successfully and also Created with new record into class Four', 'totalStudentsCount' => $totalStudentsCount, 'totalDemotedStudentsCount' => $totalDemotedStudentsCount]);
    
        }

        $allClassThreeStudents = User::whereIn('id', $studentIds)->get();

        foreach ($allClassThreeStudents as $student) {
            $student->assign_class = 2;
            $student->promote_class = 2;
            $student->section_id = $student->section_id;
            $student->demote_class = 0;
            
            $student->save(); // Save the changes to the database
        }

        // =====================
        foreach($allClassThreeStudents as $stu){

            $input = ['student_id' => $stu->id , 'session_id' => $stu->session_id , 'promote_class_id' => $stu->promote_class,'section_id' => $stu->section_id];

            ClassFourStudentRecord::create($input);
        }
        // =====================


        $totalStudentsCount = User::whereHas('roles', function($query){
            $query->where('name', 'Student');
        })->where('assign_class', 3)
        ->where('promote_class', 3)
        ->count();

        $totalDemotedStudentsCount = User::whereHas('roles', function($query){
            $query->where('name', 'Student');
        })->where('assign_class', 3)
        ->where('promote_class', 3)
        ->where('demote_class', 1)
        ->count();

        return response()->json(['message' => 'Selected Students Promoted Successfully and also Created with new record into class Four', 'totalStudentsCount' => $totalStudentsCount, 'totalDemotedStudentsCount' => $totalDemotedStudentsCount]);

    }




}
