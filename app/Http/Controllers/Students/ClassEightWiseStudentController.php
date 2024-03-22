<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClassEightWiseStudentController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:manage-class-eight-students', ['only' => ['index','singleStudentpromoteClass','studentWiseDemoteClass','promoteAllStudents','selectedWisePromoteStudents']]);
    }
}
