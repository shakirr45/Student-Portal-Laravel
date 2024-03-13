<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
use App\Models\ClassAssign;
use App\Models\ClassWiseSubjectAssign;

  
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('students.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('students.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'password' => 'required',
        ]);

        $input = $request->all();

            // $credentials = $request->only('email', 'password');
            // if (Auth::attempt($credentials)) {
            if( Auth::attempt(['mobile_no' => $input['user_id'], 'password' => $input['password']]) ||
            Auth::attempt(['user_id' => $input['user_id'], 'password' => $input['password']]) ||
            Auth::attempt(['email' => $input['user_id'], 'password' => $input['password']])) {

            //  return redirect()->route('dashboard');
            $currentLoginRoleInfo = Auth::user()->roles()->get()->toArray();
			$currentLoginRoleInfo = !empty($currentLoginRoleInfo[0]['name']) ? $currentLoginRoleInfo[0]['name'] : '' ;

            // dd($currentLoginRoleInfo);

            // if($currentLoginRoleInfo == "Student"){

            // }

            $currentUserClass = !empty(Auth::user()->assign_class) ? Auth::user()->assign_class : "";

            $currentUserSectionId = !empty(Auth::user()->section_id) ? Auth::user()->section_id : "" ;

            $currentUserClass = !empty($currentUserClass) ? json_decode($currentUserClass) : " ";

            $studentWiseClassShow = ClassWiseSubjectAssign::where('class_assign_id', $currentUserClass)
            ->where('section_assign_id', $currentUserSectionId)
            ->get();


            // $studentWiseClassShow = ClassWiseSubjectAssign::where('class_assign_id', $currentUserClass)
            // ->with(['classAssign'])
            // ->get();


            // dd($studentWiseClassShow);

            // $studentWiseClassSubject = !empty($studentWiseClassShow->subjects) ? $studentWiseClassShow->subjects : " ";

            // dd($data = $studentWiseClassShow->toArray());

            // $data = $studentWiseClassShow->toArray();

            // foreach($data as $d){

            //     $reArrangeSIAndAsiUsers[$d['id']] = $d['subjects'];

            // }
            // dd($reArrangeSIAndAsiUsers);

            // return view('dashboard',compact('studentWiseClassShow'))->withSuccess('You have Successfully loggedin');

            // return redirect()->intended('dashboard')
            // ->withSuccess('You have Successfully loggedin');


            // return redirect()->intended('dashboard')->with(compact('currentUserClass'))->withSuccess('You have Successfully logged in');

            return view('dashboard', compact('studentWiseClassShow'));


        }
  
        return redirect("student-login")->withSuccess('Oppes! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('student-login');
    }
}