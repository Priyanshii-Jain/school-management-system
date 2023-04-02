<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\User;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentYear;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentMarks;
use App\Models\ExamType;
use App\Models\MarksGrade;
use App\Models\AccountStudentFee;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\AccountEmployeeSalary;
use App\Models\Designation;
use App\Models\EmployeeSallaryLog;
use App\Models\EmployeeAttendance;
use App\Models\AccountOtherCost;
use DB;
use PDF;

class OtherCostController extends Controller
{
    public function ViewOtherCost(){
        $data['allData'] = AccountOtherCost::orderBy('id','desc')->get();
        return view('backend.account.other_cost.other_cost_view',$data);
    } //End Method

    public function AddOtherCost(){
        return view('backend.account.other_cost.other_cost_add');
    } //End Method

    public function StoreOtherCost(Request $request){
        $cost = new AccountOtherCost();
    	$cost->date = date('Y-m-d', strtotime($request->date));
    	$cost->amount = $request->amount;

    	if ($request->file('image')) {
    		$file = $request->file('image');
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('upload/cost_images'),$filename);
    		$cost['image'] = $filename;
    	}
    	$cost->description = $request->description;
    	$cost->save();

    	$notification = array(
    		'message' => 'Other Cost Inserted Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('other.cost.view')->with($notification);
    } //End Method

    public function EditOtherCost($id){
        $data['editData'] = AccountOtherCost::find($id);
    	return view('backend.account.other_cost.other_cost_edit', $data);
    } //End Method

    public function UpdateOtherCost(Request $request,$id){
        $cost = AccountOtherCost::find($id);
    	$cost->date = date('Y-m-d', strtotime($request->date));
    	$cost->amount = $request->amount;

    	if ($request->file('image')) {
    		$file = $request->file('image');
    		@unlink(public_path('upload/cost_images/'.$cost->image));
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('upload/cost_images'),$filename);
    		$cost['image'] = $filename;
    	}
    	$cost->description = $request->description;
    	$cost->save();

    	$notification = array(
    		'message' => 'Other Cost Updated Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('other.cost.view')->with($notification);
    } //End Method
}
