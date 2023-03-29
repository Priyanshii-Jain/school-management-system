<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
    public function ViewStudentGroup(){
        $data['alldata'] = StudentGroup::all();
        return view('backend.setup.group.view_group',$data);
    } //End Method

    public function AddStudentGroup(){
        //$data['alldata'] = StudentClass::all();
        return view('backend.setup.group.add_group');
    } //End Method

    public function StoreStudentGroup(Request $request){

        $validatedData = $request->validate([
    		'name' => 'required|unique:student_groups,name',	
    	]);

        $data = new StudentGroup();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Group Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.group.view')->with($notification);
    } //End Method

    public function EditStudentGroup($id){

        $editdata = StudentGroup::find($id);
        return view('backend.setup.group.edit_student_group',compact('editdata'));

    } //End Method

    public function UpdateStudentGroup(Request $request,$id){
        $data = StudentGroup::find($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:student_groups,name',
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Group Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.group.view')->with($notification);
    } //End Method

    public function DeleteStudentGroup($id){
        $user = StudentGroup::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Student Group Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('student.group.view')->with($notification);
    } //End Method
}
