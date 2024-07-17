<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\ManageClassOne;
use App\Http\Requests\StoreManageClassOneRequest;
use App\Http\Requests\UpdateManageClassOneRequest;
use App\Models\ClassAssign;
use App\Models\ClassSection;
use App\Models\User;
use App\Models\Subject;
use App\Models\DayOfWeek;

class ManageClassOneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('manage-class.class-one.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $classAssign = ClassAssign::orderBy('id', 'ASC')
        ->where('class', 1)
        ->with(['subjects'])
        ->get()->toArray();

        // dd($classAssign);
            

        // $classSection = ClassSection::dataList();

        // $days = DayOfWeek::dataList();

        $subjects = Subject::dataList();

        // dd($subjects);

        // $isTeacher = User::whereHas('roles', function($q) {
        //     $q->where(function ($query) {
        //         $query->where('name', 'Teacher')
        //         ->orWhere('name', 'Headmaster');
        //     });
        // })->pluck('name', 'id')->toArray();

        // dd($isTeacher);
        
        return view('manage-class.class-one.create',compact('classAssign','subjects'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(ManageClassOne $manageClassOne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageClassOne $manageClassOne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateManageClassOneRequest $request, ManageClassOne $manageClassOne)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageClassOne $manageClassOne)
    {
        //
    }
}
