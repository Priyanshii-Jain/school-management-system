<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;

class FeeCategoryController extends Controller
{
    public function ViewFeeCategory(){
        $data['alldata'] = FeeCategory::all();
        return view('backend.setup.fee.view_fee_category',$data);
    } //End Method

    public function AddFeeCategory(){
        //$data['alldata'] = StudentClass::all();
        return view('backend.setup.fee.add_fee_category');
    } //End Method

    public function StoreFeeCategory(Request $request){

        $validatedData = $request->validate([
    		'name' => 'required|unique:fee_categories,name',	
    	]);

        $data = new FeeCategory();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Fee Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.category.view')->with($notification);
    } //End Method

    public function EditFeeCategory($id){

        $editdata = FeeCategory::find($id);
        return view('backend.setup.fee.edit_fee_category',compact('editdata'));

    } //End Method

    public function UpdateFeeCategory(Request $request,$id){
        $data = FeeCategory::find($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:fee_categories,name',
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Fee Category Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('fee.category.view')->with($notification);
    } //End Method

    public function DeleteFeeCategory($id){
        $user = FeeCategory::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Fee Category Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('fee.category.view')->with($notification);
    } //End Method
}
