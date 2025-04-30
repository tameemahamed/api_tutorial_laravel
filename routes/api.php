<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/test",function(){
    return [
        "name"=>"Tameem Ahamed",
        "age"=>"23"
    ];
});

Route::get('users',[UserController::class, 'list']);

Route::post('adduser',[UserController::class, 'addUser']);

Route::put('updateuser',[UserController::class,'updateUser']);

Route::delete('deleteuser/{id}', [UserController::class, 'deleteUser']);