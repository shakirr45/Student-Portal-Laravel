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


        $data = User::where('assign_class', 1)
        ->where($serchCondition)
        ->with(['institutionClass'])
        ->paginate(2);
  
        if($request->ajax()){
			
			return view('class-wise-students.one.index-pagination',['data' => $data]); 
        }
		
        return view('class-wise-students.one.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 2);
    }
    
    
}
