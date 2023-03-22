<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function UserView(){
        //$alldata = User::all();
        $data['alldata'] = User::all();
        return view('backend.user.view_user',$data);
    } //End Method

    public function UserAdd(){
        //$alldata = User::all();
        return view('backend.user.add_user');
    } //End Method

    public function UserStore(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
        ]);

        $data = new User();
        $data->user_type = $request->user_type;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        $notification = array(
            'message' => 'User Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user.view')->with($notification);
    } //End Method

    public function UserEdit($id){
        $editdata = User::find($id);
        return view('backend.user.edit_user',compact('editdata'));
    } //End Method

    public function Userupdate(Request $request,$id){
        $data = User::find($id);
        $data->user_type = $request->user_type;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->save();

        $notification = array(
            'message' => 'User Updated Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('user.view')->with($notification);
    } //End Method

    public function UserDelete($id){
        $user = User::find($id);
        $user->delete();

        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('user.view')->with($notification);
    } //End Method
}
