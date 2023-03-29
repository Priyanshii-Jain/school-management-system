<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;

class StudentYearController extends Controller
{
    public function ViewStudentYear(){
        $data['alldata'] = StudentYear::all();
        return view('backend.setup.year.view_year',$data);
    } //End Method

    public function AddStudentYear(){
        //$data['alldata'] = StudentClass::all();
        return view('backend.setup.year.add_year');
    } //End Method

    public function StoreStudentYear(Request $request){

        $validatedData = $request->validate([
    		'name' => 'required|unique:student_years,name',	
    	]);

        $data = new StudentYear();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Year Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.year.view')->with($notification);
    } //End Method

    public function EditStudentYear($id){

        $editdata = StudentYear::find($id);
        return view('backend.setup.year.edit_student_year',compact('editdata'));

    } //End Method

    public function UpdateStudentYear(Request $request,$id){
        $data = StudentYear::find($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name',
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Year Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.year.view')->with($notification);
    } //End Method

    public function DeleteStudentYear($id){
        $user = StudentYear::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Student Year Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('student.year.view')->with($notification);
    } //End Method
}
