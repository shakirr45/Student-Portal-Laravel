<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;

class SessionController extends Controller
{
    //
    public function index(){

        $sessions = Session::paginate(10);

        return view('sessions.index',compact('sessions'));

    }
}
