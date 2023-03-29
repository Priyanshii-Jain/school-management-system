<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\User;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentYear;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use DB;
use PDF;

class StudentRegistrationController extends Controller
{
    public function ViewStudentRegistration(){
        $data['classes'] = StudentClass::all();
        $data['years'] = StudentYear::all();
        $data['year_id'] = StudentYear::orderBy('id','desc')->first()->id;
        $data['class_id'] = StudentClass::orderBy('id','desc')->first()->id;
        $data['allData'] = AssignStudent::where('year_id',$data['year_id'])->where('class_id',$data['class_id'])->get();
        return view('backend.student.student_registration.student_view',$data);
    } //End Method

    public function AddStudentRegistration(){
        $data['classes'] = StudentClass::all();
        $data['years'] = StudentYear::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        return view('backend.student.student_registration.add_student',$data);
    } //End Method

    public function StoreStudentRegistration(Request $request){
        DB::transaction(function() use($request){
            $checkYear = StudentYear::find($request->year_id)->name;
            $student = User::where('user_type','Student')->orderBy('id','DESC')->first();

            if ($student == null) {
                $firstReg = 0;
                $studentId = $firstReg+1;
                if ($studentId < 10) {
                    $id_no = '000'.$studentId;
                }
                elseif ($studentId < 100) {
                    $id_no = '00'.$studentId;
                }
                elseif ($student_id < 1000) {
                    $id_no = '0'.$studentId;
                }
            } //end if statement
            else {
                $student = User::where('user_type','Student')->orderBy('id','DESC')->first()->id;
                $studentId = $student+1;
                if ($studentId < 10) {
                    $id_no = '000'.$studentId;
                }
                elseif ($studentId < 100) {
                    $id_no = '00'.$studentId;
                }
                elseif ($student_id < 1000) {
                    $id_no = '0'.$studentId;
                }
            } //end else

            $final_id_no = $checkYear.$id_no;
            $user = new User();
            $code = rand(0000,9999);           
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->code = $code;
            $user->user_type = 'Student';
            $user->name = $request->name;
            $user->father_name = $request->father_name;
            $user->mother_name = $request->mother_name;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_image'),$filename);
                $user['image'] = $filename;
            }

            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $user->id;
            $assign_student->year_id = $request->year_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discountStudent = new DiscountStudent();
            $discountStudent->assign_student_id = $assign_student->id;
            $discountStudent->fee_category_id = '1';
            $discountStudent->discount = $request->discount;
            $discountStudent->save();
        });

        $notification = array(
            'message' => 'Student Registered Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.view')->with($notification);
        
    } //End Method

    public function StudentClassYearWise(Request $request){
        $data['classes'] = StudentClass::all();
        $data['years'] = StudentYear::all();
        $data['year_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;
        $data['allData'] = AssignStudent::where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
        return view('backend.student.student_registration.student_view',$data);
    } //End Method

    public function EditStudentRegistration($student_id){
        $data['classes'] = StudentClass::all();
        $data['years'] = StudentYear::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        $data['editData'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
        return view('backend.student.student_registration.edit_student',$data);
    } //End Method

    public function UpdateStudentRegistration(Request $request,$student_id){
        DB::transaction(function() use($request,$student_id){
                        
            $user = User::where('id',$student_id)->first();
            $user->name = $request->name;
            $user->father_name = $request->father_name;
            $user->mother_name = $request->mother_name;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/student_image/'.$user->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_image'),$filename);
                $user['image'] = $filename;
            }

            $user->save();

            $assign_student = AssignStudent::where('id',$request->id)->where('student_id',$student_id)->first();
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discountStudent = DiscountStudent::where('assign_student_id',$request->id)->first();
            $discountStudent->discount = $request->discount;
            $discountStudent->save();
        });

        $notification = array(
            'message' => 'Student Registeration Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.view')->with($notification);
    } //End Method

    public function PromoteStudentRegistration($student_id){
        $data['years'] = StudentYear::all();
    	$data['classes'] = StudentClass::all();
    	$data['groups'] = StudentGroup::all();
    	$data['shifts'] = StudentShift::all();

    	$data['editData'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
    	 
    	return view('backend.student.student_registration.student_promotion',$data);
    } //End Method

    public function UpdateStudentRegistrationPromotion(Request $request,$student_id){
        DB::transaction(function() use($request,$student_id){
    	 
            $user = User::where('id',$student_id)->first();
            $user->name = $request->name;
            $user->father_name = $request->father_name;
            $user->mother_name = $request->mother_name;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/student_image/'.$user->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_image'),$filename);
                $user['image'] = $filename;
            }

            $user->save();
    
              $assign_student = new AssignStudent();
              $assign_student->student_id = $student_id;
              $assign_student->year_id = $request->year_id;
              $assign_student->class_id = $request->class_id;
              $assign_student->group_id = $request->group_id;
              $assign_student->shift_id = $request->shift_id;
              $assign_student->save();
    
              $discount_student = new DiscountStudent();
    
              $discount_student->assign_student_id = $assign_student->id;
              $discount_student->fee_category_id = '1';
              $discount_student->discount = $request->discount;
              $discount_student->save();
    
            });
    
    
            $notification = array(
                'message' => 'Student Promotion Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('student.registration.view')->with($notification);
    } //End Method

    public function DetailStudentRegistration($student_id){
        $data['details'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
        $pdf = PDF::loadView('backend.student.student_registration.student_detail_pdf', $data);
	    $pdf->SetProtection(['copy', 'print'], '', 'pass');
	    return $pdf->stream('document.pdf');
    } //End method

}
