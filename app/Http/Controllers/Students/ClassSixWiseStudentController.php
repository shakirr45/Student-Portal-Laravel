<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClassSixWiseStudentController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:manage-class-six-students', ['only' => ['index','singleStudentpromoteClass','studentWiseDemoteClass','promoteAllStudents','selectedWisePromoteStudents']]);
    }
}
