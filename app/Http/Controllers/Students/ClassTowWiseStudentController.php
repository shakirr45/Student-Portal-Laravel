<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InstitutionClass;
use App\Models\ClassSection;

class ClassTowWiseStudentController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:manage-class-tow-students', ['only' => ['index','promoteClass','demoteClass','PromoteAllStudents','selectedPromote']]);
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

        })->where('assign_class', 2)
        ->where('promote_class', 2)
        ->where($serchCondition)
        ->with(['institutionClass'])
        ->paginate(10);

        $institutionClass = InstitutionClass::dataList();

        $classSection = ClassSection::dataList();

        // For count class wise ==============>
        $totalStudentsCount = User::whereHas('roles', function($query){
            $query->where('name', 'Student');
        })->where('assign_class', 2)
        ->where('promote_class', 2)
        ->count();

        $totalDemotedStudentsCount = User::whereHas('roles', function($query){
            $query->where('name', 'Student');
        })->where('assign_class', 2)
        ->where('promote_class', 2)
        ->where('demote_class', 1)
        ->count();

        // dd($totalDemotedStudentsCount);

        if($request->ajax()){
			
			return view('class-wise-students.tow.index-pagination',['data' => $data, 'institutionClass' => $institutionClass,'classSection' => $classSection]); 
            
        }
		
        return view('class-wise-students.tow.index',compact('data','institutionClass','classSection','totalStudentsCount','totalDemotedStudentsCount'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function singleStudentpromoteClass( Request $request, $id ){

        $this->validate($request, [

            'promote_class' => 'required',

        ]);

        $input = $request->all();

        // dd($input);

		$updateData = User::find($id);
        $input['demote_class'] = 0;
        $input['section_id'] = $input['section_id'];
        $input['assign_class'] = $input['promote_class'];
		$updateData->update($input);

        toastr()->success('Class Tow student promoted class Three successfully');

        return redirect()->route('class-tow-wise-students.index');

    }

    public function studentWiseDemoteClass( Request $request, $id ){

        $updateData = User::find($id);

        $input['demote_class'] = 1;

		$updateData->update($input);
        
        toastr()->success('Class Tow student demoted successfully');

        return redirect()->route('class-tow-wise-students.index');
    }

    public function promoteAllStudents( Request $request ){

        $input = $request->all();

        $promoteSection = $input['section_id'];

        // dd($promoteSection);

        $allClassOneStudents = User::whereHas('roles', function ($query){
            $query->where('name', 'Student');

        })->where('assign_class', 2)
        ->where('promote_class', 2)
        ->where('demote_class', 0)
        ->get();

        // dd(count($allClassOneStudents));


        if(count($allClassOneStudents) == 0){

            toastr()->error('No one to promote class Tow to Three');

            return redirect()->route('class-tow-wise-students.index');
        }
        
        foreach ($allClassOneStudents as $student) {
            $student->assign_class = 3;
            $student->promote_class = 3;
            $student->section_id = $promoteSection;
            
            $student->save(); // Save the changes to the database
        }

        // dd($allClassOneStudents);

        toastr()->success('Class Tow all students promoted class Tow to Three successfully');

        return redirect()->route('class-tow-wise-students.index');

    }

    public function selectedWisePromoteStudents( Request $request ){
        
        $studentIds = $request->ids;

        $sectionId = $request->section;

        if(!empty($sectionId) && !empty($studentIds)) {

            $allClassOneStudents = User::whereIn('id', $studentIds)->get();

            foreach ($allClassOneStudents as $student) {
                $student->assign_class = 3;
                $student->promote_class = 3;
                $student->section_id = $sectionId;
                $student->demote_class = 0;
                
                $student->save(); // Save the changes to the database
            }
    
            $message = array('message' => 'Selected Students Promotes Successfully');
            return response()->json($message);
        }

        $allClassOneStudents = User::whereIn('id', $studentIds)->get();

        foreach ($allClassOneStudents as $student) {
            $student->assign_class = 3;
            $student->promote_class = 3;
            $student->section_id = $student->section_id;
            $student->demote_class = 0;
            
            $student->save(); // Save the changes to the database
        }

        // return response()->json(["success" => "Students Promotes Successfully"]);

        $message = array('message' => 'Selected Students Promotes Successfully');
        return response()->json($message);

    }


}
