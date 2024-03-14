<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Organization;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        
        $branches = Branch::all();
        return response()->json(['branches' => $branches]);
        
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
            'Name' => ['required'],
            'Location' => ['required'],
        ]);
        $createBranch = Branch::create([
            'Name'  => $validateData['Name'],
            'Location'  => $validateData['Location']
        ]);
        return response()->json(["Branch was registerd"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch,Request $request)
    {
        $validateData = $request->validate([
            'id' => ['required'],
        ]);
        $id = $validateData['id' ];
        $branch = Branch::find($id);
        if (!$branch) {
            return response()->json(['message' => 'Branch not found']);
        }
        return response()->json(['branch' => $branch]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch,Request $request)
    {
        $validateData = $request->validate([
            'id' => ['required'],
        ]);
        $id = $validateData['id' ];
        $branch = Branch::find($id);

        if (!$branch) {
            return response()->json(['message' => 'Branch not found']);
        }

        return response()->json(['branch' => $branch]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        $validateData = $request->validate([
            'Name' => ['required'],
            'Location' => ['required'],
            'id' => ['required'],
        ]);
        $branch = Branch::find($validateData['id']);

        if ($branch) {
            $branch->update([
                'Name' => $validateData['Name'],
                'Location' => $validateData['Location'],
            ]);
            return response()->json(["Branch was updated"]);
        } else {
            return response()->json(["Fail to access this branch"]);
        }
    }        
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Branch $branch)
    {
        $validateData = $request->validate([
            'id' => ['required'],
        ]);
        $branch = Branch::find($validateData['id']);

        if ($branch) {
            $branch->delete();
            return response()->json(["Branch was delete"]);
        } else {
            return response()->json(["Fail to access this branch"]);
        }
    }        

}

