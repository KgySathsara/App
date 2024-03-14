<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Manager;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $Managers = Manager::all();
        return response()->json(['Managers' => $Managers]);
        
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
            'Manager Name' => ['required'],
            'Manager Email Address'=> ['required'],
            'Manager Phone Number'=> ['required', 'digits:10'],
            'Branch_id' => ['required']
            
        ]);
        $branchId = $validateData['Branch_id']; 
        $exists = Branch::where('id', $branchId)->exists();
        if($exists) {
            $manager = Manager::create([
                'Manager Name'  => $validateData['Manager Name'],
                'Manager Email Address' => $validateData['Manager Email Address'],
                'Manager Phone Number'  => $validateData['Manager Phone Number'],
                'Branch_id'  => $validateData['Branch_id']
            ]);
            echo "Manager was registerd";
        } else {
            echo "Branch_id does not exist in the branches table.";
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Manager $manager,Request $request)
    {
        $validateData = $request->validate([
            'id' => ['required'],
        ]);
        $id = $validateData['id' ];
        $manager = Manager::where('Branch_id', $id)->get();
        if (!$manager) {
            return response()->json(['message' => 'manager not found']);
        }
        return response()->json(['manager' => $manager]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manager $manager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manager $manager)
    {
        $validateData = $request->validate([
            'Manager Name' => ['required'],
            'Manager Email Address'=> ['required'],
            'Manager Phone Number'=> ['required', 'digits:10'],
            'id' => ['required'],
        ]);
        
        $branchId = $validateData['id'];

        $manager = Manager::where('Branch_id', $branchId)->first();
    
        if (!$manager) {
            return response()->json(["message" => "No manager found for the provided Branch_id"]);
        }
    
        $manager->update([
            'name' => $validateData['Manager Name'],
            'email' => $validateData['Manager Email Address'],
            'phone_number' => $validateData['Manager Phone Number'],
        ]);
        return response()->json(["Manager was updated"]);
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manager $manager,Request $request)
    {

        return response()->json(["Can not delete manager recode only can update"]);
        // $validateData = $request->validate([
        //     'id' => ['required'],
        // ]);
        // $branchId = $validateData['id'];
        // $branch = Manager::where('Branch_id', $branchId);

        // if ($branch) {
        //     $branch->delete();
        //     return response()->json(["Branch was delete"]);
        // } else {
        //     return response()->json(["Fail to access this branch"]);
        // }
    }      
}
