<?php

namespace App\Http\Controllers;

use HashContext;
use Illuminate\Http\Request;
use App\Models\users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function list(){
        return users::all();
    }

    function addUser(Request $request){
        $rules = array(
            'name'=>'required | min:2 | max:10',
            'email'=>'required | email',
        );
        $validation = Validator::make($request->all(), $rules);
        if($validation->fails()){
            return $validation->errors();
        }
        $user = new users();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->phone = $request->phone;
        if($user->save()){
            return $user;
        }
        else{
            return "failed";
        }
    }

    function updateUser(Request $request){
        $user = users::find($request->id);
        $user->status = $request->status;
        $user->phone = $request->phone;
        $user->email = $request->email;
        if($user->save()){
            return "Updated";
        }
        else{
            return "failed";
        }
    }

    function deleteUser($id){
        $user = users::destroy($id);
        if($user){
            return "deleted";
        }
        else {
            return "not deleted";
        }
    }

    function searchUser($name){
        $user = users::where('name', 'like', "%$name%")->get();
        if(!empty($user)){
            return $user;
        }
        else return "no record found";
    }
}
