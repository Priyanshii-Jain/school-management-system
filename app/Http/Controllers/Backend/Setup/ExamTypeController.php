<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamType;

class ExamTypeController extends Controller
{
    public function ViewExamType(){
        $data['alldata'] = ExamType::all();
        return view('backend.setup.exam_type.view_exam_type',$data);
    } //End Method

    public function AddExamType(){
        //$data['alldata'] = StudentClass::all();
        return view('backend.setup.exam_type.add_exam_type');
    } //End Method

    public function StoreExamType(Request $request){

        $validatedData = $request->validate([
    		'name' => 'required|unique:exam_types,name',	
    	]);

        $data = new ExamType();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Exam Type Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('exam.type.view')->with($notification);
    } //End Method

    public function EditExamType($id){

        $editdata = ExamType::find($id);
        return view('backend.setup.exam_type.edit_exam_type',compact('editdata'));

    } //End Method

    public function UpdateExamType(Request $request,$id){
        $data = ExamType::find($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:exam_types,name',
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Exam Type Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('exam.type.view')->with($notification);
    } //End Method

    public function DeleteExamType($id){
        $user = ExamType::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Exam Type Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('exam.type.view')->with($notification);
    } //End Method
}
