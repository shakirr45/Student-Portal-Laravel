<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InstitutionClass;
use App\Models\ClassSection;
use App\Models\ClassTwoStudentRecord;


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

        })->where('assign_class', 1)
        ->where('promote_class', 1)
        ->where($serchCondition)
        ->with(['institutionClass'])
        ->paginate(10);

        // $institutionClass = InstitutionClass::dataList();

        $classSection = ClassSection::dataList();

        // For count class wise ==============>
        $totalStudentsCount = User::whereHas('roles', function($query){
            $query->where('name', 'Student');
        })->where('assign_class', 1)
        ->where('promote_class', 1)
        ->count();

        $totalDemotedStudentsCount = User::whereHas('roles', function($query){
            $query->where('name', 'Student');
        })->where('assign_class', 1)
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

        // dd($input);

		$updateData = User::find($id);
        $input['demote_class'] = 0;
        $input['section_id'] = $input['section_id'];
        $input['assign_class'] = 2;
        $input['promote_class'] = 2;
		$updateData->update($input);

        // =============
        $stuId = $updateData->id;
        $stuSessionId = $updateData->session_id;
        $stuClassId = $updateData->promote_class;
        $stuSectionId = $updateData->section_id;

        // dd($stuSectionId);

        // if($stuClassId == 2){

            // $checkStudentAtClassTwo = ClassTwoStudentRecord::where('student_id', $stuId)->get();

            // $countCheckStudentAtClassTwo = $checkStudentAtClassTwo->count();

            // dd($countCheckStudentAtClassTwo);

            // if($countCheckStudentAtClassTwo <= 0){
                
                $data['student_id'] = $stuId;

                $data['session_id'] = $stuSessionId;
    
                $data['promote_class_id'] = $stuClassId;

                $data['section_id'] = $stuSectionId;

                // $data['promote_status'] = 1;
    
                ClassTwoStudentRecord::create($data);

                toastr()->success('Created with new record into class Two');

                // }else{

                //     $lastClassRecordStatus = ClassTwoStudentRecord::where('student_id', $stuId)
                //     ->latest('promote_status')
                //     ->first();

                //     $lastClassRecordStatus = $lastClassRecordStatus['promote_status'] + 1 ;

                //     $data['student_id'] = $stuId;

                //     $data['session_id'] = $stuSessionId;
        
                //     $data['promote_class_id'] = $stuClassId;
    
                //     $data['promote_status'] = $lastClassRecordStatus;
        
                //     ClassTwoStudentRecord::create($data);

                //     // dd($lastClassRecordStatus);

                //     toastr()->error('Already have preview record into class One');

                // }


        // }


        // =============



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

        // dd($input);

        $promoteSection = $input['section_id'];

        if(!empty($promoteSection)){
            
            $allClassOneStudents = User::whereHas('roles', function ($query){
                $query->where('name', 'Student');
    
            })->where('assign_class', 1)
            ->where('promote_class', 1)
            ->where('demote_class', 0)
            ->get();
    
            // dd(count($allClassOneStudents));
    
            if(count($allClassOneStudents) == 0){
    
                toastr()->error('No one to promote class One to Two');
    
                return redirect()->route('class-one-wise-students.index');
            }
            
            foreach ($allClassOneStudents as $student) {
                $student->assign_class = 2;
                $student->promote_class = 2;
                $student->section_id = $promoteSection;
                
                $student->save(); // Save the changes to the database
            }
            
        // =====================
            foreach($allClassOneStudents as $stu){

                $input = ['student_id' => $stu->id , 'session_id' => $stu->session_id , 'promote_class_id' => $stu->promote_class, 'section_id' => $stu->section_id];

                ClassTwoStudentRecord::create($input);
            }
            toastr()->success('Created with new record into class Two');
        // =====================
    
            // dd($allClassOneStudents);
    
            toastr()->success('Class One all students promoted class One to Two successfully');
    
            return redirect()->route('class-one-wise-students.index');

        }

        $allClassOneStudents = User::whereHas('roles', function ($query){
            $query->where('name', 'Student');

        })->where('assign_class', 1)
        ->where('promote_class', 1)
        ->where('demote_class', 0)
        ->get();

        // dd(count($allClassOneStudents));

        if(count($allClassOneStudents) == 0){

            toastr()->error('No one to promote class One to Two');

            return redirect()->route('class-one-wise-students.index');
        }
        
        foreach ($allClassOneStudents as $student) {
            $student->assign_class = 2;
            $student->promote_class = 2;
            $student->section_id = $student->section_id;
            
            $student->save(); // Save the changes to the database
        }

        // =====================

        foreach($allClassOneStudents as $stu){

            $input = ['student_id' => $stu->id , 'session_id' => $stu->session_id , 'promote_class_id' => $stu->promote_class,'section_id' => $stu->section_id];

            ClassTwoStudentRecord::create($input);
        }
        toastr()->success('Created with new record into class Two');

        // =====================
        // dd($allClassOneStudents);

        toastr()->success('Class One all students promoted class One to Two successfully');

        return redirect()->route('class-one-wise-students.index');

    }


    public function selectedWisePromoteStudents( Request $request ){
        
        $studentIds = $request->ids;

        $sectionId = $request->section;

        if(!empty($sectionId) && !empty($studentIds)) {

            $allClassOneStudents = User::whereIn('id', $studentIds)->get();

            foreach ($allClassOneStudents as $student) {
                $student->assign_class = 2;
                $student->promote_class = 2;
                $student->section_id = $sectionId;
                $student->demote_class = 0;
                
                $student->save(); // Save the changes to the database
            }

            // =====================
            foreach($allClassOneStudents as $stu){

                $input = ['student_id' => $stu->id , 'session_id' => $stu->session_id , 'promote_class_id' => $stu->promote_class,'section_id' => $stu->section_id];
    
                ClassTwoStudentRecord::create($input);
            }
            // =====================

            // toastr()->success('Created with new record into class One');
    
            // $message = array('message' => 'Selected Students Promotes Successfully');
            // return response()->json($message);

            $totalStudentsCount = User::whereHas('roles', function($query){
                $query->where('name', 'Student');
            })->where('assign_class', 1)
            ->where('promote_class', 1)
            ->count();
    
            $totalDemotedStudentsCount = User::whereHas('roles', function($query){
                $query->where('name', 'Student');
            })->where('assign_class', 1)
            ->where('promote_class', 1)
            ->where('demote_class', 1)
            ->count();
    
            return response()->json(['message' => 'Selected Students Promoted Successfully and also Created with new record into class Two', 'totalStudentsCount' => $totalStudentsCount, 'totalDemotedStudentsCount' => $totalDemotedStudentsCount]);
    
        }

        $allClassOneStudents = User::whereIn('id', $studentIds)->get();

        foreach ($allClassOneStudents as $student) {
            $student->assign_class = 2;
            $student->promote_class = 2;
            $student->section_id = $student->section_id;
            $student->demote_class = 0;
            
            $student->save(); // Save the changes to the database
        }

        // =====================
        foreach($allClassOneStudents as $stu){

            $input = ['student_id' => $stu->id , 'session_id' => $stu->session_id , 'promote_class_id' => $stu->promote_class,'section_id' => $stu->section_id];

            ClassTwoStudentRecord::create($input);
        }
        // =====================


        // $message = array('message' => 'Selected Students Promotes Successfully');
        // return response()->json($message);



        // ==================
        $totalStudentsCount = User::whereHas('roles', function($query){
            $query->where('name', 'Student');
        })->where('assign_class', 1)
        ->where('promote_class', 1)
        ->count();

        $totalDemotedStudentsCount = User::whereHas('roles', function($query){
            $query->where('name', 'Student');
        })->where('assign_class', 1)
        ->where('promote_class', 1)
        ->where('demote_class', 1)
        ->count();

        return response()->json(['message' => 'Selected Students Promoted Successfully and also Created with new record into class Two', 'totalStudentsCount' => $totalStudentsCount, 'totalDemotedStudentsCount' => $totalDemotedStudentsCount]);

        // ======================

        
        // if(!empty($studentIds)){

            // $allClassOneStudents = User::whereIn('id', $studentIds)->get();

            // foreach ($allClassOneStudents as $student) {
            //     $student->assign_class = 2;
            //     $student->promote_class = 2;
            //     $student->section_id = $student->section_id;
            //     $student->demote_class = 0;
                
            //     $student->save(); // Save the changes to the database
            // }
    
            // // return response()->json(["success" => "Students Promotes Successfully"]);

            // $message = array('message' => 'Selected Students Promotes Successfully');
            // return response()->json($message);
        // }

        // return response()->json(["success" => "No Student Selected"]);


    }


}
