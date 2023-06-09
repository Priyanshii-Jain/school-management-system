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

<h1>Student Details</h1>

<table id="customers">
  <tr>
    <td><h2>School Management System</h2></td>
    <td><h2>School Management ERP</h2>
    <p>School Adress</p>
    <p>Phone: 47386875637</p>
    <p>Email: school_management@gmail.com</p>
    <p><strong>Student Monthly Fee</strong></p>
    </td>
  </tr>
  
</table>

@php
$registrationfee = App\Models\FeeCategoryAmount::where('fee_category_id','3')->where('class_id',$details->class_id)->first();
$originalfee = $registrationfee->amount;
$discount = $details['discount']['discount'];
$discounttablefee = $discount/100*$originalfee;
$finalfee = (float)$originalfee-(float)$discounttablefee;
@endphp

<table id="customers">
  <tr>
    <th>Sr.No.</th>
    <th>Student Details</th>
    <th>Student Data</th>
  </tr>
  
  <tr>
    <td>1</td>
    <td><b>Student Id No.</b></td>
    <td>{{ $details['student']['id_no'] }}</td>
  </tr>
  <tr>
    <td>2</td>
    <td><b>Student Roll</b></td>
    <td>{{ $details->roll }}</td>
  </tr>
  <tr>
    <td>3</td>
    <td><b>Student Name</b></td>
    <td>{{ $details['student']['name'] }}</td>
  </tr>
  <tr>
    <td>4</td>
    <td><b>Father's Name</b></td>
    <td>{{ $details['student']['father_name'] }}</td>
  </tr>
  <tr>
    <td>5</td>
    <td><b>Session</b></td>
    <td>{{ $details['student_year']['name'] }}</td>
  </tr>
  <tr>
    <td>6</td>
    <td><b>Class</b></td>
    <td>{{ $details['class']['name'] }}</td>
  </tr>
  <tr>
    <td>7</td>
    <td><b>Monthly Fee</b></td>
    <td>${{ $originalfee }}</td>
  </tr>
  <tr>
    <td>8</td>
    <td><b>Discount Fee</b></td>
    <td>{{ $discount }}%</td>
  </tr>
  <tr>
    <td>9</td>
    <td><b>Fee for this Student of {{ $month }}</b></td>
    <td>${{ $finalfee }}</td>
  </tr>
  
</table>
<br>
<i style="font-size: 10px; float: right;">Print Data : {{ date("d M Y") }}</i>

<hr style="width: 95%; margin-bottom: 50px; border: dashed 2px;">

<table id="customers">
  <tr>
    <th>Sr.No.</th>
    <th>Student Details</th>
    <th>Student Data</th>
  </tr>
  
  <tr>
    <td>1</td>
    <td><b>Student Id No.</b></td>
    <td>{{ $details['student']['id_no'] }}</td>
  </tr>
  <tr>
    <td>2</td>
    <td><b>Student Roll</b></td>
    <td>{{ $details->roll }}</td>
  </tr>
  <tr>
    <td>3</td>
    <td><b>Student Name</b></td>
    <td>{{ $details['student']['name'] }}</td>
  </tr>
  <tr>
    <td>4</td>
    <td><b>Father's Name</b></td>
    <td>{{ $details['student']['father_name'] }}</td>
  </tr>
  <tr>
    <td>5</td>
    <td><b>Session</b></td>
    <td>{{ $details['student_year']['name'] }}</td>
  </tr>
  <tr>
    <td>6</td>
    <td><b>Class</b></td>
    <td>{{ $details['class']['name'] }}</td>
  </tr>
  <tr>
    <td>7</td>
    <td><b>Monthly Fee</b></td>
    <td>${{ $originalfee }}</td>
  </tr>
  <tr>
    <td>8</td>
    <td><b>Discount Fee</b></td>
    <td>{{ $discount }}%</td>
  </tr>
  <tr>
    <td>9</td>
    <td><b>Fee for this Student of {{ $month }}</b></td>
    <td>${{ $finalfee }}</td>
  </tr>
  
</table>

</body>
</html>


