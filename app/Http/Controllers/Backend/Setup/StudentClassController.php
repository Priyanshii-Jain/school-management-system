<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;

class StudentClassController extends Controller
{
    public function ViewStudent(){
        $data['alldata'] = StudentClass::all();
        return view('backend.setup.student_class.view_class',$data);
    } //End Method

    public function AddStudentClass(){
        //$data['alldata'] = StudentClass::all();
        return view('backend.setup.student_class.add_class');
    } //End Method

    public function StoreStudentClass(Request $request){

        $validatedData = $request->validate([
    		'name' => 'required|unique:student_classes,name',	
    	]);

        $data = new StudentClass();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Class Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.class.view')->with($notification);
    } //End Method

    public function EditStudentClass($id){

        $editdata = StudentClass::find($id);
        return view('backend.setup.student_class.edit_student_class',compact('editdata'));

    } //End Method

    public function UpdateStudentClass(Request $request,$id){
        $data = StudentClass::find($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:student_classes,name'.$data->id
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Class Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.class.view')->with($notification);
    } //End Method

    public function DeleteStudentClass($id){
        $user = StudentClass::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Student Class Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('student.class.view')->with($notification);
    } //End Method
}
