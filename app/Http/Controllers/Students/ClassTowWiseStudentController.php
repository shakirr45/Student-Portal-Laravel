<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClassTowWiseStudentController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:manage-class-tow-students', ['only' => ['index','promoteClass','demoteClass','PromoteAllStudents','selectedPromote']]);
    }
}
