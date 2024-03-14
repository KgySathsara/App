<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $students = Student::all();
        return response()->json(['students' => $students]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'Student Name' => ['required'],
            'Student Address' => ['required'],
            'Phone Number' => ['required', 'numeric'],
            'Branch_id' => ['required']
        ]);
        $checkBranchId = $validateData['Branch_id'];
        $exists = Branch::where('id', $checkBranchId)->exists();
        if ($exists) {
            $student = Student::create([
                'Student Name'  => $validateData['Student Name'],
                'Student Address'   => $validateData['Student Address' ],
                'Phone Number'  => $validateData['Phone Number'],
                'Branch_id'  => $validateData['Branch_id']
            ]);
            echo "student was registerd";
        } else {
            echo "Branch_id does not exist in the branches table.";
        }
        //dd($branchIds);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student,Request $request)
    {
        $validateData = $request->validate([
            'id' => ['required'],
        ]);
        $id = $validateData['id' ];
        $student = Student::where('Branch_id', $id)->get();
        if (!$student) {
            return response()->json(['message' => 'student not found']);
        }
        return response()->json(['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validateData = $request->validate([
            'Student Name' => ['required'],
            'Student Address' => ['required'],
            'Phone Number' => ['required', 'numeric'],
            'id' => ['required'],
        ]);
        
        $branchId = $validateData['id'];

        $manager = Student::where('Branch_id', $branchId)->first();
    
        if (!$manager) {
            return response()->json(["message" => "No Student found for the provided Branch_id"]);
        }
    
        $manager->update([
            'Student Name'  => $validateData['Student Name'],
            'Student Address'   => $validateData['Student Address' ],
            'Phone Number'  => $validateData['Phone Number'],
        ]);
        return response()->json(["Student was updated"]);
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Student $student)
    {
        $validateData = $request->validate([
            'id' => ['required'],
        ]);
        $student = Student::find($validateData['id']);

        if ($student) {
            $student->delete();
            return response()->json(["Student was delete"]);
        } else {
            return response()->json(["Fail to access this student"]);
        }
    }  
}
