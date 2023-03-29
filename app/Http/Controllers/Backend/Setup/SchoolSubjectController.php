<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolSubject;

class SchoolSubjectController extends Controller
{
    public function ViewSchoolSubject(){
        $data['alldata'] = SchoolSubject::all();
        return view('backend.setup.school_subject.view_school_subject',$data);
    } //End Method

    public function AddSchoolSubject(){
        //$data['alldata'] = StudentClass::all();
        return view('backend.setup.school_subject.add_school_subject');
    } //End Method

    public function StoreSchoolSubject(Request $request){

        $validatedData = $request->validate([
    		'name' => 'required|unique:school_subjects,name',	
    	]);

        $data = new SchoolSubject();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Subject Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('school.subject.view')->with($notification);
    } //End Method

    public function EditSchoolSubject($id){

        $editdata = SchoolSubject::find($id);
        return view('backend.setup.school_subject.edit_school_subject',compact('editdata'));

    } //End Method

    public function UpdateSchoolSubject(Request $request,$id){
        $data = SchoolSubject::find($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:school_subjects,name',
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Subject Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('school.subject.view')->with($notification);
    } //End Method

    public function DeleteSchoolSubject($id){
        $user = SchoolSubject::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Subject Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('school.subject.view')->with($notification);
    } //End Method
}
