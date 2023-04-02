<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;
use App\Http\Controllers\Backend\Setup\DesignationController;

use App\Http\Controllers\Backend\Student\StudentRegistrationController;
use App\Http\Controllers\Backend\Student\StudentRollController;
use App\Http\Controllers\Backend\Student\RegistrationFeeController;
use App\Http\Controllers\Backend\Student\MonthlyFeeController;
use App\Http\Controllers\Backend\Student\ExamFeeController;

use App\Http\Controllers\Backend\Employee\EmployeeRegistrationController;
use App\Http\Controllers\Backend\Employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\Employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\Employee\EmployeeAttendanceController;
use App\Http\Controllers\Backend\Employee\MonthlySalaryController;

use App\Http\Controllers\Backend\Marks\MarksController;
use App\Http\Controllers\Backend\Marks\GradeController;

use App\Http\Controllers\Backend\DefaultController;

use App\Http\Controllers\Backend\Account\StudentFeeController;
use App\Http\Controllers\Backend\Account\AccountSalaryController;
use App\Http\Controllers\Backend\Account\OtherCostController;

use App\Http\Controllers\Backend\Report\ProfitController;
use App\Http\Controllers\Backend\Report\MarksheetController;
use App\Http\Controllers\Backend\Report\AttendanceReportController;
use App\Http\Controllers\Backend\Report\ResultReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'prevent-back-history'],function(){
    
 

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');

Route::group(['middleware' => 'auth'],function(){
// User Management All routes

Route::prefix('users')->group(function(){
Route::get('/view', [UserController::class, 'UserView'])->name('user.view');
Route::get('/add', [UserController::class, 'UserAdd'])->name('users.add');
Route::post('/store', [UserController::class, 'UserStore'])->name('user.store');
Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('users.edit');
Route::post('/update/{id}', [UserController::class, 'Userupdate'])->name('user.update');
Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('users.delete');
});

// User Profile and change password

Route::prefix('profile')->group(function(){
    Route::get('/view', [ProfileController::class, 'ProfileView'])->name('profile.view');
    Route::get('/edit', [ProfileController::class, 'ProfileEdit'])->name('profile.edit');
    Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');
    Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');
    Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');
    });

// Setup Management Routes

Route::prefix('setups')->group(function(){

    // Student Class Routes
    Route::get('student/class/view', [StudentClassController::class, 'ViewStudent'])->name('student.class.view');
    Route::get('student/class/add', [StudentClassController::class, 'AddStudentClass'])->name('student.class.add');
    Route::post('/store/student/class', [StudentClassController::class, 'StoreStudentClass'])->name('store.student.class');
    Route::get('student/class/edit/{id}', [StudentClassController::class, 'EditStudentClass'])->name('edit.student.class');
    Route::post('student/class/update/{id}', [StudentClassController::class, 'UpdateStudentClass'])->name('update.student.class');
    Route::get('student/class/delete/{id}', [StudentClassController::class, 'DeleteStudentClass'])->name('delete.student.class');

    //Student Year Routes
    Route::get('student/year/view', [StudentYearController::class, 'ViewStudentYear'])->name('student.year.view');
    Route::get('student/year/add', [StudentYearController::class, 'AddStudentYear'])->name('student.year.add');
    Route::post('/store/student/year', [StudentYearController::class, 'StoreStudentYear'])->name('store.student.year');
    Route::get('student/year/edit/{id}', [StudentYearController::class, 'EditStudentYear'])->name('edit.student.year');
    Route::post('student/year/update/{id}', [StudentYearController::class, 'UpdateStudentYear'])->name('update.student.year');
    Route::get('student/year/delete/{id}', [StudentYearController::class, 'DeleteStudentYear'])->name('delete.student.year');

    //Student Group Routes
    Route::get('student/group/view', [StudentGroupController::class, 'ViewStudentGroup'])->name('student.group.view');
    Route::get('student/group/add', [StudentGroupController::class, 'AddStudentGroup'])->name('student.group.add');
    Route::post('/store/student/group', [StudentGroupController::class, 'StoreStudentGroup'])->name('store.student.group');
    Route::get('student/group/edit/{id}', [StudentGroupController::class, 'EditStudentGroup'])->name('edit.student.group');
    Route::post('student/group/update/{id}', [StudentGroupController::class, 'UpdateStudentGroup'])->name('update.student.group');
    Route::get('student/group/delete/{id}', [StudentGroupController::class, 'DeleteStudentGroup'])->name('delete.student.group');

    //Student Shift Routes
    Route::get('student/shift/view', [StudentShiftController::class, 'ViewStudentShift'])->name('student.shift.view');
    Route::get('student/shift/add', [StudentShiftController::class, 'AddStudentShift'])->name('student.shift.add');
    Route::post('/store/student/shift', [StudentShiftController::class, 'StoreStudentShift'])->name('store.student.shift');
    Route::get('student/shift/edit/{id}', [StudentShiftController::class, 'EditStudentShift'])->name('edit.student.shift');
    Route::post('student/shift/update/{id}', [StudentShiftController::class, 'UpdateStudentShift'])->name('update.student.shift');
    Route::get('student/shift/delete/{id}', [StudentShiftController::class, 'DeleteStudentShift'])->name('delete.student.shift');

    //Fee Category Routes
    Route::get('fee/category/view', [FeeCategoryController::class, 'ViewFeeCategory'])->name('fee.category.view');
    Route::get('fee/category/add', [FeeCategoryController::class, 'AddFeeCategory'])->name('fee.category.add');
    Route::post('/store/fee/category', [FeeCategoryController::class, 'StoreFeeCategory'])->name('store.fee.category');
    Route::get('fee/category/edit/{id}', [FeeCategoryController::class, 'EditFeeCategory'])->name('edit.fee.category');
    Route::post('fee/category/update/{id}', [FeeCategoryController::class, 'UpdateFeeCategory'])->name('update.fee.category');
    Route::get('fee/category/delete/{id}', [FeeCategoryController::class, 'DeleteFeeCategory'])->name('delete.fee.category');

    //Fee Category Amount Routes
    Route::get('fee/amount/view', [FeeAmountController::class, 'ViewFeeAmount'])->name('fee.amount.view');
    Route::get('fee/amount/add', [FeeAmountController::class, 'AddFeeAmount'])->name('fee.amount.add');
    Route::post('/store/fee/amount', [FeeAmountController::class, 'StoreFeeAmount'])->name('store.fee.amount');
    Route::get('fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'EditFeeAmount'])->name('fee.amount.edit');
    Route::post('fee/amount/update/{fee_category_id}', [FeeAmountController::class, 'UpdateFeeAmount'])->name('update.fee.amount');
    Route::get('fee/amount/details/{fee_category_id}', [FeeAmountController::class, 'FeeAmountDetails'])->name('fee.amount.details');

    //Exam Type Routes
    Route::get('exam/type/view', [ExamTypeController::class, 'ViewExamType'])->name('exam.type.view');
    Route::get('exam/type/add', [ExamTypeController::class, 'AddExamType'])->name('exam.type.add');
    Route::post('/store/exam/type', [ExamTypeController::class, 'StoreExamType'])->name('store.exam.type');
    Route::get('exam/type/edit/{id}', [ExamTypeController::class, 'EditExamType'])->name('edit.exam.type');
    Route::post('exam/type/update/{id}', [ExamTypeController::class, 'UpdateExamType'])->name('update.exam.type');
    Route::get('exam/type/delete/{id}', [ExamTypeController::class, 'DeleteExamType'])->name('delete.exam.type');

    //School Subject Routes
    Route::get('school/subject/view', [SchoolSubjectController::class, 'ViewSchoolSubject'])->name('school.subject.view');
    Route::get('school/subject/add', [SchoolSubjectController::class, 'AddSchoolSubject'])->name('school.subject.add');
    Route::post('/store/school/subject', [SchoolSubjectController::class, 'StoreSchoolSubject'])->name('store.school.subject');
    Route::get('school/subject/edit/{id}', [SchoolSubjectController::class, 'EditSchoolSubject'])->name('school.subject.edit');
    Route::post('school/subject/update/{id}', [SchoolSubjectController::class, 'UpdateSchoolSubject'])->name('update.school.subject');
    Route::get('school/subject/delete/{id}', [SchoolSubjectController::class, 'DeleteSchoolSubject'])->name('school.subject.delete');

    //Assign Subject Routes
    Route::get('assign/subject/view', [AssignSubjectController::class, 'ViewAssignSubject'])->name('assign.subject.view');
    Route::get('assign/subject/add', [AssignSubjectController::class, 'AddAssignSubject'])->name('assign.subject.add');
    Route::post('/store/assign/subject', [AssignSubjectController::class, 'StoreAssignSubject'])->name('store.assign.subject');
    Route::get('assign/subject/edit/{class_id}', [AssignSubjectController::class, 'EditAssignSubject'])->name('assign.subject.edit');
    Route::post('assign/subject/update/{class_id}', [AssignSubjectController::class, 'UpdateAssignSubject'])->name('update.assign.subject');
    Route::get('assign/subject/details/{class_id}', [AssignSubjectController::class, 'AssignSubjectDetails'])->name('assign.subject.details');

    //Designation Routes
    Route::get('designation/view', [DesignationController::class, 'ViewDesignation'])->name('designation.view');
    Route::get('designation/add', [DesignationController::class, 'AddDesignation'])->name('designation.add');
    Route::post('/store/designation', [DesignationController::class, 'StoreDesignation'])->name('store.designation');
    Route::get('designation/edit/{id}', [DesignationController::class, 'EditDesignation'])->name('designation.edit');
    Route::post('designation/update/{id}', [DesignationController::class, 'UpdateDesignation'])->name('update.designation');
    Route::get('sdesignation/delete/{id}', [DesignationController::class, 'DeleteDesignation'])->name('designation.delete');
    });

// Student Management Routes

Route::prefix('students')->group(function(){

    // Student Registration All Route
    Route::get('/registration/view', [StudentRegistrationController::class, 'ViewStudentRegistration'])->name('student.registration.view');
    Route::get('/registration/add', [StudentRegistrationController::class, 'AddStudentRegistration'])->name('student.registration.add');
    Route::post('/registration/store', [StudentRegistrationController::class, 'StoreStudentRegistration'])->name('student.registration.store');
    Route::get('/year/class/wise', [StudentRegistrationController::class, 'StudentClassYearWise'])->name('student.year.class.wise');
    Route::get('/registration/edit/{student_id}', [StudentRegistrationController::class, 'EditStudentRegistration'])->name('student.registration.edit');
    Route::post('/registration/update/{student_id}', [StudentRegistrationController::class, 'UpdateStudentRegistration'])->name('student.registration.update');
    Route::get('/registration/promotion/{student_id}', [StudentRegistrationController::class, 'PromoteStudentRegistration'])->name('student.registration.promotion');
    Route::post('/registration/promotion/update/{student_id}', [StudentRegistrationController::class, 'UpdateStudentRegistrationPromotion'])->name('promotion.student.registration');
    Route::get('/registration/detail/{student_id}', [StudentRegistrationController::class, 'DetailStudentRegistration'])->name('student.registration.detail');

    // Student Roll Generate All Route
    Route::get('/roll/generate/view', [StudentRollController::class, 'ViewStudentRollGenerate'])->name('roll.generate.view');
    Route::get('/registration/getstudents', [StudentRollController::class, 'GetStudents'])->name('student.registration.getstudents');
    Route::post('/roll/generate/store', [StudentRollController::class, 'StudentRollStore'])->name('roll.generate.store');

    // Student Registration Fee All Route
    Route::get('/registration/fee/view', [RegistrationFeeController::class, 'ViewRegistrationFee'])->name('registration.fee.view');
    Route::get('/registration/fee/classwise/data', [RegistrationFeeController::class, 'RegistrationFeeClasswiseData'])->name('student.registration.fee.classwise.get');
    Route::get('/registration/fee/payslip', [RegistrationFeeController::class, 'RegistrationFeePaySlip'])->name('student.registration.fee.payslip');

    // Student Monthly Fee All Route
    Route::get('/monthly/fee/view', [MonthlyFeeController::class, 'ViewMonthlyFee'])->name('monthly.fee.view');
    Route::get('/monthly/fee/classwise/data', [MonthlyFeeController::class, 'MonthlyFeeClasswiseData'])->name('student.monthly.fee.classwise.get');
    Route::get('/monthly/fee/payslip', [MonthlyFeeController::class, 'MonthlyFeePaySlip'])->name('student.monthly.fee.payslip');

    // Student Exam Fee All Route
    Route::get('/exam/fee/view', [ExamFeeController::class, 'ViewExamFee'])->name('exam.fee.view');
    Route::get('/exam/fee/classwise/data', [ExamFeeController::class, 'ExamFeeClasswiseData'])->name('student.exam.fee.classwise.get');
    Route::get('/exam/fee/payslip', [ExamFeeController::class, 'ExamFeePaySlip'])->name('student.exam.fee.payslip');
});

// Employee Management Routes

Route::prefix('employees')->group(function(){

    // Employee Registration all routes
    Route::get('/registration/view', [EmployeeRegistrationController::class, 'ViewEmployeeRegistration'])->name('employee.registration.view');
    Route::get('/registration/add', [EmployeeRegistrationController::class, 'AddEmployeeRegistration'])->name('employee.registration.add');
    Route::post('/registration/store', [EmployeeRegistrationController::class, 'StoreEmployeeRegistration'])->name('employee.registration.store');
    Route::get('/registration/edit/{id}', [EmployeeRegistrationController::class, 'EditEmployeeRegistration'])->name('employee.registration.edit');
    Route::post('/registration/update/{id}', [EmployeeRegistrationController::class, 'UpdateEmployeeRegistration'])->name('employee.registration.update');
    Route::get('/registration/detail/{id}', [EmployeeRegistrationController::class, 'DetailsEmployeeRegistration'])->name('employee.registration.details');

    // Employee Salary all routes
    Route::get('/salary/view', [EmployeeSalaryController::class, 'ViewEmployeeSalary'])->name('employee.salary.view');
    Route::get('/salary/increment/{id}', [EmployeeSalaryController::class, 'EmployeeSalaryIncrement'])->name('employee.salary.increment');
    Route::post('/salary/increment/store/{id}', [EmployeeSalaryController::class, 'EmployeeSalaryIncrementStore'])->name('update.increment.store');
    Route::get('/salary/details/{id}', [EmployeeSalaryController::class, 'EmployeeSalaryDetails'])->name('employee.salary.details');

    // Employee Leave all routes
    Route::get('/leave/view', [EmployeeLeaveController::class, 'ViewEmployeeLeave'])->name('employee.leave.view');
    Route::get('/leave/add', [EmployeeLeaveController::class, 'AddEmployeeLeave'])->name('employee.leave.add');
    Route::post('/leave/store', [EmployeeLeaveController::class, 'StoreEmployeeLeave'])->name('employee.leave.store');
    Route::get('/leave/edit/{id}', [EmployeeLeaveController::class, 'EditEmployeeLeave'])->name('employee.leave.edit');
    Route::post('/leave/update/{id}', [EmployeeLeaveController::class, 'UpdateEmployeeLeave'])->name('employee.leave.update');
    Route::get('/leave/delete/{id}', [EmployeeLeaveController::class, 'DeleteEmployeeLeave'])->name('employee.leave.delete');

    // Employee Attendance all routes
    Route::get('/attendance/view', [EmployeeAttendanceController::class, 'ViewEmployeeAttendance'])->name('employee.attendance.view');
    Route::get('/attendance/add', [EmployeeAttendanceController::class, 'AddEmployeeAttendance'])->name('employee.attendance.add');
    Route::post('/attendance/store', [EmployeeAttendanceController::class, 'StoreEmployeeAttendance'])->name('employee.attendance.store');
    Route::get('/attendance/edit/{date}', [EmployeeAttendanceController::class, 'EditEmployeeAttendance'])->name('employee.attendance.edit');
    Route::get('/attendance/details/{date}', [EmployeeAttendanceController::class, 'EmployeeAttendanceDetails'])->name('employee.attendance.details');

    // Employee Monthly Salary all routes
    Route::get('/monthly/salary/view', [MonthlySalaryController::class, 'ViewEmployeeMonthlySalary'])->name('employee.monthly.salary.view');
    Route::get('/monthly/salary/get', [MonthlySalaryController::class, 'GetEmployeeMonthlySalary'])->name('employee.monthly.salary.get');
    Route::get('/monthly/salary/payslip/{employee_id}', [MonthlySalaryController::class, 'EmployeeMonthlySalaryPayslip'])->name('employee.monthly.salary.payslip');
    
});

// Marks Management Routes

Route::prefix('marks')->group(function(){

    // Marks Entry all routes
    Route::get('/entry/add', [MarksController::class, 'MarksAdd'])->name('marks.entry.add');
    Route::post('/entry/store', [MarksController::class, 'MarksStore'])->name('marks.entry.store');
    Route::get('/entry/edit', [MarksController::class, 'MarksEdit'])->name('marks.entry.edit');
    Route::get('/entry/getstudents/edit', [MarksController::class, 'MarksEditGetStudents'])->name('student.edit.getstudents');
    Route::post('/entry/update', [MarksController::class, 'MarksUpdate'])->name('marks.entry.update');

    // Marks Entry Grade all routes
    Route::get('/grade/view', [GradeController::class, 'MarksGradeView'])->name('marks.entry.grade');
    Route::get('/grade/add', [GradeController::class, 'MarksGradeAdd'])->name('marks.grade.add');
    Route::post('/grade/store', [GradeController::class, 'MarksGradeStore'])->name('grade.marks.store');
    Route::get('/grade/edit/{id}', [GradeController::class, 'MarksGradeEdit'])->name('grade.marks.edit');
    Route::post('/grade/update/{id}', [GradeController::class, 'MarksGradeUpdate'])->name('grade.marks.update');
});

// Accounts Management Routes

Route::prefix('accounts')->group(function(){

    // Student Fee all routes
    Route::get('/student/fee/view', [StudentFeeController::class, 'ViewStudentFee'])->name('student.fee.view');
    Route::get('/student/fee/add', [StudentFeeController::class, 'AddStudentFee'])->name('student.fee.add');
    Route::get('/student/fee/getstudent', [StudentFeeController::class, 'AccountGetStudentFee'])->name('account.fee.getstudent');
    Route::post('/student/fee/store', [StudentFeeController::class, 'StoreStudentFee'])->name('account.fee.store');

    // Employee Salary all routes
    Route::get('/employee/salary/view', [AccountSalaryController::class, 'ViewEmployeeSalary'])->name('account.salary.view');
    Route::get('/employee/salary/add', [AccountSalaryController::class, 'AddEmployeeSalary'])->name('account.salary.add');
    Route::get('/employee/salary/getemployee', [AccountSalaryController::class, 'AccountGetEmployeeSalary'])->name('account.salary.getemployee');
    Route::post('/employee/salary/store', [AccountSalaryController::class, 'StoreEmployeeSalary'])->name('account.salary.store');

    // Other Cost all routes
    Route::get('/other/cost/view', [OtherCostController::class, 'ViewOtherCost'])->name('other.cost.view');
    Route::get('/other/cost/add', [OtherCostController::class, 'AddOtherCost'])->name('other.cost.add');
    Route::post('/other/cost/store', [OtherCostController::class, 'StoreOtherCost'])->name('other.cost.store');
    Route::get('/other/cost/edit/{id}', [OtherCostController::class, 'EditOtherCost'])->name('other.cost.edit');
    Route::post('/other/cost/update/{id}', [OtherCostController::class, 'UpdateOtherCost'])->name('other.cost.update');
});

Route::get('marks/getsubject', [DefaultController::class, 'GetSubject'])->name('marks.getsubject');
Route::get('student/marks/getstudents', [DefaultController::class, 'GetStudents'])->name('student.marks.getstudents');

// Report Management Routes

Route::prefix('reports')->group(function(){

    // Monthly-Yearly Profit all routes
    Route::get('/monthly/profit/view', [ProfitController::class, 'ViewMonthlyProfit'])->name('monthly.profit.view');
    Route::get('/monthly/profit/datewise', [ProfitController::class, 'DatewiseMonthlyProfit'])->name('report.profit.datewise.get');
    Route::get('/monthly/profit/pdf', [ProfitController::class, 'MonthlyProfitReportPDF'])->name('report.profit.pdf');

    // Generate Marksheet all routes
    Route::get('/marksheet/generate/view', [MarksheetController::class, 'ViewMarksheetGenerate'])->name('marksheet.generate.view');
    Route::get('/marksheet/generate/getreport', [MarksheetController::class, 'GetMarksheetGenerate'])->name('report.marksheet.get');

    // Attendance Report all routes
    Route::get('/attendance/report/view', [AttendanceReportController::class, 'ViewAttendanceReport'])->name('attendance.report.view');
    Route::get('/attendance/report/get', [AttendanceReportController::class, 'GetAttendanceReport'])->name('report.attendance.get');

    // Student Result all routes
    Route::get('/student/result/view', [ResultReportController::class, 'ViewStudentResult'])->name('student.result.view');
    Route::get('/student/result/get', [ResultReportController::class, 'GetStudentResult'])->name('report.student.result.get');

    // Id card Generate all routes
    Route::get('/student/idcard/view', [ResultReportController::class, 'ViewStudentIdCard'])->name('student.idcard.view');
    Route::get('/student/idcard/get', [ResultReportController::class, 'GetStudentIdCard'])->name('report.student.idcard.get');
});


});

}); //End Middelware All Route
    