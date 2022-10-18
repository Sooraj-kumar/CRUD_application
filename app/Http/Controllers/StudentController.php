<?php

namespace App\Http\Controllers;

use App\Models\StudentModel;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $student = StudentModel::all();
        return view('home',['students'=>$student]);        
    }
    public function store(Request $request){
        $request->validate([
            'full_name'=>'required',
            'email'=>'required',
            'phone'=>'required|max:20',
            'address'=>'required',
            'profile_image'=>'required|mimes:png,jpg,jped',
        ]);
        
        $student = StudentModel::create($request->all());
        if($request->file('profile_image')){

            $file_name = $request->file('profile_image')->hashName();
            $file_path = $request->file('profile_image')->storeAs('profile_images',$file_name,'public');
            $student['profile_image'] = $file_path;

        }
        $student->save();
        return view('home');
    }

    public function edit($id){
        
        $student = StudentModel::find($id);
        return view('edit_student',compact('student'));
    }

    public function update(Request $request, $id){

        $student = StudentModel::find($id);
        $student->full_name = $request->full_name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->address = $request->address;

        if($request->file('profile_image')){
            $file_name = $request->file('profile_image')->hashName();
            $file_path = $request->file('profile_image')->storeAs('profile_images',$file_name,'public');
            $student['profile_image'] = $file_path;
        }
        else{
            unset($request->profile_image);
        }
        $student->update();
        
        return redirect('/')->with('success','Student updated successfully');
    }

    public function active_student($id){
        $inactive_student = StudentModel::find($id);
        $inactive_student->status = 'Active';
        $inactive_student->update();

        return redirect('/')->with('success','Student active successfully');
    }

    public function inactive_student($id){
        $inactive_student = StudentModel::find($id);
        $inactive_student->status = 'InActive';

        $inactive_student->update();
        return redirect('/')->with('success','Student Inactive successfully');
    }
}
