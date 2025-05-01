# Laravel API Tutorial
## What is API
Application programming interface is a way for share data between two technology or two projects.

## Install api package
- create a new Laravel application
```bash
composer create-project laravel/laravel api_tutorial
```
- Install api package
```bash
php artisan install:api
```
- make router for api
navigate to routes/api.php and add these following lines
```php
Route::get("/test",function(){
    return [
        "name"=>"Tameem Ahamed",
        "age"=>"23"
    ];
});
```
- test api route
then in browser navigate to localhost:port/api/test to see if it works.


## make first api
- Database config in .env file

- Make controller and model
```bash
php artisan make:controller UserController
```
navigate to app/Http/Controllers/UserController and add these followings:
```php
    function list(){
        return "list function called";
    }
```
in routes/api.php:
```php
use App\Http\Controllers\UserController;
Route::get('users',[UserController::class, 'list']);
```
now make a model. run the following in terminal:
```bash
php artisan make:model users
```
- Get data from the Database
in UserController.php :
```php
use App\Models\users;

class UserController extends Controller
{
    function list(){
        return users::all();
    }
}
```
- Test API 

- Type of API method
    * Get
    * Post
    * Put/Patch
    * Delete

## Test API with thunder Client in VS Code
- Why need to test APIs
- Install Thunder Client Extension
search for Thunder Client extension in vs code. Install and get into it.
- Understand the basic of Thunder Client
- Test Get API
- Test Post API 

## Make API with POST method
- make function and Route
navigate to UserController.php then add the following
```php
    function addUser(){
        return "addUser method called";
    }
```

navigate to api.php
```php
Route::post('adduser',[UserController::class, 'addUser']);
```
- Write code for API
```json
{
  "name":"Tameem Ahamed",
  "username":"tameem69",
  "email":"tameemahamedc@gmail.com",
  "role":"user",
  "password":"thereititis",
  "status":"inactive",
  "phone":"123456"
}
```
- Test POST API
- Test Database table data
navigate to UserController.php then modify the following
```php
use Illuminate\Support\Facades\Hash;

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
```

## Make API with PUT method

- Make function and Route
in UserController.php add these
```php
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
```
in api.php add that
```php
Route::put('updateuser',[UserController::class,'updateUser']);
```
- Write code for API
```json
{
  "id":"12",
  "email":"ahamedctameem@gmail.com",
  "status":"active",
  "phone":"123456"
}
```
- Test Put API
- Test database table data

## Make API with Delete method
- Make function and Route
in UserController.php add
```php
    function deleteUser($user){
        $user = users::destroy($id);
        if($id){
            return "deleted";
        }
        else {
            return "not deleted";
        }
    }
```
in api.php 
```php
Route::delete('deleteuser', [UserController::class, 'deleteUser']);
```
- Write code for Delete API
- Test API
call for localhost:8000/api/deleteuser/12
- Test Database table data

## Make API for search
- Make function and define route
```php
    function searchUser($name){
        $user = users::where('name', 'like', "%$name%")->get();
        if(!empty($user)){
            return $user;
        }
        else return "no record found";
    }


Route::get('searchuser/{name}', [UserController::class, 'searchUser']);
```
- Write code for search data API
- Test API
- Verify result with database table data

## Validate API
- Import Validation class
in UserController.php
```php
use Illuminate\Support\Facades\Validator;

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

```
- Apply Validation for add student API
- Test API
- Verify the result with databse table data

## API With Resource Controller 
- What is Resource Controllers?
- Make Controller with Resource
```bash
php artisan make:controller MemberController --resource
```
it(--resource) would automatically create some functions in the controllers
- Write Routes 
in api.php
```php
use App\Http\Controllers\MemberController;

Route::resource('member',MemberController::class);
```
- Test APIs 

