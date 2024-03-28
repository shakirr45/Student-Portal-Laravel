<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;

class SessionController extends Controller
{
    // function __construct()
    // {
    //      $this->middleware('permission:class-list|class-create|class-edit|class-delete', ['only' => ['index','show']]);
    //      $this->middleware('permission:class-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:class-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:class-delete', ['only' => ['destroy']]);
    // }
    //
    public function index(){

        $sessions = Session::paginate(10);

        return view('sessions.index',compact('sessions'));

    }
}
