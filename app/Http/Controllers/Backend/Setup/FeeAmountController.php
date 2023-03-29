<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;
use App\Models\StudentClass;
use App\Models\FeeCategoryAmount;

class FeeAmountController extends Controller
{
    public function ViewFeeAmount(){
        //$data['alldata'] = FeeCategoryAmount::all();
        $data['alldata'] = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.fee_amount.view_fee_amount',$data);

    } //End Method

    public function AddFeeAmount(){
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.add_fee_amount',$data);

    } //End Method

    public function StoreFeeAmount(Request $request){
        $countclass = count($request->class_id);
        if ($countclass !=Null) {
            for ($i=0; $i <$countclass ; $i++) {
                $feeamount = new FeeCategoryAmount();
                $feeamount->fee_category_id = $request->fee_category_id;
                $feeamount->class_id = $request->class_id[$i];
                $feeamount->amount = $request->amount[$i]; 
                $feeamount->save();
            } //End for loop
        } //End if statement

        $notification = array(
            'message' => 'Fee Amount Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.amount.view')->with($notification);

    } //End Method

    public function EditFeeAmount($fee_category_id){
        $data['editData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.edit_fee_amount',$data);

    } //End Method

    public function UpdateFeeAmount(Request $request,$fee_category_id){
        if ($request->class_id == NULL) {
            $notification = array(
                'message' => 'Sorry You Do Not Select Any Class Amount',
                'alert-type' => 'error'
            );
            return redirect()->route('fee.amount.edit',$class_id)->with($notification);
        }
        else{
            $countclass = count($request->class_id);
            FeeCategoryAmount::where('fee_category_id',$fee_category_id)->delete();
            for ($i=0; $i <$countclass ; $i++) {
                $feeamount = new FeeCategoryAmount();
                $feeamount->fee_category_id = $request->fee_category_id;
                $feeamount->class_id = $request->class_id[$i];
                $feeamount->amount = $request->amount[$i]; 
                $feeamount->save();
            } //End for loop
            

        }
        $notification = array(
            'message' => 'Fee Amount Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.amount.view')->with($notification);

    } //End Method

    public function FeeAmountDetails($fee_category_id){
        $data['detailsData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        return view('backend.setup.fee_amount.fee_amount_details',$data);

    } //End Method
}
