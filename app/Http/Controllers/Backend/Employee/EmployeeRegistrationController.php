<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\User;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentYear;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\Designation;
use App\Models\EmployeeSalaryLog;
use DB;
use PDF;

class EmployeeRegistrationController extends Controller
{
    public function ViewEmployeeRegistration(){
        $data['alldata'] = User::where('user_type','Employee')->get();
        return view('backend.employee.employee_registration.employee_registration_view',$data);
    } //End Method

    public function AddEmployeeRegistration(){
        $data['designation'] = Designation::all();
        return view('backend.employee.employee_registration.employee_registration_add',$data);
    } //End Method

    public function StoreEmployeeRegistration(Request $request){
        DB::transaction(function() use($request){
            $checkYear = date('Ym',strtotime($request->join_date));
            $employee = User::where('user_type','Employee')->orderBy('id','DESC')->first();

            if ($employee == null) {
                $firstReg = 0;
                $employeeId = $firstReg+1;
                if ($employeeId < 10) {
                    $id_no = '000'.$employeeId;
                }
                elseif ($employeeId < 100) {
                    $id_no = '00'.$employeeId;
                }
                elseif ($employeeId < 1000) {
                    $id_no = '0'.$employeeId;
                }
            } //end if statement
            else {
                $employee = User::where('user_type','Employee')->orderBy('id','DESC')->first()->id;
                $employeeId = $employee+1;
                if ($employeeId < 10) {
                    $id_no = '000'.$employeeId;
                }
                elseif ($employeeId < 100) {
                    $id_no = '00'.$employeeId;
                }
                elseif ($employeeId < 1000) {
                    $id_no = '0'.$employeeId;
                }
            } //end else

            $final_id_no = $checkYear.$id_no;
            $user = new User();
            $code = rand(0000,9999);           
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->code = $code;
            $user->user_type = 'Employee';
            $user->name = $request->name;
            $user->father_name = $request->father_name;
            $user->mother_name = $request->mother_name;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->designation_id = $request->designation_id;
            $user->salary = $request->salary;
            $user->dob = date('Y-m-d', strtotime($request->dob));
            $user->join_date = date('Y-m-d', strtotime($request->join_date));

            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/employee_image'),$filename);
                $user['image'] = $filename;
            }

            $user->save();

            $employee_salary = new EmployeeSalaryLog();
            $employee_salary->employee_id = $user->id;
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->present_salary = $request->salary;
            $employee_salary->increment_salary = '0';
            $employee_salary->effected_salary = date('Y-m-d', strtotime($request->join_date));
            $employee_salary->save();
        });

        $notification = array(
            'message' => 'Employee Registered Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.registration.view')->with($notification);
    } //End Method

    public function EditEmployeeRegistration($id){
        $data['editData'] = User::find($id);
        $data['designation'] = Designation::all();
        return view('backend.employee.employee_registration.employee_registration_edit',$data);
    } //End Method

    public function UpdateEmployeeRegistration(Request $request,$id){
                  
            $user = User::find($id);
            $user->name = $request->name;
            $user->father_name = $request->father_name;
            $user->mother_name = $request->mother_name;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->designation_id = $request->designation_id;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/employee_image/'.$user->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/employee_image'),$filename);
                $user['image'] = $filename;
            }

            $user->save(); 

        $notification = array(
            'message' => 'Employee Registeration Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.registration.view')->with($notification);
    } //End Method

    public function DetailsEmployeeRegistration($id){
        $data['details'] = User::find($id);
        $pdf = PDF::loadView('backend.employee.employee_registration.employee_details_pdf', $data);
	    $pdf->SetProtection(['copy', 'print'], '', 'pass');
	    return $pdf->stream('document.pdf');
    } //End method
}
