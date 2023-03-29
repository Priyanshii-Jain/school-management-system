<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentShift;

class StudentShiftController extends Controller
{
    public function ViewStudentShift(){
        $data['alldata'] = StudentShift::all();
        return view('backend.setup.shift.view_shift',$data);
    } //End Method

    public function AddStudentShift(){
        //$data['alldata'] = StudentClass::all();
        return view('backend.setup.shift.add_shift');
    } //End Method

    public function StoreStudentShift(Request $request){

        $validatedData = $request->validate([
    		'name' => 'required|unique:student_shifts,name',	
    	]);

        $data = new StudentShift();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Shift Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.shift.view')->with($notification);
    } //End Method

    public function EditStudentShift($id){

        $editdata = StudentShift::find($id);
        return view('backend.setup.shift.edit_student_shift',compact('editdata'));

    } //End Method

    public function UpdateStudentShift(Request $request,$id){
        $data = StudentShift::find($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:student_shifts,name',
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Shift Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.shift.view')->with($notification);
    } //End Method

    public function DeleteStudentShift($id){
        $user = StudentShift::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Student Shift Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('student.shift.view')->with($notification);
    } //End Method
}
