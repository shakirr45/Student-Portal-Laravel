<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\testModel;
use App\Models\ClassAssign;
use App\Models\Subject;
use DB;

class testController extends Controller
{
    //

    public function index(){


        $date = Date('Y-m-d');

        $classAssign = Subject::with(['classAssign'])
        ->get()
        ->toArray();

        // $classAssign = Subject::whereHas('classAssign', function($q) as $date{
        //         $q->whereDate('created_at',  $date);
        //     }
        // )->get();

        dd($classAssign);






        $arrayData = [0,1,2];

        // dd($arrayData);

        // foreach ($arrayData as $s => $d) {
        //     echo 
        //     //    $d->cat_id . $d->child_cat . "<br>"
        //     $d . "<br>"
        //     ;

        // }

        $childData = DB::table('category')
        ->whereIn('cat_id',$arrayData)
        // ->orWhere('cat_id',2)
        ->distinct()
        ->pluck('child_cat')->toArray();

        foreach ($arrayData as $s => $d) {
            $array = [
                $d => $childData,
            ];
            
            echo '<pre>' . print_r($array, true) . '</pre>';

        }




        // foreach ($data as $s => $d) {
        //     echo 
        //        $d->cat_id . $d->child_cat . "<br>"
        //     ;

        // }
        







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
