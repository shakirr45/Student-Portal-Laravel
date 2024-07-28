<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\ManageClass;
use App\Http\Requests\StoreManageClassRequest;
use App\Http\Requests\UpdateManageClassRequest;

class ManageClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  function __construct()
    //  {
    //       $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
    //       $this->middleware('permission:product-create', ['only' => ['create','store']]);
    //       $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
    //       $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    //  }
    public function index()
    {
        //
        $manageClassData = ManageClass::with(['classSection'])
        ->with(['subjects'])
        ->with(['userList'])
        ->paginate(10);
        // dd($manageClassData);
        // return view('manage-class.index',compact('manageClassData'));


        return view('manage-class.index',compact('manageClassData'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreManageClassRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ManageClass $manageClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageClass $manageClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateManageClassRequest $request, ManageClass $manageClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageClass $manageClass)
    {
        //
    }
}
