<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\InstitutionClass;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Carbon\Carbon;


class UserController extends Controller
{    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')
        ->with(['InstitutionClass'])
        ->with(['classSection'])
        ->paginate(5);

        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institutionClass = InstitutionClass::dataList();

        $roles = Role::pluck('name','name')->all();

        return view('users.create',compact('roles','institutionClass'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',

            'email' => 'required|email|unique:users,email',

            'user_id' => 'required|unique:users,user_id',

            'mobile_no' => 'required|unique:users,mobile_no',

            'password' => 'required|same:confirm-password',

            'roles' => 'required'

        ]);

       
        $input = $request->all();
        
        // $input['assign_class'] = json_encode($input['assign_class']);

        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $user = User::find($id);

        $user = User::where('id',$id)
        ->with(['InstitutionClass'])
        ->with(['classSection'])->first();

        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::find($id);

        $institutionClass = InstitutionClass::dataList();

        // $institutionClassSelected =  !empty( $user->assign_class ) ? json_decode( $user->assign_class ) : [];
        $institutionClassSelected =  !empty( $user->assign_class ) ? ( $user->assign_class ) : [];

        $roles = Role::pluck('name','name')->all();

        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole','institutionClass','institutionClassSelected'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            
            'email' => 'required|email|unique:users,email,'.$id,
            
            'user_id' => 'required|unique:users,user_id,'.$id,
            
            'mobile_no' => 'required|unique:users,mobile_no,'.$id,
            
            'password' => 'same:confirm-password',
            
            'roles' => 'required'
            
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
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}