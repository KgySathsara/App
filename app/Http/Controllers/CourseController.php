<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return response()->json(['courses' => $courses]);
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
            'Course Name' => ['required'],
            'Lecture Name' => ['required'],
            'Branch_id' => ['required']
        ]);
        $checkBranchId = $validateData['Branch_id'];
        $exists = Branch::where('id', $checkBranchId)->exists();
        if ($exists) {
            $cource = Course::create([
                'Course Name' => $validateData['Course Name' ],
                'Lecture Name' => $validateData['Lecture Name' ],
                'Branch_id'  => $validateData['Branch_id']
            ]);
            echo "course was registerd";
        } else {
            echo "Branch_id does not exist in the branches table.";
        }
        //dd($branchIds);
    }

    /**
     * Display the specified resource.
     */
    public function show(course $course,Request $request)
    {
        $validateData = $request->validate([
            'id' => ['required'],
        ]);
        $id = $validateData['id' ];
        $course = course::where('Branch_id', $id)->get();
        if (!$course) {
            return response()->json(['message' => 'course not found']);
        }
        return response()->json(['course' => $course]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, course $course)
    {
        $validateData = $request->validate([
            'Course Name' => ['required'],
            'Lecture Name' => ['required'],
            'id' => ['required'],
        ]);
        
        $branchId = $validateData['id'];

        $manager = course::where('Branch_id', $branchId)->first();
    
        if (!$manager) {
            return response()->json(["message" => "No course found for the provided Branch_id"]);
        }
    
        $manager->update([
            'Course Name' => $validateData['Course Name' ],
            'Lecture Name' => $validateData['Lecture Name' ],
        ]);
        return response()->json(["Course was updated"]);
    } 


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(course $course,Request $request)
    {
        $validateData = $request->validate([
            'id' => ['required'],
        ]);
        $course = Course::find($validateData['id']);

        if ($course) {
            $course->delete();
            return response()->json(["Course was delete"]);
        } else {
            return response()->json(["Fail to access this course"]);
        }
    } 
}
