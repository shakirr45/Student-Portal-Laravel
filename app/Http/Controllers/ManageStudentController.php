<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\ManageStudent;
use App\Http\Requests\StoreManageStudentRequest;
use App\Http\Requests\UpdateManageStudentRequest;
use App\Models\User;
use App\Models\ClassSection;
use App\Models\InstitutionClass;
use Hash;
use Illuminate\Support\Arr;
use DB;


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
        ->with(['InstitutionClass'])
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

        // dd($institutionClass);

        return view('manage-students.create',compact('institutionClass','classSection'));
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
            'mobile_no' => 'required|unique:users,mobile_no',
            'password' => 'required|same:confirm-password',
            'assign_class' => 'required',
            'section_id' => 'required',

        ]);


        $input = $request->all();

        // $input['assign_class'] = json_encode($input['assign_class']);

        $input['password'] = Hash::make($input['password']);

        $input['promote_class'] = $input['assign_class'];
    
        $user = User::create($input);
        $user->assignRole('Student');

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


        $institutionClassSelected =  !empty( $user->assign_class ) ? ( $user->assign_class ) : [];

        return view('manage-students.edit',compact('user','institutionClass','institutionClassSelected','classSections'));
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
            
            'mobile_no' => 'required|unique:users,mobile_no,'.$id,
            
            'password' => 'same:confirm-password',
            
            'assign_class' => 'required',
            
            'section_id' => 'required',
            
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }

        $input['promote_class'] = $input['assign_class'];
    
        $user = User::find($id);

        // $input['assign_class'] = json_encode($input['assign_class']);

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
