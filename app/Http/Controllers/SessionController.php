<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;

class SessionController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:session-list', ['only' => ['index']]);
         $this->middleware('permission:session-delete', ['only' => ['destroy']]);
    }
    public function index(){

        // $sessions = Session::paginate(10);
        $sessions = Session::orderBy('id', 'DESC')->paginate(10);


        return view('sessions.index',compact('sessions'));

    }

    public function store(Request $request){

        $this->validate($request, [

            'session' => 'required|size:9|unique:sessions',
            
            'session_year' => 'required|size:4|unique:sessions',

        ],
        ['session.required'=>"session is required",
        'session.unique' => "session allready exixts",
        'session.size' => "Session must be 9 characters long",

        'session_year.required'=>"session year is required",
        'session_year.unique'=>"session year allready exixts",
        'session_year.size' => "Session year must be 4 characters long",
      ]
    );
    
        

        $input = $request->all();

        $session = Session::create($input);


        return response()->json(['status' => 'success','message' => 'Session created Successfully']);

        // return response()->json([
        //     'status' => 'success',
        //    ]);
    }

    public function destroy( Request $request ){

        $session_id = $request->session_id;

        $data = Session::find($session_id);

        $data->delete();

        return response()->json(['status' => 'success','message' => 'Session deleted Successfully']);

        // return response()->json([
        //     'status' => 'success',
        //    ]);    
        
        }

}
