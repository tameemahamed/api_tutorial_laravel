<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/test",function(){
    return [
        "name"=>"Tameem Ahamed",
        "age"=>"23"
    ];
});

// Route::get('users',[UserController::class, 'list']);

Route::post('adduser',[UserController::class, 'addUser']);

Route::put('updateuser',[UserController::class,'updateUser']);

Route::delete('deleteuser/{id}', [UserController::class, 'deleteUser']);

Route::get('searchuser/{name}', [UserController::class, 'searchUser']);

Route::resource('member',MemberController::class);

Route::post('signup',[UserAuthController::class, 'signUp']);

Route::post('login',[UserAuthController::class, 'login']);

Route::group(['middleware'=>'auth:sanctum'], function(){
    Route::get('users',[UserController::class, 'list']);
});
