<?php

namespace App\Http\Controllers;

use HashContext;
use Illuminate\Http\Request;
use App\Models\users;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function list(){
        return users::all();
    }

    function addUser(Request $request){
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
}
