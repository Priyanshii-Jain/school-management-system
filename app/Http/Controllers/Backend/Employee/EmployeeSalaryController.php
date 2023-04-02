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

class EmployeeSalaryController extends Controller
{
    public function ViewEmployeeSalary(){
        $data['alldata'] = User::where('user_type','Employee')->get();
        return view('backend.employee.employee_salary.employee_salary_view',$data);
    } //End Method

    public function EmployeeSalaryIncrement($id){
        $data['editdata'] = User::find($id);
        return view('backend.employee.employee_salary.employee_salary_increment',$data);
    } //End Method

    public function EmployeeSalaryIncrementStore(Request $request,$id){
        $user = User::find($id);
        $previous_salary = $user->salary;
        $present_salary = (float)$previous_salary+(float)$request->increment_salary;
        $user->salary = $present_salary;
        $user->save();

        $salarydata = new EmployeeSalaryLog();
        $salarydata->employee_id = $id;
        $salarydata->previous_salary = $previous_salary;
        $salarydata->present_salary = $present_salary;
        $salarydata->increment_salary = $request->increment_salary;
        $salarydata->effected_salary = date('Y-m-d', strtotime($request->effected_salary));
        $salarydata->save();

        $notification = array(
            'message' => 'Employee Salary Incremented Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.salary.view')->with($notification);
    } //End Method

    public function EmployeeSalaryDetails($id){
        $data['details'] = User::find($id);
        $data['salary'] = EmployeeSalaryLog::where('employee_id',$data['details']->id)->get();
        return view('backend.employee.employee_salary.employee_salary_details',$data);
    } //End method
}
