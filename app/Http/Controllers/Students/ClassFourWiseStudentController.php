<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InstitutionClass;
use App\Models\ClassSection;
use App\Models\ClassFiveStudentRecord;

class ClassFourWiseStudentController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:manage-class-four-students', ['only' => ['index','singleStudentpromoteClass','studentWiseDemoteClass','promoteAllStudents','selectedWisePromoteStudents']]);
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

        })->where('assign_class', 4)
        ->where('promote_class', 4)
        ->where($serchCondition)
        ->with(['institutionClass'])
        ->paginate(10);

        // $institutionClass = InstitutionClass::dataList();

        $classSection = ClassSection::dataList();

        // For count class wise ==============>
        $totalStudentsCount = User::whereHas('roles', function($query){
            $query->where('name', 'Student');
        })->where('assign_class', 4)
        ->where('promote_class', 4)
        ->count();

        $totalDemotedStudentsCount = User::whereHas('roles', function($query){
            $query->where('name', 'Student');
        })->where('assign_class', 4)
        ->where('promote_class', 4)
        ->where('demote_class', 1)
        ->count();

        // dd($totalDemotedStudentsCount);

        if($request->ajax()){
			
			return view('class-wise-students.four.index-pagination',['data' => $data,'classSection' => $classSection]); 
            
        }
		
        return view('class-wise-students.four.index',compact('data','classSection','totalStudentsCount','totalDemotedStudentsCount'))
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
        $input['assign_class'] = 5;
        $input['promote_class'] = 5;
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

        ClassFiveStudentRecord::create($data);

        toastr()->success('Created with new record into class Five');


        toastr()->success('Class Four Student promoted class Five successfully');

        return redirect()->route('class-four-wise-students.index');

    }

    public function studentWiseDemoteStatus( Request $request, $id ){

        $updateData = User::find($id);

        $input['demote_class'] = 1;

		$updateData->update($input);
        
        toastr()->success('Class Four student demoted status updated successfully');

        return redirect()->route('class-four-wise-students.index');
    }

    public function studentWisePromoteStatus( Request $request, $id ){

        $updateData = User::find($id);

        $input['demote_class'] = 0;

		$updateData->update($input);
        
        toastr()->success('Class Four student promoted status updated successfully');

        return redirect()->route('class-four-wise-students.index');

    }

    public function promoteAllStudents( Request $request ){

        $input = $request->all();

        // dd($input);

        $promoteSection = $input['section_id'];

        if(!empty($promoteSection)){
            
            $allClassFourStudents = User::whereHas('roles', function ($query){
                $query->where('name', 'Student');
    
            })->where('assign_class', 4)
            ->where('promote_class', 4)
            ->where('demote_class', 0)
            ->get();
    
            // dd(count($allClassFourStudents));
    
            if(count($allClassFourStudents) == 0){
    
                toastr()->error('No one to promote class Four to Five');
    
                return redirect()->route('class-four-wise-students.index');
            }
            
            foreach ($allClassFourStudents as $student) {
                $student->assign_class = 5;
                $student->promote_class = 5;
                $student->section_id = $promoteSection;
                
                $student->save(); // Save the changes to the database
            }
        // =====================
            foreach($allClassFourStudents as $stu){

                $input = ['student_id' => $stu->id , 'session_id' => $stu->session_id , 'promote_class_id' => $stu->promote_class, 'section_id' => $stu->section_id];

                ClassFiveStudentRecord::create($input);
            }
            toastr()->success('Created with new record into class Five');
        // =====================
    
            // dd($allClassFourStudents);
    
            toastr()->success('Class Four all students promoted class Four to Five successfully');
    
            return redirect()->route('class-four-wise-students.index');

        }

        $allClassFourStudents = User::whereHas('roles', function ($query){
            $query->where('name', 'Student');

        })->where('assign_class', 4)
        ->where('promote_class', 4)
        ->where('demote_class', 0)
        ->get();

        // dd(count($allClassFourStudents));

        if(count($allClassFourStudents) == 0){

            toastr()->error('No one student to promote class Four to Five');

            return redirect()->route('class-four-wise-students.index');
        }
        
        foreach ($allClassFourStudents as $student) {
            $student->assign_class = 5;
            $student->promote_class = 5;
            $student->section_id = $student->section_id;
            
            $student->save(); // Save the changes to the database
        }

        // =====================

        foreach($allClassFourStudents as $stu){

            $input = ['student_id' => $stu->id , 'session_id' => $stu->session_id , 'promote_class_id' => $stu->promote_class,'section_id' => $stu->section_id];

            ClassFiveStudentRecord::create($input);
        }
        toastr()->success('Created with new record into class Five');

        // =====================
        // dd($allClassFourStudents);

        toastr()->success('Class Four all students promoted class Four to Five successfully');

        return redirect()->route('class-four-wise-students.index');

    }

    public function selectedWisePromoteStudents( Request $request ){
        
        $studentIds = $request->ids;

        $sectionId = $request->section;

        if(!empty($sectionId) && !empty($studentIds)) {

            $allClassThreeStudents = User::whereIn('id', $studentIds)->get();

            foreach ($allClassThreeStudents as $student) {
                $student->assign_class = 5;
                $student->promote_class = 5;
                $student->section_id = $sectionId;
                $student->demote_class = 0;
                
                $student->save(); // Save the changes to the database
            }

            // =====================
            foreach($allClassThreeStudents as $stu){

                $input = ['student_id' => $stu->id , 'session_id' => $stu->session_id , 'promote_class_id' => $stu->promote_class,'section_id' => $stu->section_id];
    
                ClassFiveStudentRecord::create($input);
            }
            // =====================

            $totalStudentsCount = User::whereHas('roles', function($query){
                $query->where('name', 'Student');
            })->where('assign_class', 4)
            ->where('promote_class', 4)
            ->count();
    
            $totalDemotedStudentsCount = User::whereHas('roles', function($query){
                $query->where('name', 'Student');
            })->where('assign_class', 4)
            ->where('promote_class', 4)
            ->where('demote_class', 1)
            ->count();
    
            return response()->json(['message' => 'Selected Students Promoted Successfully and also Created with new record into class Five', 'totalStudentsCount' => $totalStudentsCount, 'totalDemotedStudentsCount' => $totalDemotedStudentsCount]);
    
        }

        $allClassThreeStudents = User::whereIn('id', $studentIds)->get();

        foreach ($allClassThreeStudents as $student) {
            $student->assign_class = 5;
            $student->promote_class = 5;
            $student->section_id = $student->section_id;
            $student->demote_class = 0;
            
            $student->save(); // Save the changes to the database
        }

        // =====================
        foreach($allClassThreeStudents as $stu){

            $input = ['student_id' => $stu->id , 'session_id' => $stu->session_id , 'promote_class_id' => $stu->promote_class,'section_id' => $stu->section_id];

            ClassFiveStudentRecord::create($input);
        }
        // =====================


        $totalStudentsCount = User::whereHas('roles', function($query){
            $query->where('name', 'Student');
        })->where('assign_class', 4)
        ->where('promote_class', 4)
        ->count();

        $totalDemotedStudentsCount = User::whereHas('roles', function($query){
            $query->where('name', 'Student');
        })->where('assign_class', 4)
        ->where('promote_class', 4)
        ->where('demote_class', 1)
        ->count();

        return response()->json(['message' => 'Selected Students Promoted Successfully and also Created with new record into class Five', 'totalStudentsCount' => $totalStudentsCount, 'totalDemotedStudentsCount' => $totalDemotedStudentsCount]);

    }



}
