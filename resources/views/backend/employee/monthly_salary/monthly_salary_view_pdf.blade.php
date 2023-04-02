<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

<h1>Employee Monthly Salary Details</h1>

<table id="customers">
  <tr>
    <td><h2>School Management System</h2></td>
    <td><h2>School Management ERP</h2>
    <p>School Adress</p>
    <p>Phone: 47386875637</p>
    <p>Email: school_management@gmail.com</p>
    </td>
  </tr>
  
</table>

@php
        $date = date('Y-m', strtotime($details['0']->date));
        if ($date !='') {
            $where[] = ['date','like',$date.'%'];
        }

        $total_attendance = App\Models\EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$details['0']->employee_id)->get();
        
        $salary = (float)$details['0']['user']['salary'];
        $salaryperday = (float)$salary/30;
        $absent_count = count($total_attendance->where('attend_status','Absent'));
        $salaryminus = (float)$absent_count*(float)$salaryperday;
        $totalsalary = (float)$salary-(float)$salaryminus;
@endphp

<table id="customers">
  <tr>
    <th>Sr.No.</th>
    <th>Employee Details</th>
    <th>Employee Data</th>
  </tr>
  
  <tr>
    <td>1</td>
    <td><b>Employee Name</b></td>
    <td>{{ $details['0']['user']['name'] }}</td>
  </tr>
  <tr>
    <td>2</td>
    <td><b>Basic Salary</b></td>
    <td>{{ $details['0']['user']['salary'] }}</td>
  </tr>
  <tr>
    <td>3</td>
    <td><b>Total Absent for This Month</b></td>
    <td>{{ $absent_count }}</td>
  </tr>

  <tr>
    <td>4</td>
    <td><b>Month</b></td>
    <td>{{ date('M Y',strtotime($details['0']->date)) }}</td>
  </tr>
  <tr>
    <td>5</td>
    <td><b>Salary This Month</b></td>
    <td>{{ $totalsalary }}</td>
  </tr>
  
  
</table>
<br>
<i style="font-size: 10px; float: right;">Print Data : {{ date("d M Y") }}</i>

<hr style="width: 95%; margin-bottom: 50px; border: dashed 2px;">

<table id="customers">
  <tr>
    <th>Sr.No.</th>
    <th>Employee Details</th>
    <th>Employee Data</th>
  </tr>
  
  <tr>
    <td>1</td>
    <td><b>Employee Name</b></td>
    <td>{{ $details['0']['user']['name'] }}</td>
  </tr>
  <tr>
    <td>2</td>
    <td><b>Basic Salary</b></td>
    <td>{{ $details['0']['user']['salary'] }}</td>
  </tr>
  <tr>
    <td>3</td>
    <td><b>Total Absent for This Month</b></td>
    <td>{{ $absent_count }}</td>
  </tr>

  <tr>
    <td>4</td>
    <td><b>Month</b></td>
    <td>{{ date('M Y',strtotime($details['0']->date)) }}</td>
  </tr>
  <tr>
    <td>5</td>
    <td><b>Salary This Month</b></td>
    <td>{{ $totalsalary }}</td>
  </tr>
  
  
</table>

</body>
</html>


