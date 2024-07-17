<?php

namespace App\Http\Controllers;

use App\Models\ManageClass;
use App\Http\Requests\StoreManageClassRequest;
use App\Http\Requests\UpdateManageClassRequest;

class ManageClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('manage-class.index');
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
