<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    //

    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
        // return view ('employees.index')->with('employees', $employees);
    }

    public function store(Request $request){
        $employees = new Employee([
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
        $employees = Employee::find($id);
        return response()->json($employees);

    }

    public function update(Request $request, $id){
        $employees = Employee::find($id);
        $employees->update([
            'firstname'=> $request->input('firstname'),
            'lastname'=> $request->input('lastname'),
            'address'=> $request->input('address'),
            'postcode'=> $request->input('postcode'),
            'mobile'=> $request->input('mobile'),
            'email'=> $request->input('email'),
            'username'=> $request->input('username'),
            'password'=> Hash::make($request->input('passwod')),
        ]);
        return response()->json("Employee Updated!");
    }

    public function destroy($id){
        $employees= Employee::find($id);
        $employees->delete();
        return response()->json('deleted!');
    }
}
