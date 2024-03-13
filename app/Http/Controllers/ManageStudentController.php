<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\ManageStudent;
use App\Http\Requests\StoreManageStudentRequest;
use App\Http\Requests\UpdateManageStudentRequest;
use App\Models\User;
use App\Models\ClassSection;

class ManageStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $studentDetails = User::latest()->paginate(5);
        return view('manage-students.index',compact('studentDetails'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $classSection = ClassSection::dataList();
        return view('manage-students.create',compact('classSection'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [

            'user_id' => 'required', 

            'section_id' => 'required',
			
        ]);

        $input = $request->input();

        $studentDetails = $request->all();

        $studentUserId = $studentDetails['user_id'];

        $findStudent = User::where('user_id', $studentUserId)->get()->toArray();

        if(!empty($findStudent)){

            $findStudentId = !empty($findStudent['0']['id']) ? $findStudent['0']['id'] : " ";

            $input['section_id'] = !empty($input['section_id']) ? $input['section_id'] : 0 ;

            $updateData = USer::find($findStudentId);
            $updateData->update($input);


            return redirect()->route('manage-students.index')
            ->with('success','Student Section Assign successfully');

        }
        dd("Data not Found");

    



    }

    /**
     * Display the specified resource.
     */
    public function show(ManageStudent $manageStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageStudent $manageStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateManageStudentRequest $request, ManageStudent $manageStudent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageStudent $manageStudent)
    {
        //
    }
}
