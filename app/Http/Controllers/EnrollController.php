<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Student, Classes, Enroll};
use Auth;

class EnrollController extends Controller
{
    public function index(Request $request){
        $classes = Classes::withCount(['enroll'])->get();
        $student = Student::where('parent_id', Auth::user()->id)->get();
        $enroll = Enroll::with(['student','class'])->get();
        
        return view('enroll.index')->with(['classes' => $classes, 'student' => $student, 'enroll' => $enroll]);
    }

    public function save(Request $request){

        $request->validate([
            'student_id' => 'required|numeric',
            'class_id' => 'required|numeric',
        ]);
        $check = Enroll::where(['student_id' => $request->student_id, 'class_id' => $request->class_id,])->count();
        if($check > 0){
            return json_encode(['status' => 'error', 'message' => 'This student already enroll for this class!']);
        }
        Enroll::create([
            'student_id' => $request->student_id,
            'class_id' => $request->class_id,
        ]);
        return json_encode(['status' => 'success', 'message' => 'Student Enroll Successfully!']);
    }

    public function delete($id){
        Enroll::destroy($id);
        return back()->with(['success_message' => 'Succesfully deleted.']);
    }
}
