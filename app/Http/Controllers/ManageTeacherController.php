<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\ManageTeachers;
use App\Http\Requests\StoreManageTeachersRequest;
use App\Http\Requests\UpdateManageTeachersRequest;

use App\Models\User;
use App\Models\ClassSection;
use App\Models\InstitutionClass;
use Hash;
use Illuminate\Support\Arr;
use DB;

class ManageTeacherController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:manage-teacher-list|manage-teacher-create|manage-teacher-edit|manage-teacher-delete', ['only' => ['index','show']]);
         $this->middleware('permission:manage-teacher-create', ['only' => ['create','store']]);
         $this->middleware('permission:manage-teacher-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:manage-teacher-delete', ['only' => ['destroy']]);
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
        

        $manageTeachers = User::whereHas('roles', function ($query){
            $query->where('name', 'Teacher');
        })
        ->where($serchCondition)
        ->latest()->paginate(5);

    // Check if no students are found
    if ($manageTeachers->isEmpty()) {

        return view('manage-teachers.index')->with('noDataFound', true);
    }

    return view('manage-teachers.index', compact('manageTeachers'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $institutionClass = InstitutionClass::dataList();

        $classSection = ClassSection::dataList();

        // dd($institutionClass);

        return view('manage-teachers.create',compact('institutionClass','classSection'));
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

        ]);

       
        

        $input = $request->all();
        // $input['assign_class'] = json_encode($input['assign_class']);

        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole('Teacher');

        toastr()->success('Teachers created successfully');

        return redirect()->route('manage-teachers.index');

    }

    /**
     * Display the specified resource.
     */
    public function show( $teacherId )
    {
        $manageTeachers = User::where('id',$teacherId)
        ->first();
        
        // dd($manageTeachers->toArray());

        return view('manage-teachers.show',compact('manageTeachers'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $user = User::find($id);

        $institutionClass = InstitutionClass::dataList();

        $classSections = ClassSection::dataList();

        $institutionClassSelected =  !empty( $user->assign_class ) ? ( $user->assign_class ) : [];

        return view('manage-teachers.edit',compact('user','institutionClass','institutionClassSelected','classSections'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'name' => 'required',

            'email' => 'required|email|unique:users,email,'.$id,

            'user_id' => 'required|unique:users,user_id,'.$id,

            'mobile_no' => 'required|max:11|unique:users,mobile_no,'.$id,

            'password' => 'same:confirm-password',

        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);

        // $input['assign_class'] = json_encode($input['assign_class']);

        $user->update($input);
        
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole('Teacher');

        toastr()->success('Teachers updated successfully');

        return redirect()->route('manage-teachers.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        toastr()->success('Teachers deleted successfully');

        return redirect()->route('manage-teachers.index');
    }
}
