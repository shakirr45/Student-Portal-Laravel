<?php

namespace App\Http\Controllers\Classes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ClassAssign;


class ClassAssignForClassTwoController extends Controller
{
    //

     // function __construct()
    // {
    //      $this->middleware('permission:class-list|class-create|class-edit|class-delete', ['only' => ['index','show']]);
    //      $this->middleware('permission:class-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:class-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:class-delete', ['only' => ['destroy']]);
    // }
    //

    public function index()
    {
        $classes = ClassAssign::latest()
        ->where('class', 2)
        ->with(['institutionClass'])
        ->with(['classSection'])
        ->with(['userList'])
        ->with(['subjects'])
        ->paginate(5);

        // dd($classes);

        return view('class-assign.class-wise.two.index',compact('classes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
