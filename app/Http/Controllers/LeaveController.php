<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Employee;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaves = Leave::all();

        return view('admin.leave.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        
        return view('admin.leave.create', ['employees' => $employees]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Leave::create($request->all());

        return back()->with('success', 'Leave added');
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $leave = Leave::findOrFail($id);

        $employees = Employee::all();

        return view('admin.leave.edit',compact('leave', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $leave = Leave::findOrFail($id);

        $leave->update($request->all());

        return back()->with('success', 'Leave record updated successfully.');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $leave = Leave::findOrFail($id);

        $leave->delete();

        return redirect()->route('leaves.index')->with('success', 'Leave record deleted successfully.');
    }
}
