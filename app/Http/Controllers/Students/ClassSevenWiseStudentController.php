<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClassSevenWiseStudentController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:manage-class-seven-students', ['only' => ['index','singleStudentpromoteClass','studentWiseDemoteClass','promoteAllStudents','selectedWisePromoteStudents']]);
    }
}
