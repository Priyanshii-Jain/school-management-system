<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use App\Models\AssignSubject;

class AssignSubjectController extends Controller
{
    public function ViewAssignSubject(){
        //$data['alldata'] = AssignSubject::all();
        $data['alldata'] = AssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.setup.assign_subject.view_assign_subject',$data);

    } //End Method

    public function AddAssignSubject(){
        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.assign_subject.add_assign_subject',$data);

    } //End Method

    public function StoreAssignSubject(Request $request){
        $countsubject = count($request->subject_id);
        if ($countsubject !=Null) {
            for ($i=0; $i <$countsubject ; $i++) {
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_marks = $request->full_marks[$i]; 
                $assign_subject->passing_marks = $request->passing_marks[$i];
                $assign_subject->subjective_marks = $request->subjective_marks[$i];
                $assign_subject->save();
            } //End for loop
        } //End if statement

        $notification = array(
            'message' => 'Subject Assigned Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('assign.subject.view')->with($notification);

    } //End Method

    public function EditAssignSubject($class_id){
        $data['editData'] = AssignSubject::where('class_id',$class_id)->orderBy('subject_id','asc')->get();
        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.assign_subject.edit_assign_subject',$data);

    } //End Method

    public function UpdateAssignSubject(Request $request,$class_id){
        if ($request->subject_id == NULL) {
            $notification = array(
                'message' => 'Sorry You Did Not Select Any Subject',
                'alert-type' => 'error'
            );
            return redirect()->route('assign.subject.edit',$class_id)->with($notification);
        }
        else{
            $countsubject = count($request->subject_id);
            AssignSubject::where('class_id',$class_id)->delete();
            for ($i=0; $i <$countsubject ; $i++) {
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_marks = $request->full_marks[$i]; 
                $assign_subject->passing_marks = $request->passing_marks[$i];
                $assign_subject->subjective_marks = $request->subjective_marks[$i];
                $assign_subject->save();
            } //End for loop
            

        }
        $notification = array(
            'message' => 'Fee Amount Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('assign.subject.view')->with($notification);

    } //End Method

    public function AssignSubjectDetails($class_id){
        $data['detailsData'] = AssignSubject::where('class_id',$class_id)->orderBy('subject_id','asc')->get();
        return view('backend.setup.assign_subject.assign_subject_details',$data);

    } //End Method
}
