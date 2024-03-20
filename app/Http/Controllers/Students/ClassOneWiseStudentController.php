<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class ClassOneWiseStudentController extends Controller
{
    public function index(Request $request)
    {

        $serchCondition  = [];

        if(!empty($request->user_id)){

            $serchCondition['user_id'] = $request->user_id;
        }
        if(!empty($request->final_result)){

            $serchCondition['final_result'] = $request->final_result;
        }

        // $data = User::where('assign_class', 1)
        // ->where('promote_class', 1)
        // ->where($serchCondition)
        // ->with(['institutionClass'])
        // ->paginate(10);

        $data = User::whereHas('roles', function ($query){
            $query->where('name', 'Student');

        })->where('assign_class', 1)
        ->where('promote_class', 1)
        ->where($serchCondition)
        ->with(['institutionClass'])
        ->paginate(10);

        if($request->ajax()){
			
			return view('class-wise-students.one.index-pagination',['data' => $data]); 
        }
		
        return view('class-wise-students.one.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    
    public function promoteClass( Request $request, $id ){

        $this->validate($request, [

            'promote_class' => 'required',

        ]);

        $input = $request->all();

        // dd($input);

		$updateData = User::find($id);
        $input['demote_class'] = 0;
        $input['section_id'] = 0;
        $input['assign_class'] = $input['promote_class'];
		$updateData->update($input);

        return redirect()->route('class-one-wise-students.index')
        ->with('success','Class One Student Promoted successfully');


    }

    public function deomoteClass( Request $request, $id ){

        $updateData = User::find($id);

        $input['demote_class'] = 1;

		$updateData->update($input);

        return redirect()->route('class-one-wise-students.index')
        ->with('success','Class One Student Demoted successfully');
    }


    public function SelectedPromoteClass(){

        $allClassOneStudents = User::whereHas('roles', function ($query){
            $query->where('name', 'Student');

        })->where('assign_class', 1)
        ->where('promote_class', 1)
        ->where('demote_class', 0)
        ->get();
        
        foreach ($allClassOneStudents as $student) {
            $student->assign_class = 2;
            $student->promote_class = 2;
            $student->section_id = 0;

            $student->save(); // Save the changes to the database
        }

        // dd($allClassOneStudents);

        return redirect()->route('class-one-wise-students.index')
        ->with('success','Class One Student Promoted successfully');

    }




    
    // public function destroy( $id ){

    //     User::find($id)->delete();

    //     return redirect()->route('class-one-wise-students.index')
    //     ->with('success','Class One Student Deleted successfully');
    // }
    
}
