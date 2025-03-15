<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use Illuminate\Http\Request;
use App\Models\Employee;
use Carbon\Carbon;

class AttendanceController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $employees = Employee::all();

        return view('admin.attendance.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();

        return view('admin.attendance.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendanceRequest $request)
    {
        Attendance::create($request->all());

        return back()->with('success', 'user crated successfully');
       
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);

        $employees = Employee::all();

        return view('admin.attendance.edit', compact(['employees', 'attendance']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        $attendance->update($request->all());

        return back()->with('success', 'user updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return back()->with('success', 'user deleted successfully');
    }

    public function report(Attendance $attendance, Request $request) {
        $year = $request->input('year');
        $month = $request->input('month');

        $daysInMonth = Carbon::create($year, $month)->daysInMonth;


        $employees = Employee::all();

        $userAttendanceData = [];

        foreach ($employees as $employee) {
            $userAttendanceData[$employee->id] = [
                'present' => 0,
                'absent' => 0,
            ];
           
            
            $attendances = $employee->attendances->filter(function ($attendance) use ($year, $month)
             {
                return Carbon::parse($attendance->date)->year == $year &&
                       Carbon::parse($attendance->date)->month == $month;
            });

            foreach ($attendances as $attendance) {
                if ($attendance->status === '1') {
                    $userAttendanceData[$employee->id]['present']++;
                } elseif ($attendance->status === '0') {
                    $userAttendanceData[$employee->id]['absent']++;
                }
            }

            $date = Carbon::parse($attendance->date);
            $year = $date->year;
            $month = $date->month;
            $day = $date->day;
        }

        return view('admin.attendance.report', compact('attendance', 'employees', 'daysInMonth', 'userAttendanceData', 'date'));
    }

    public function barcode() {
        return view('admin.attendance.barcode');
    }
}
