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
use App\Models\EmployeeAttendance;
use DB;
use PDF;

class MonthlySalaryController extends Controller
{
    public function ViewEmployeeMonthlySalary(){
        return view('backend.employee.monthly_salary.monthly_salary_view');
    } //End Method

    public function GetEmployeeMonthlySalary(Request $request){
        $date = date('Y-m', strtotime($request->date));
        if ($date !='') {
            $where[] = ['date','like',$date.'%'];
        }
        
        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        // dd($allStudent);
        $html['thsource']  = '<th>SL</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary This Month</th>';
        $html['thsource'] .= '<th>Action</th>';


        foreach ($data as $key => $attend) {
            $total_attendance = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$attend->employee_id)->get();
            $absent_count = count($total_attendance->where('attend_status','Absent'));
            $color = 'success';
            $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].'</td>';
            
            $salary = (float)$attend['user']['salary'];
            $salaryperday = (float)$salary/30;
            $salaryminus = (float)$absent_count*(float)$salaryperday;
            $totalsalary = (float)$salary-(float)$salaryminus;

            $html[$key]['tdsource'] .='<td>'.$totalsalary.'$'.'</td>';
            $html[$key]['tdsource'] .='<td>';
            $html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blanks" href="'.route("employee.monthly.salary.payslip",$attend->employee_id).'">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';

        }  
       return response()->json(@$html);
    } //End Method

    public function EmployeeMonthlySalaryPayslip(Request $request,$employee_id){
        $id = EmployeeAttendance::where('employee_id',$employee_id)->first();
  		$date = date('Y-m',strtotime($id->date));
    	 if ($date !='') {
    	 	$where[] = ['date','like',$date.'%'];
    	 }
        $alldata['details'] = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$id->employee_id)->get();
        $pdf = PDF::loadView('backend.employee.monthly_salary.monthly_salary_view_pdf', $alldata);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
       } // End Method
}
