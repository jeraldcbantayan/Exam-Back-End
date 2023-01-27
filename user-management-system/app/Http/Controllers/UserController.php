<?php

namespace App\Http\Controllers;

// use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //

    public function index()
    {
        $employees = User::all();
        return response()->json($employees);
        // return view ('employees.index')->with('employees', $employees);
    }

    public function store(Request $request){
        $employees = new User([
            'firstname'=> $request->input('firstname'),
            'lastname'=> $request->input('lastname'),
            'address'=> $request->input('address'),
            'postcode'=> $request->input('postcode'),
            'mobile'=> $request->input('mobile'),
            'email'=> $request->input('email'),
            'username'=> $request->input('username'),
            'password'=> Hash::make($request->input('password')),
        ]);

        $employees->save();
        return response()->json("Employee Successfully created");
    }

    public function edit($id){
        $employees = User::find($id);
        return response()->json($employees);

    }

    public function update(Request $request, $id){
        $employees = User::find($id);
        $employees->update([
            'firstname'=> $request->input('firstname'),
            'lastname'=> $request->input('lastname'),
            'address'=> $request->input('address'),
            'postcode'=> $request->input('postcode'),
            'mobile'=> $request->input('mobile'),
            'email'=> $request->input('email'),
            'username'=> $request->input('username'),
            'password'=> Hash::make($request->input('password')),
        ]);
        return response()->json("Employee Updated!");
    }

    public function destroy($id){

        $single_user_id = explode(',' , $id);

        foreach($single_user_id as $id) {
            $employees= User::find($id);
            $employees->delete();
        }

        return response()->json('deleted!');
    }

    public function customLogin(Request $request){



        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {

            $success= true;
            $message = "User login Successfully";

        }else{
            $success= false;
            $message = "Invalid Credentials";
        }
        $user = auth()->user();

        // print_r($user);
        $response =[
            'success'=> $success,
            'message'=> $message,
            'user'=> $user
        ];
        return response()->json($response);
    }

    public function logout(){
        try{
            Session::flush();
            $success= true;
            $message="Logout Successfully";

        }catch(\Illuminate\Database\QueryException $ex){
            $success= false;
            $message = $ex->getMessage();
        }
        $response =[
            'success'=> $success,
            'message'=> $message
        ];

        return response()->json($response);
    }

}
