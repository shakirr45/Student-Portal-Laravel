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
use Carbon\Carbon;

  
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



            $currentUserClass = !empty(Auth::user()->assign_class) ? Auth::user()->assign_class : "";

            $currentUserId = !empty(Auth::user()->id) ? Auth::user()->id : "";

            $currentUserSectionId = !empty(Auth::user()->section_id) ? Auth::user()->section_id : "" ;

            $currentUserClass = !empty($currentUserClass) ? json_decode($currentUserClass) : " ";
            

        // $currentDate = Carbon::now();
        $currentDate = Carbon::now()->setTimezone('Asia/Dhaka');
        $dayOfWeekForToday = $currentDate->format('l'); // Get the current day of the week in full lowercase (e.g., "sunday")

            // dd($dayOfWeekForToday);

            $currentLoginRoleInfo = Auth::user()->roles()->get()->toArray();
			$currentLoginRoleInfo = !empty($currentLoginRoleInfo[0]['name']) ? $currentLoginRoleInfo[0]['name'] : '' ;

            // dd($currentLoginRoleInfo);

            // For students ===========>
            $saturdaysdata = ClassAssign::where('class_id', $currentUserClass)
            ->where('section_id', $currentUserSectionId)
            ->where('days', 'Saturday')
            ->get();
            $sundaysdata = ClassAssign::where('class_id', $currentUserClass)
            ->where('section_id', $currentUserSectionId)
            ->where('days', 'Sunday')
            ->get();
            $mondaysdata = ClassAssign::where('class_id', $currentUserClass)
            ->where('section_id', $currentUserSectionId)
            ->where('days', 'Monday')
            ->get();
            $tuesdaysdata = ClassAssign::where('class_id', $currentUserClass)
            ->where('section_id', $currentUserSectionId)
            ->where('days', 'Tuesday')
            ->get();
            $wednesdaysdata = ClassAssign::where('class_id', $currentUserClass)
            ->where('section_id', $currentUserSectionId)
            ->where('days', 'Wednesday')
            ->get();
            $thursdaysdata = ClassAssign::where('class_id', $currentUserClass)
            ->where('section_id', $currentUserSectionId)
            ->where('days', 'Thursday')
            ->get();
            $fridaysdata = ClassAssign::where('class_id', $currentUserClass)
            ->where('section_id', $currentUserSectionId)
            ->where('days', 'Friday')
            ->get();


            // For Teachers ===========>

            $saturdaysdataForTeachers = ClassAssign::where('user_id', $currentUserId)
            ->where('days', 'Saturday')
            ->get();
            $sundaysdataForTeachers = ClassAssign::where('user_id', $currentUserId)
            ->where('days', 'Sunday')
            ->get();
            $mondaysdataForTeachers = ClassAssign::where('user_id', $currentUserId)
            ->where('days', 'Monday')
            ->get();
            $tuesdaysdataForTeachers = ClassAssign::where('user_id', $currentUserId)
            ->where('days', 'Tuesday')
            ->get();
            $wednesdaysdataForTeachers = ClassAssign::where('user_id', $currentUserId)
            ->where('days', 'Wednesday')
            ->get();
            $thursdaysdataForTeachers = ClassAssign::where('user_id', $currentUserId)
            ->where('days', 'Thursday')
            ->get();
            $fridaysdataForTeachers = ClassAssign::where('user_id', $currentUserId)
            ->where('days', 'Friday')
            ->get();




        if($currentLoginRoleInfo == "Student"){


            $studentWiseClassShow = ClassAssign::where('class_id', $currentUserClass)
            ->where('section_id', $currentUserSectionId)
            ->with(['institutionClass'])
            ->with(['userList'])
            ->get();

                
        if($dayOfWeekForToday == "Saturday"){

            $currentDateDaysdata = ClassAssign::where('class_id', $currentUserClass)
            ->where('section_id', $currentUserSectionId)
            ->where('days', 'Saturday')
            ->get();


        }elseif($dayOfWeekForToday == "Sunday"){

            $currentDateDaysdata = ClassAssign::where('class_id', $currentUserClass)
            ->where('section_id', $currentUserSectionId)
            ->where('days', 'Sunday')
            ->get();

        }elseif($dayOfWeekForToday == "Monday"){

            $currentDateDaysdata = ClassAssign::where('class_id', $currentUserClass)
            ->where('section_id', $currentUserSectionId)
            ->where('days', 'Monday')
            ->get();

        }elseif($dayOfWeekForToday == "Tuesday"){

            $currentDateDaysdata = ClassAssign::where('class_id', $currentUserClass)
            ->where('section_id', $currentUserSectionId)
            ->where('days', 'Tuesday')
            ->get();

        }elseif($dayOfWeekForToday == "Wednesday"){

            $currentDateDaysdata = ClassAssign::where('class_id', $currentUserClass)
            ->where('section_id', $currentUserSectionId)
            ->where('days', 'Wednesday')
            ->get();

        }elseif($dayOfWeekForToday == "Thursday"){

            $currentDateDaysdata = ClassAssign::where('class_id', $currentUserClass)
            ->where('section_id', $currentUserSectionId)
            ->where('days', 'Thursday')
            ->get();

            // dd($thursdayWiseClass->toArray());

        }elseif($dayOfWeekForToday == "Friday"){

            $currentDateDaysdata = ClassAssign::where('class_id', $currentUserClass)
            ->where('section_id', $currentUserSectionId)
            ->where('days', 'Friday')
            ->get();

        }else{
            return "No Data";
        }
        return view('students.index', compact('studentWiseClassShow','currentDateDaysdata','dayOfWeekForToday','saturdaysdata','sundaysdata','mondaysdata','tuesdaysdata','wednesdaysdata','thursdaysdata','fridaysdata'));


        }elseif($currentLoginRoleInfo == "Teacher"){

            $teachertWiseClassShow = ClassAssign::where('user_id', $currentUserId)
            ->with(['institutionClass'])
            ->with(['classSection'])
            ->get();

            $currentDateDaysClass = ClassAssign::where('user_id', $currentUserId)
            ->with(['institutionClass'])
            ->with(['classSection'])
            ->where('days', $dayOfWeekForToday)
            ->get();

            // dd($sundaysdata);

            return view('teachers.index',compact('teachertWiseClassShow','dayOfWeekForToday','currentDateDaysClass','saturdaysdataForTeachers','sundaysdataForTeachers','mondaysdataForTeachers','tuesdaysdataForTeachers','wednesdaysdataForTeachers','thursdaysdataForTeachers','fridaysdataForTeachers'));

        }elseif($currentLoginRoleInfo == "Headmaster"){
            return view('home');
        }

            toastr()->success('You have Successfully loggedin');

            // return redirect()->route('dashboard');
            return view('dashboard');

            
        }
  
        toastr()->success('Oppes! You have entered invalid credentials');

        return redirect()->route('student-login');
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