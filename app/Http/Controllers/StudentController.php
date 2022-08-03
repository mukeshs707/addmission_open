<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Student, Classes};
use Auth;

class StudentController extends Controller
{
    public function index(){
        $class = Classes::select('id','name')->get();
        $student = Student::with(['class'])->where('parent_id', Auth::user()->id)->get();
        
        return view('student.index')->with(['class' => $class, 'student' => $student]);
    }

    public function save(Request $request){
        
        $request->validate([
            'name' => 'required',
            'age' => 'required|numeric',
        ]);

        Student::create([
            'parent_id' => Auth::user()->id,
            'name' => $request->name,
            'age' => $request->age,
        ]);
        return json_encode(['status' => 'success', 'message' => 'Student Added!']);
    }

    public function delete($id){
        Student::destroy($id);
        return back()->with(['success_message' => 'Succesfully deleted.']);
    }

    public function classes(){
        $classes = Classes::withCount(['enroll'])->get();
        return view('classes.index')->with(['classes' => $classes]);
    }
}
