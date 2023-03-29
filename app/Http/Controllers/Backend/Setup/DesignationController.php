<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    public function ViewDesignation(){
        $data['alldata'] = Designation::all();
        return view('backend.setup.designation.view_designation',$data);
    } //End Method

    public function AddDesignation(){
        //$data['alldata'] = StudentClass::all();
        return view('backend.setup.designation.add_designation');
    } //End Method

    public function StoreDesignation(Request $request){

        $validatedData = $request->validate([
    		'name' => 'required|unique:designations,name',	
    	]);

        $data = new Designation();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Designation Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('designation.view')->with($notification);
    } //End Method

    public function EditDesignation($id){

        $editdata = Designation::find($id);
        return view('backend.setup.designation.edit_designation',compact('editdata'));

    } //End Method

    public function UpdateDesignation(Request $request,$id){
        $data = Designation::find($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:designations,name',
        ]);

        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Designation Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('designation.view')->with($notification);
    } //End Method

    public function DeleteDesignation($id){
        $user = Designation::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Designation Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('designation.view')->with($notification);
    } //End Method
}
