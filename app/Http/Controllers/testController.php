<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\testModel;

class testController extends Controller
{
    //

    public function index(){

        $data = testModel::all();

        


        // dd($data);
        return view('test.index',compact('data'));
    }

    public function testDatSore(Request $request){

        $this->validate($request, [

            'name' => 'required',

            'address' => 'required',

            'number' => 'required|max:11|unique:test_models,number',

        ]);

        $input = $request->all();

        // dd($input);

        $user = testModel::create($input);
        toastr()->success('Data inserted successfully');

        return redirect()->back();
    }

    public function destroy( $id ){

        dd($id);

        $input = $request->all();

        testModel::find($id)->delete();


        toastr()->success('Data deleted successfully');

        return redirect()->back();
    }
}
