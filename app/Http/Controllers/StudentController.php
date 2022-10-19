<?php

namespace App\Http\Controllers;

use App\Models\StudentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        return redirect('/');
    }

    public function edit($id){
        
        $student = StudentModel::find($id);
        return view('edit_student',compact('student'));
    }

    public function update(Request $request, $id){

        //fetch record for image destination
        $student = StudentModel::find($id);
        //store all fields data in separate variable except token
        $input = $request->except(['_token']);

        if($request->file('profile_image')){

            $old_image_destination = public_path('storage/'.$student->profile_image); 
            //check if image exists then delete old image
            if(File::exists($old_image_destination)){
                File::delete($old_image_destination);
            }
            //upload and rename new image
            $file_name = $request->file('profile_image')->hashName();
            $file_path = $request->file('profile_image')->storeAs('profile_images',$file_name,'public');
            $input['profile_image'] = $file_path;
        }
        //update all fields with new image destination
        StudentModel::find($id)
                    ->update($input);
        
        return redirect('/')->with('success','Student updated successfully');
    }

    public function update_status($id){
        $student = StudentModel::find($id);
        $student->status = $student->status == 'Active' ? 'InActive' : 'Active';
        $student->update();

        return redirect('/')->with('success','Status updated successfully');
    }

    public function testing($id){
        try {
            $student = StudentModel::findOrFail($id);
            $student->status = $student->status == 'Active' ? 'InActive' : 'Active';
            $student->save();

            return response()->json(['message'=>'status has been updated','data'=>$student],200);
        } catch (\Exception $e) {
            return response()->json(['message'=>'status has not updated'],422);
        }        
    }
}
