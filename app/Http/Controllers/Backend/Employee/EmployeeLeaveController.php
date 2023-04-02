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
use App\Models\LeavePurpose;
use App\Models\EmployeeLeave;
use DB;
use PDF;

class EmployeeLeaveController extends Controller
{
    public function ViewEmployeeLeave(){
        $data['alldata'] = EmployeeLeave::orderBy('id','DESC')->get();
        return view('backend.employee.employee_leave.employee_leave_view',$data);
    } //End Method

    public function AddEmployeeLeave(){
        $data['employees'] = User::where('user_type','Employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();
        return view('backend.employee.employee_leave.employee_leave_add',$data);
    } //End Method

    public function StoreEmployeeLeave(Request $request){
        if ($request->leave_purpose_id == '0') {
            $l_purpose = new LeavePurpose();
            $l_purpose->name = $request->name;
            $l_purpose->save();
            $leave_purpose_id = $l_purpose->id;
        } else{
            $leave_purpose_id = $request->leave_purpose_id;
        }

        $data = new EmployeeLeave();
        $data->employee_id = $request->employee_id;
        $data->leave_purpose_id = $leave_purpose_id;
        $data->start_date = date('Y-m-d',strtotime($request->start_date));
        $data->end_date = date('Y-m-d',strtotime($request->end_date));
        $data->save();

        $notification = array(
            'message' => 'Employee Leave Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.leave.view')->with($notification);
    } //End Method
    
    public function EditEmployeeLeave($id){
        $data['employees'] = User::where('user_type','Employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();
        $data['leave'] = EmployeeLeave::find($id);
        return view('backend.employee.employee_leave.employee_leave_edit',$data);
    } //End Method

    public function UpdateEmployeeLeave(Request $request,$id){
        if ($request->leave_purpose_id == '0') {
            $l_purpose = new LeavePurpose;
            $l_purpose->name = $request->name;
            $l_purpose->save();
            $leave_purpose_id = $l_purpose->id;
        } else{
            $leave_purpose_id = $request->leave_purpose_id;
        }

        $data = EmployeeLeave::find($id);
        $data->employee_id = $request->employee_id;
        $data->leave_purpose_id = $leave_purpose_id;
        $data->start_date = date('Y-m-d',strtotime($request->start_date));
        $data->end_date = date('Y-m-d',strtotime($request->end_date));
        $data->save();

        $notification = array(
            'message' => 'Employee Leave Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.leave.view')->with($notification);
    } //End Method

    public function DeleteEmployeeLeave($id){
        
        $data = EmployeeLeave::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Employee Leave Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('employee.leave.view')->with($notification);
    } //End Method
}
