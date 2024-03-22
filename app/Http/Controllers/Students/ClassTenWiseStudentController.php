<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClassTenWiseStudentController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:manage-class-ten-students', ['only' => ['index','singleStudentpromoteClass','studentWiseDemoteClass','promoteAllStudents','selectedWisePromoteStudents']]);
    }
}
